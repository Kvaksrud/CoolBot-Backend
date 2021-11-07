@extends('layouts.coolbot')
@section('header-icon') badge @endsection
@section('header-text') Labor @endsection
@section('main')
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Suggested by</th>
                        <th>Status</th>
                        <th>Text</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($replies as $reply)
                    <tr>
                        <td>{{$reply->suggested_by->username}}</td>
                        <td>{{$reply->status}}</td>
                        <td>{{$reply->text_before}} {{rand((int)\App\Http\Controllers\OptionController::getOption('labor','minimum_wage'),(int)\App\Http\Controllers\OptionController::getOption('labor','maximum_wage'))}}$ {{$reply->text_after}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
