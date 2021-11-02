@extends('layouts.coolbot')
@section('header-icon') paid @endsection
@section('header-text') Bank Account for {{$bankAccount->holder->username}} @endsection
@section('main')
    <style type="text/css">
        .inline-icon {
            vertical-align: bottom;
            font-size: 18px !important;
        }
    </style>
    <div class="row d-flex justify-content-end" title="Wallet Balance">
        <div class="col-1 text-center align-middle">
            <i class="material-icons-outlined align-middle">account_balance_wallet</i>
            <span class="align-middle">{{$bankAccount->wallet}}</span>
        </div>
        <div class="col-1 text-center" title="Account Balance">
            <span class="material-icons-outlined align-middle">account_balance</span>
            <span class="align-middle">{{$bankAccount->balance}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h1>Last 30 transactions</h1>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Target</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($lastTransactions) === 0)
                            <tr>
                                <td colspan="5">There are no transactions on this account</td>
                            </tr>
                        @else
                            @foreach($lastTransactions as $transaction)
                                <tr>
                                    <td>{{$transaction->created_at}}</td>
                                    <td>{{$transaction->type}}</td>
                                    <td>{{$transaction->target}}</td>
                                    <td style="text-align: right; padding-right: 1rem;">{{$transaction->amount}}</td>
                                    <td>{{$transaction->description}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
