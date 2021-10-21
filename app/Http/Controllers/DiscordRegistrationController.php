<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\DiscordRegistration;
use Exception;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class DiscordRegistrationController extends Controller
{
    const DISCORD_ID_REGEX = '/^[0-9]{2,20}$/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        if($request->expectsJson())
            return ResponseBuilder::success(DiscordRegistration::all());
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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        if($request->has(['guild_id','member_id','steam_id','username']) !== true)
            if($request->expectsJson())
                return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

        if(!preg_match(self::DISCORD_ID_REGEX,$request->get('guild_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id'=>['Guild ID must be numeric and between 2-20 characters.']]);

        if(DiscordRegistration::where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('member_id'))->get()->count() > 0)
            return ResponseBuilder::error(ApiCodes::ALREADY_REGISTERED);

        $registration = new DiscordRegistration();
        $registration->guild_id = $request->get('guild_id');
        $registration->member_id = $request->get('member_id');
        $registration->steam_id = $request->get('steam_id');
        $registration->username = $request->get('username');
        try {
            $registration->save();
        } catch(Exception $e){
            return ResponseBuilder::error(ApiCodes::FAILED_SAVING,null,$request->all()); // Failed to save
        }
        return ResponseBuilder::success($registration);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscordRegistration  $discordRegistration
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request,string $id)
    {
        if($request->has(['discord_identifier'])) { // Look using member id and guild id instead of id of row
            if($request->has('guild_id') === false)
                return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS,null,['guild_id']);

            if(!preg_match(self::DISCORD_ID_REGEX,$request->get('guild_id')))
                return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id'=>['Guild ID must be numeric and between 2-20 characters.']]);

            try {
                $registration = DiscordRegistration::where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$id)->first();
            } catch (Exception $e) {
                if ($request->expectsJson() === true)
                    return ResponseBuilder::error(500,null,$e->getMessage());
                abort(500,$e->getMessage());
            }
        } else {
            try {
                $registration = DiscordRegistration::find($id);
            } catch (Exception $e) {
                if ($request->expectsJson() === true)
                    return ResponseBuilder::error(500,null,$e->getMessage());
                abort(500,$e->getMessage());
            }
        }

        if(!$registration)
            if($request->expectsJson())
                return ResponseBuilder::error(ApiCodes::NOT_REGISTERED,null,['discord_identifier' => $request->has('discord_identifier')]);

        if($request->expectsJson())
            return ResponseBuilder::success($registration);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscordRegistration  $discordRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscordRegistration $discordRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiscordRegistration  $discordRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiscordRegistration $discordRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscordRegistration  $discordRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscordRegistration $discordRegistration)
    {
        //
    }
}
