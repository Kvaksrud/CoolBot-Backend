@extends('layouts.coolbot')
@section('header-icon') location_on @endsection
@section('header-text') Teleports @endsection
@section('main')
    <div class="row p-2 d-flex justify-content-end">
        <div class="col-12">
            <a class="btn btn-primary float-end" href="{{route('Teleport.create')}}" role="button">New teleport location</a>
        </div>
    </div>
    <div class="row">
        <x-ui.card.simple header="Teleport Locations" title="{{$teleports->count()}}" class="col-3 text-center" />
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
                @if($teleports->count() > 0)
                    @foreach($teleports as $teleport)
                        <tr>
                            <td>{{$teleport->display_name}}</td>
                            <td>{{$teleport->code}}</td>
                            <td>{{$teleport->cost}}</td>
                            <td>{{$teleport->availableTo()->count()}}</td> <!-- TODO: Make clickable -->
                            <td>[<a href="{{route('Teleport.show',['Teleport'=>$teleport->id])}}">view</a>][<a href="{{route('Teleport.edit',['Teleport'=>$teleport->id])}}">edit</a>]</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><em>No teleports here!</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
