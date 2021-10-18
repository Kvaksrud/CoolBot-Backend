<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\CharacterSheet;
use App\Models\DiscordRegistration;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use function PHPUnit\Framework\isJson;

class CharacterSheetController extends Controller
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
        if($request->has(['guild_id','member_id','type','content']) !== true)
            if($request->expectsJson())
                return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS); // Missing parameters

        if(!preg_match('/^[0-9]{2,20}$/',$request->get('guild_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id'=>['Guild ID must be numeric and between 2-20 characters.']]);

        $validTypes = ['cache','injection'];
        if(in_array($request->get('type'),$validTypes) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_TYPE); // Invalid type

        $registration = DiscordRegistration::where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('member_id'))->first();
        if(!$registration) return ResponseBuilder::error(ApiCodes::NOT_REGISTERED); // No registration

        $characterSheet = new CharacterSheet();
        $characterSheet->discord_registration_id = $registration->id;
        $characterSheet->type = $request->get('type');
        $characterSheet->content = $request->get('content');

        try {
            $characterSheet->save();
        } catch(Exception $e){
            return ResponseBuilder::error(ApiCodes::FAILED_SAVING,null,$e->getMessage()); // Failed to save
        }
        return ResponseBuilder::success($characterSheet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CharacterSheet  $characterSheet
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request,$id)
    {
        $characterSheet = CharacterSheet::find($id);
        if($characterSheet->count() === 0)
            if($request->expectsJson())
                return ResponseBuilder::error(ApiCodes::NOT_EXISTS);
            else
                abort(404);

        if($request->expectsJson())
            return ResponseBuilder::success($characterSheet);
        abort(501); // 501 = Not implemented
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CharacterSheet  $characterSheet
     * @return \Illuminate\Http\Response
     */
    public function edit(CharacterSheet $characterSheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CharacterSheet  $characterSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CharacterSheet $characterSheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CharacterSheet  $characterSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(CharacterSheet $characterSheet)
    {
        //
    }
}
