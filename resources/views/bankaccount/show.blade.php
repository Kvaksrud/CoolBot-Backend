@extends('layouts.coolbot')
@section('main')
    <div style="padding-top: 1rem;padding-bottom: 1rem" class="sm:px-6 lg:px-8">
        <a href="{{route('BankAccount.index')}}">Back to Bank Accounts</a>
    </div>
    <div style="padding-bottom: 1rem;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table style="text-align: left; width: 100%">
                        <tr>
                            <td>
                                <p class="font-semibold text-xl text-gray-800 leading-tight">Wallet</p>
                                <p>{{$bankAccount->wallet}}</p>
                            </td>
                            <td>
                                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Balance</h1>
                                <p>{{$bankAccount->balance}}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-bottom: 3rem;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Last 30 transactions</h1>
                    <p>
                        <table style="width: 100%">
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
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
