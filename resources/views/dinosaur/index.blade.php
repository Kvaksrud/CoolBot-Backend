@extends('layouts.coolbot')
@section('header-icon') pets @endsection
@section('header-text') Dinosaurs @endsection
@section('main')
    <div class="row p-2 d-flex justify-content-end">
        <div class="col-12">
            <a class="btn btn-primary float-end" href="{{route('Dinosaur.create')}}" role="button">New dinosaur</a>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Display Name</th>
                    <th>Code</th>
                    <th>Cost</th>
                    <th>In roles</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($dinosaurs->count() > 0)
                    @foreach($dinosaurs as $dinosaur)
                        <tr>
                            <td>{{$dinosaur->display_name}}</td>
                            <td>{{$dinosaur->code}}</td>
                            <td>{{$dinosaur->cost}}</td>
                            <td>{{$dinosaur->availableTo()->count()}}</td> <!-- TODO: Make clickable -->
                            <td>[<a href="{{route('Dinosaur.show',['Dinosaur'=>$dinosaur->id])}}">view</a>][<a href="{{route('Dinosaur.edit',['Dinosaur'=>$dinosaur->id])}}">edit</a>]</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><em>No dinos here!</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
