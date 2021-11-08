@extends('layouts.coolbot')
@section('header-icon') location_on @endsection
@section('header-text') Teleport - {{ $teleport->display_name }}@endsection
@section('main')
    <div class="row p-2 d-flex justify-content-end">
        <div class="col-12">
            <a class="btn btn-primary float-end" href="{{route('Teleport.edit',['Teleport'=>$teleport->id])}}" role="button">Edit teleport</a>
        </div>
    </div>
    <div class="row">
        <x-ui.card.simple header="Code" title="{{ $teleport->code }}" class="col-3"/>
        <x-ui.card.simple header="Cost" title="{{ $teleport->cost }}" class="col-3"/>
    </div>
    <div class="row">
        <x-ui.form.textarea name="json" label="Teleport Sheet" placeholder="json" height="200px" value="{!!  json_encode($teleport->sheet, JSON_PRETTY_PRINT) !!}" disabled="true" />
    </div>

@endsection
