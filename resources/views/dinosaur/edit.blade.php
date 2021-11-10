@extends('layouts.coolbot')
@section('header-icon') pets @endsection
@section('header-text') Edit dinosaur - {{ $dinosaur->display_name }} @endsection
@section('main')
    <form method="post" action="{{route('Dinosaur.update',['Dinosaur'=>$dinosaur->id])}}">
        @csrf
        @method('PUT')
        <div class="row gy-3 pb-4">
            <x-ui.form.input label="Dinosaur display name" name="display_name" placeholder="Adult Shantungosaurus" required="true" value="{{ $dinosaur->display_name }}" class="col-12" />
            <x-ui.form.input label="Code used in Discord" name="code" placeholder="shant" disabled="true" value="{{ $dinosaur->code }}" class="col-6" />
            <x-ui.form.input type="number" label="Cost for injection" name="cost" placeholder="50000" required="true" value="{{ $dinosaur->cost }}" class="col-6" />
            <x-ui.form.textarea label="JSON Character Sheet Template" name="json_sheet" placeholder="{}" height="400px" required="true" value="{!! json_encode($dinosaur->sheet, JSON_PRETTY_PRINT) !!}" disabled="true" height="400px" class="col-12"/>
        </div>
        <a class="btn btn-secondary btn-lg" href="{{route('Dinosaur.show',['Dinosaur'=>$dinosaur->id])}}" role="button">Cancel</a> <button type="submit" class="btn btn-primary btn-lg float-end">Update injection template</button>
    </form>
@endsection

