@extends('layouts.coolbot')
@section('header-icon') pets @endsection
@section('header-text') Create new dinosaurs injection template @endsection
@section('main')
    <form method="post" action="{{route('Dinosaur.store')}}">
        @csrf
        <div class="row gy-3 pb-4">
            <x-ui.form.input label="Dinosaur display name" name="display_name" placeholder="Adult Shantungosaurus" required="true" class="col-12" />
            <x-ui.form.input label="Code used in Discord" name="code" placeholder="shant" required="true" class="col-6" />
            <x-ui.form.input type="number" label="Cost for injection" name="cost" placeholder="50000" required="true" class="col-6" />
            <x-ui.form.textarea label="JSON Character Sheet Template" name="json_sheet" placeholder="{}" required="true" height="400px" class="col-12"/>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-end">Create injection template</button>
    </form>
@endsection

