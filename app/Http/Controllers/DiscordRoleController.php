<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\Dinosaur;
use App\Models\DiscordRole;
use App\Models\Teleport;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class DiscordRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $discordRoles = DiscordRole::orderBy('friendly_name')->get();
        return view('discord_role/index')->with('discordRoles',$discordRoles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $dinosaurs = Dinosaur::orderBy('display_name')->get();
        $teleports = Teleport::orderBy('display_name')->get();
        return view('discord_role/create')->with('dinosaurs',$dinosaurs)->with('teleports',$teleports);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        if($request->expectsJson())
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS);

        $request->validate([
            'friendly_name' => ['required','string'],
            'discord_id' => ['required','numeric'],
            'modifier' => ['required','regex:/^[0-2]\.\d{2}$/'],
            'dinosaurs' => ['required','array'],
            'dinosaurs.*' => 'integer'
        ]);

        $discordRole = new DiscordRole();
        $discordRole->friendly_name = $request->get('friendly_name');
        $discordRole->discord_id = $request->get('discord_id');
        $discordRole->modifier = $request->get('modifier');
        $discordRole->saveOrFail();

        $discordRole->availableDinosaurs()->sync($request->get('dinosaurs'));
        $discordRole->availableTeleports()->sync($request->get('teleports'));

        return redirect()->route('DiscordRole.show',['DiscordRole'=>$discordRole->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscordRole  $discordRoles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request,$discordRoleId)
    {
        $discordRole = DiscordRole::with(['availableDinosaurs','availableTeleports'])->findOrFail($discordRoleId);
        return view('discord_role.show')->with('discordRole',$discordRole);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscordRole  $discordRoles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request,$discordRoleId)
    {
        $discordRole = DiscordRole::with('availableDinosaurs')->findOrFail($discordRoleId);
        $dinosaurs = Dinosaur::orderBy('display_name')->get();
        $teleports = Teleport::orderBy('display_name')->get();
        $checkedDinos = $discordRole->availableDinosaurs()->pluck('dinosaur_id')->toArray();
        $checkedTeleports = $discordRole->availableTeleports()->pluck('teleport_id')->toArray();
        return view('discord_role/edit')->with('dinosaurs',$dinosaurs)->with('teleports',$teleports)->with('discordRole',$discordRole)->with('checkedDinos',$checkedDinos)->with('checkedTeleports',$checkedTeleports);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $discordRoleId)
    {
        if($request->expectsJson())
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS);

        $discordRole = DiscordRole::findOrFail($discordRoleId);

        $request->validate([
            'friendly_name' => ['required','string'],
            'modifier' => ['required','regex:/^[0-2]\.\d{2}$/'],
            'dinosaurs' => ['required','array'],
            'dinosaurs.*' => 'integer'
        ]);

        $discordRole->friendly_name = $request->get('friendly_name');
        $discordRole->modifier = $request->get('modifier');
        $discordRole->saveOrFail();
        $discordRole->availableDinosaurs()->sync($request->get('dinosaurs'));
        $discordRole->availableTeleports()->sync($request->get('teleports'));

        return redirect()->route('DiscordRole.show',['DiscordRole'=>$discordRole->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscordRole  $discordRoles
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscordRole $discordRoles)
    {
        //
    }
}
