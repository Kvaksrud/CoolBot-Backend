@extends('layouts.coolbot')
@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button type="button">New token</button>
                    @if($tokens->count() === 0)
                        <em>You have not tokens</em>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>This</th>
                                <th>That</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>another</td>
                                    <td>thing</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
