<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/user')->name('user.')->group(function(){
    Route::get('/edit', function(){
        return view('user.edit');
    })->name('edit');

    Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');

    Route::get('/editpass', function(){
        return view('user.editpass');
    })->name('editpass');

    Route::post('/updatepass', [App\Http\Controllers\UserController::class, 'updatepass'])->name('updatepass');
});