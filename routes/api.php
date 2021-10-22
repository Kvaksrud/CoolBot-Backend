<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//
Route::middleware('auth:sanctum')->group(function () {
    // Discord registrations
    Route::resource('DiscordRegistration', \App\Http\Controllers\DiscordRegistrationController::class)->only([
        'index','show','store'
    ]);

    // Character sheets
    Route::resource('CharacterSheet', \App\Http\Controllers\CharacterSheetController::class)->only([
        'show','store'
    ]);

    // Bank Transactions
    Route::post('BankTransaction/Transfer', [\App\Http\Controllers\BankTransactionController::class, 'transfer']);
    Route::post('BankTransaction/Send', [\App\Http\Controllers\BankTransactionController::class, 'send']);
    Route::resource('BankTransaction', \App\Http\Controllers\BankTransactionController::class)->only([
        'store'
    ]);

    // BankAccount
    Route::resource('BankAccount', \App\Http\Controllers\BankAccountController::class)->only([
        'show'
    ]);
});
