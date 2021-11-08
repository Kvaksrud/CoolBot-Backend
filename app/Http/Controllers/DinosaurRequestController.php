<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\HttpCodes;
use App\Models\Dinosaur;
use App\Models\DinosaurRequest;
use App\Models\DiscordRegistration;
use App\Models\DiscordRole;
use App\Models\Teleport;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class DinosaurRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'guild_id' => ['required','integer'],
            'member_id' => ['required','integer'],
            'discord_roles' => ['required','array'],
            'discord_roles.*' => ['string','regex:/^\@(everyone)$|^\<\@\&([0-9]{17,19})\>$/'],
            'request_type' => ['required','string',Rule::in(['dinosaur','teleport'])], // add dino/tele
            'dinosaur_code' => ['required_if:request_type,dinosaur','string'],
            'dinosaur_gender' => ['required_if:request_type,dinosaur','string',Rule::in(['male','female'])],
            'teleport_code' => ['required_if:request_type,teleport','string'],
            'server_json' => ['required','array']
        ]);

        $member = DiscordRegistration::where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('member_id'))->first();
        if(!$member)
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['message' => 'The member requested does not exist'],HttpCodes::NOT_EXIST);

        $transactionController = New BankTransactionController();
        $transactionRequest = New Request();
        $transactionRequest->setMethod("POST");
        $transactionRequest->request->add([
            'guild_id' => $member->guild_id,
            'member_id' => $member->member_id,
            'type' => 'withdraw',
            'target' => 'wallet'
        ]);

        $modifiers = [];
        $roles = [];
        foreach($request->get('discord_roles') as $role){
            preg_match('/^\@(everyone)$|^\<\@\&([0-9]{17,19})\>$/',$role,$matches);
            if($matches[1] === 'everyone')
                $discord_role_id = 'everyone';
            else
                $discord_role_id = $matches[2];

            $dRole = DiscordRole::where('discord_id','=',$discord_role_id)->first();
            if(!$dRole) continue;
            else {
                $modifiers[] = $dRole->modifier;
                $roles[] = $dRole;
            }
        }

        $requestAccepted = false;
        switch ($request->get('request_type')) {
            case 'dinosaur':
                // Check if timer
                $lastInjection = $member->bankAccount->transactions()->where('timer', '=', 'dino_injection')->orderByDesc('created_at')->first();
                if ($lastInjection) {
                    $lastCarbon = new Carbon($lastInjection->created_at);
                    $nowCarbon = new Carbon();
                    $secondsSince = $nowCarbon->diffInSeconds($lastCarbon);
                    $restTime = (int)OptionController::getOption('dinosaur', 'injection_wait'); // Seconds
                    if ($secondsSince < $restTime) {
                        return ResponseBuilder::error(ApiCodes::TOO_TIRED, null, ['message' => 'Oh my! I\'m so tired from my last dino operation you have to wait.', 'seconds_left' => ($restTime - $secondsSince)]);
                    }
                }

                foreach($roles as $role){
                    if($role->canInject($request->get('dinosaur_code'))){
                        $requestAccepted = true;
                        break;
                    }
                }
                if($requestAccepted) {
                    $dinosaur = Dinosaur::where('code', '=', $request->get('dinosaur_code'))->first();

                    $cost = $dinosaur->cost * min($modifiers);
                    if ($member->canAfford($cost) === false)
                        return ResponseBuilder::error(ApiCodes::INSUFFICIENT_FUNDS);

                    $sheet = array_merge($request->get('server_json'),$dinosaur->sheet);
                    if($request->get('dinosaur_gender') === 'male')
                        $sheet = array_merge($sheet,['bGender' => false]);
                    else
                        $sheet = array_merge($sheet,['bGender' => true]);

                    $request = $dinosaur->requests()->create([
                        'cost' => $cost,
                        'sheet' => $sheet,
                        'discord_registration_id' => $member->id,
                    ]);

                    $transactionRequest->request->add([
                        'amount' => $cost,
                        'description' => 'Dinosaur injection: '.$dinosaur->display_name,
                        'timer' => 'dino_injection'
                    ]);

                }
                break;
            case 'teleport':
                $lastTeleport = $member->bankAccount->transactions()->where('timer', '=', 'dino_teleport')->orderByDesc('created_at')->first();
                if ($lastTeleport) {
                    $lastCarbon = new Carbon($lastTeleport->created_at);
                    $nowCarbon = new Carbon();
                    $secondsSince = $nowCarbon->diffInSeconds($lastCarbon);
                    $restTime = (int)OptionController::getOption('dinosaur', 'teleport_wait'); // Seconds
                    if ($secondsSince < $restTime) {
                        return ResponseBuilder::error(ApiCodes::TOO_TIRED, null, ['message' => 'Oh my! I\'m so tired from my last dino teleport you have to wait.', 'seconds_left' => ($restTime - $secondsSince)]);
                    }
                }

                foreach($roles as $role){
                    if($role->canTeleport($request->get('teleport_code'))){
                        $requestAccepted = true;
                        break;
                    }
                }
                if($requestAccepted) {
                    $teleport = Teleport::where('code','=',$request->get('teleport_code'))->first();

                    $cost = $teleport->cost * min($modifiers);
                    if($member->canAfford($cost) === false)
                        return ResponseBuilder::error(ApiCodes::INSUFFICIENT_FUNDS);

                    $sheet = array_merge($request->get('server_json'),$teleport->sheet);

                    $request = $teleport->requests()->create([
                        'cost' => $cost,
                        'sheet' => $sheet,
                        'discord_registration_id' => $member->id
                    ]);

                    $transactionRequest->request->add([
                        'amount' => $cost,
                        'description' => 'Teleport: '.$teleport->display_name,
                        'timer' => 'dino_teleport'
                    ]);
                }
                break;
            default:
                return ResponseBuilder::error(ApiCodes::INVALID_INPUT, null, null, HttpCodes::BAD_REQUEST);
        }

        if($requestAccepted === true) {
            $transactionController->store($transactionRequest);

            return ResponseBuilder::success($request);
        }
        return ResponseBuilder::error(ApiCodes::PERMISSION_DENIED,null,['message' => 'The requested resource is not available to this member'],HttpCodes::FORBIDDEN);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DinosaurRequest  $dinosaurRequest
     * @return \Illuminate\Http\Response
     */
    public function show(DinosaurRequest $dinosaurRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DinosaurRequest  $dinosaurRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(DinosaurRequest $dinosaurRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DinosaurRequest  $dinosaurRequest
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $request_id)
    {
        $request->validate([
            'status' => ['required',Rule::in(['success','failed'])]
        ]);

        $dRequest = DinosaurRequest::find($request_id);
        if(!$dRequest)
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,null,HttpCodes::NOT_EXIST);
        $dRequest->status = $request->get('status');
        try {
            $dRequest->saveOrFail();
        } catch(Exception $exception){
            return ResponseBuilder::error(ApiCodes::FAILED_SAVING);
        }
        return ResponseBuilder::success($dRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DinosaurRequest  $dinosaurRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(DinosaurRequest $dinosaurRequest)
    {
        //
    }

    public function canInject(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $request->validate([
            'discord_roles' => ['required','array'],
            'discord_roles.*' => ['string','regex:/^\@(everyone)$|^\<\@\&([0-9]{17,19})\>$/'],
        ]);

        $dinos = [];
        foreach($request->get('discord_roles') as $role){
            preg_match('/^\@(everyone)$|^\<\@\&([0-9]{17,19})\>$/',$role,$matches);
            if($matches[1] === 'everyone')
                $discord_role_id = 'everyone';
            else
                $discord_role_id = $matches[2];

            $dRole = DiscordRole::where('discord_id','=',$discord_role_id)->first();
            if(!$dRole) continue;
            else {
                $availableDinos = $dRole->availableDinosaurs()->select(['display_name','code','cost'])->get()->toArray();
                foreach($availableDinos as $aDino){
                    if(isset($dinos[$aDino['code']])) continue;
                    $dinos[$aDino['code']] = $aDino['display_name'] . " (".$aDino['cost'].")";
                }
            }
        }
        ksort($dinos);
        return ResponseBuilder::success($dinos);
    }

    public function canTeleport(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $request->validate([
            'discord_roles' => ['required','array'],
            'discord_roles.*' => ['string','regex:/^\@(everyone)$|^\<\@\&([0-9]{17,19})\>$/'],
        ]);

        $locations = [];
        foreach($request->get('discord_roles') as $role){
            preg_match('/^\@(everyone)$|^\<\@\&([0-9]{17,19})\>$/',$role,$matches);
            if($matches[1] === 'everyone')
                $discord_role_id = 'everyone';
            else
                $discord_role_id = $matches[2];

            $dRole = DiscordRole::where('discord_id','=',$discord_role_id)->first();
            if(!$dRole) continue;
            else {
                $availableLocations = $dRole->availableTeleports()->select(['display_name','code','cost'])->get()->toArray();
                foreach($availableLocations as $aLocation){
                    if(isset($locations[$aLocation['code']])) continue;
                    $locations[$aLocation['code']] = $aLocation['display_name'] . " (".$aLocation['cost'].")";
                }
            }
        }
        ksort($locations);
        return ResponseBuilder::success($locations);
    }


}
