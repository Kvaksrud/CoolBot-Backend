@extends('layouts.coolbot')
@section('header-icon') paid @endsection
@section('header-text') Bank Accounts @endsection
@section('main')
    <div class="row">
        <x-ui.card.simple header="Bank Accounts" title="{{$bankAccounts->count()}}" class="col-3 text-center" />
    </div>
    <div class="row">
        <div class="col-12">
            @if(count($bankAccounts) === 0)
                <em>You have no bank accounts</em>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
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
@endsection
