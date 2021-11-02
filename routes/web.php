<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::resource('BankAccount', \App\Http\Controllers\BankAccountController::class)->only([
        'index','show'
    ]);
    Route::resource('LaborReply', \App\Http\Controllers\LaborReplyController::class)->only([
        'index','show'
    ]);
    Route::resource('Option', \App\Http\Controllers\OptionController::class)->only([
        'index','show'
    ]);
});

require __DIR__.'/auth.php';
