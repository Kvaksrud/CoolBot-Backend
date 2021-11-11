@extends('layouts.coolbot')
@section('header-icon') pets @endsection
@section('header-text') Dinosaur - {{ $dinosaur->display_name }}@endsection
@section('main')
    <div class="row p-2 d-flex justify-content-end">
        <div class="col-12">
            <a class="btn btn-primary float-end" href="{{route('Dinosaur.edit',['Dinosaur'=>$dinosaur->id])}}" role="button">Edit dinosaur</a>
        </div>
    </div>
    <div class="row">
        <x-ui.card.simple header="Code" title="{{ $dinosaur->code }}" class="col-3"/>
        <x-ui.card.simple header="Cost" title="{{ $dinosaur->cost }}" class="col-3"/>
    </div>
    <div class="row">
        <x-ui.form.textarea name="json" label="Grow Sheet" placeholder="json" height="400px" value="{!!  json_encode($sheet, JSON_PRETTY_PRINT) !!}" disabled="true" />
    </div>

@endsection
