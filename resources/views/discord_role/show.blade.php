@extends('layouts.coolbot')
@section('header-icon') groups @endsection
@section('header-text') Discord Role - {{ $discordRole->friendly_name }}@endsection
@section('main')
    <div class="row p-2 d-flex justify-content-end">
        <div class="col-12">
            <a class="btn btn-primary float-end" href="{{route('DiscordRole.edit',['DiscordRole'=>$discordRole->id])}}" role="button">Edit role</a>
        </div>
    </div>
    <div class="row">
        <x-ui.card.simple header="Modifier" title="{{ $discordRole->modifier }}" class="col-3"/>
    </div>
    @if($discordRole->availableDinosaurs()->count() > 0)
    <div class="row pb-4">
            <div class="col-12 pb-2">
                <h2>Available dinosaurs</h2>
            </div>
            @foreach($discordRole->availableDinosaurs as $dinosaur)
                <div class="col-3">
                    {{$dinosaur->display_name}}
                </div>
            @endforeach
    </div>
    @endif
    @if($discordRole->availableTeleports()->count() > 0)
        <div class="row">
            <div class="col-12 pb-2">
                <h2>Available teleport locations</h2>
            </div>
            @foreach($discordRole->availableTeleports as $teleport)
                <div class="col-3">
                    {{$teleport->display_name}}
                </div>
            @endforeach
        </div>
    @endif

@endsection
