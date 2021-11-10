@extends('layouts.coolbot')
@section('header-icon') home @endsection
@section('header-text') Dashboard @endsection
@section('main')
    <div class="row">
        <x-ui.card.simple header="Registrations" title="{{$registrations->count()}}" class="col-3 text-center" />
        <x-ui.card.simple header="Bank Accounts" title="{{$bankAccounts->count()}}" class="col-3 text-center" />
        <x-ui.card.simple header="Money in circulation" title="{{$bankAccounts->sum('balance') + $bankAccounts->sum('wallet')}}" class="col-6 text-center" />
        <x-ui.card.simple header="Labor Replies" title="{{$replies->count()}}" class="col-3 text-center" />
        <x-ui.card.simple header="Discord Roles" title="{{$discordRoles->count()}}" class="col-3 text-center" />
        <x-ui.card.simple header="Dinosaur sheets" title="{{$dinosaurs->count()}}" class="col-3 text-center" />
        <x-ui.card.simple header="Teleport locations" title="{{$teleports->count()}}" class="col-3 text-center" />
    </div>
@endsection
