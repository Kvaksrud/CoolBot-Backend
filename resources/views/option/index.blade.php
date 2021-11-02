@extends('layouts.coolbot')
@section('header-icon') settings @endsection
@section('header-text') Options @endsection
@section('main')
    @if($categories->count() > 0)
        @foreach($categories as $category)
            <div class="row pb-4">
                <div class="col-12">
                    <h2>{{$category->name}}</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th width="20%">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($category->options()->count() > 0)
                                @foreach($category->options()->orderBy('display_name')->get() as $option)
                                <tr>
                                    <td><span title="{{$option->name}}">{{$option->display_name}}</span></td>
                                    <td>{{$option->value}}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2"><em>No options in this category</em></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
@endsection
