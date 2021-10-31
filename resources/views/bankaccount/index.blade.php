@extends('layouts.coolbot')
@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button type="button">New token</button>
                    @if(count($bankAccounts) === 0)
                        <em>You have no bank accounts</em>
                    @else
                        <table style="width:100%">
                            <thead>
                                <tr style="text-align: left">
                                    <th>Bank ID</th>
                                    <th>Account No.</th>
                                    <th>Holder</th>
                                    <th>Wallet</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($bankAccounts as $bankAccount)
                                <tr>
                                    <td>{{$bankAccount->holder->guild_id}}</td>
                                    <td><a href="{{route('BankAccount.show',['BankAccount'=>$bankAccount->id])}}">{{$bankAccount->holder->member_id}}</a></td>
                                    <td>{{$bankAccount->holder->username}}</td>
                                    <td>{{$bankAccount->wallet}}</td>
                                    <td>{{$bankAccount->balance}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
