@extends('layouts.coolbot')
@section('header-icon') groups @endsection
@section('header-text') Edit Discord Role - {{$discordRole->friendly_name}} @endsection
@section('main')
    <form method="post" action="{{route('DiscordRole.update',['DiscordRole'=>$discordRole->id])}}">
        @csrf
        @method('PUT')
        <div class="row gy-3 pb-4">
            <x-ui.form.input label="Discord Role Friendly Name" name="friendly_name" placeholder="Moderators" value="{{$discordRole->friendly_name}}" required="true" class="col-12" />
            <x-ui.form.input type="number" label="Discord ID" name="discord_id" placeholder="123456789" disabled="true" value="{{$discordRole->discord_id}}" class="col-6" />
            <x-ui.form.input label="Cost modifier" name="modifier" placeholder="1" required="true" value="{{$discordRole->modifier}}" value="1.00" class="col-6" />
            <div class="col-12 pt-2">
                <h2>Dinosaurs</h2>
            </div>
            @if($dinosaurs->count() > 0)
                @foreach($dinosaurs as $dinosaur)
                    <x-ui.form.checkbox checked="{{in_array($dinosaur->id,$checkedDinos)}}" name="dinosaurs[]" label="{!! $dinosaur->display_name !!}" value="{{$dinosaur->id}}" class="col-4" />
                @endforeach
            @else
                <em>No dinos in database</em>
            @endif
            <div class="col-12 pt-2">
                <h2>Teleports</h2>
            </div>
            @if($teleports->count() > 0)
                @foreach($teleports as $teleport)
                    <x-ui.form.checkbox checked="{{in_array($teleport->id,$checkedTeleports)}}" name="teleports[]" label="{!! $teleport->display_name !!}" value="{{$teleport->id}}" class="col-4" />
                @endforeach
            @else
                <em>No teleports in database</em>checkedTeleports
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-end">Store Discord Role</button>
    </form>
@endsection


