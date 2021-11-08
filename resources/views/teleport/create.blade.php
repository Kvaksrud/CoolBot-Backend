@extends('layouts.coolbot')
@section('header-icon') location_on @endsection
@section('header-text') Create a new teleport location template @endsection
@section('main')
    <form method="post" action="{{route('Teleport.store')}}">
        @csrf
        <div class="row gy-3 pb-4">
            <x-ui.form.input label="Teleport display name" name="display_name" placeholder="North Twins" required="true" class="col-12" />
            <x-ui.form.input label="Code used in Discord" name="code" placeholder="ntwins" required="true" class="col-6" />
            <x-ui.form.input type="number" label="Cost for teleport" name="cost" placeholder="50000" required="true" class="col-6" />
            <x-ui.form.textarea label="JSON Teleport Coordinate Template" name="json_sheet" placeholder="{}" required="true" height="400px" class="col-12"/>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-end">Create teleport location template</button>
    </form>
@endsection

