@extends('layouts.coolbot')
@section('header-icon') groups @endsection
@section('header-text') Add a Discord Role to Backend @endsection
@section('main')
    <form method="post" action="{{route('DiscordRole.store')}}">
        @csrf
        <div class="row gy-3 pb-4">
            <x-ui.form.input label="Discord Role Friendly Name" name="friendly_name" placeholder="Moderators" required="true" class="col-12" />
            <x-ui.form.input type="number" label="Discord ID" name="discord_id" placeholder="123456789" required="true" class="col-6" />
            <x-ui.form.input label="Cost modifier" name="modifier" placeholder="1" required="true" value="1.00" class="col-6" />
            @if($dinosaurs->count() > 0)
                @foreach($dinosaurs as $dinosaur)
                    <x-ui.form.checkbox name="dinosaurs[]" label="{{$dinosaur->display_name}}" value="{{$dinosaur->id}}" class="col-4" />
                @endforeach
            @else
                <em>No dinos in database</em>
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-end">Store Discord Role</button>
    </form>
@endsection

