@extends('layouts.coolbot')
@section('header-icon') groups @endsection
@section('header-text') Discord Roles @endsection
@section('main')
    <div class="row p-2 d-flex justify-content-end">
        <div class="col-12">
            <a class="btn btn-primary float-end" href="{{route('DiscordRole.create')}}" role="button">Add role</a>
        </div>
    </div>
    <div class="row">
        <x-ui.card.simple header="Roles" title="{{$discordRoles->count()}}" class="col-3 text-center" />
    </div>
    <div class="row pb-4">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Friendly name</th>
                    <th>Discord ID</th>
                    <th>Cost modifier</th>
                    <th>Dinos / Teleports</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($discordRoles->count() > 0)
                    @foreach($discordRoles as $role)
                        <tr>
                            <td>{{$role->friendly_name}}</td>
                            <td>{{$role->discord_id}}</td>
                            <td>{{$role->modifier}}</td>
                            <td>{{$role->availableDinosaurs()->count()}} / {{$role->availableTeleports()->count()}}</td>
                            <td>
                                [<a href="{{route('DiscordRole.show',['DiscordRole'=>$role->id])}}">view</a>]
                                [<a href="{{route('DiscordRole.edit',['DiscordRole'=>$role->id])}}">edit</a>]
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><em>No roles here!</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
