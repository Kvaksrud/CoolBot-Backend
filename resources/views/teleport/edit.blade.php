@extends('layouts.coolbot')
@section('header-icon') location_on @endsection
@section('header-text') Edit teleport template - {{ $teleport->display_name }} @endsection
@section('main')
    <form method="post" action="{{route('Teleport.update',['Teleport'=>$teleport->id])}}">
        @csrf
        @method('PUT')
        <div class="row gy-3 pb-4">
            <x-ui.form.input label="Teleport display name" name="display_name" placeholder="North Twins" required="true" value="{{ $teleport->display_name }}" class="col-12" />
            <x-ui.form.input label="Code used in Discord" name="code" placeholder="ntwins" disabled="true" value="{{ $teleport->code }}" class="col-6" />
            <x-ui.form.input type="number" label="Cost for injection" name="cost" placeholder="50000" required="true" value="{{ $teleport->cost }}" class="col-6" />
            <x-ui.form.textarea label="JSON Teleport Coordinate Template" name="json_sheet" placeholder="{}" height="200px" required="true" value="{!! json_encode($teleport->sheet, JSON_PRETTY_PRINT) !!}" disabled="true" class="col-12"/>
        </div>
        <a class="btn btn-secondary btn-lg" href="{{route('Teleport.show',['Teleport'=>$teleport->id])}}" role="button">Cancel</a> <button type="submit" class="btn btn-primary btn-lg float-end">Update teleport template</button>
    </form>
@endsection

