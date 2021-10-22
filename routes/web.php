<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user/tokens',[\App\Http\Controllers\UserController::class,'token_index'])->name('user.tokens');
    Route::resource('BankAccount', \App\Http\Controllers\BankAccountController::class)->only([
        'index','show'
    ]);
});

require __DIR__.'/auth.php';
