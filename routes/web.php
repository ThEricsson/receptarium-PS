<?php

use App\Models\Post;
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

Auth::routes();

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/user')->name('user.')->group(function(){
    Route::view('/edit', 'user.edit')->name('edit');

    Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');

    Route::view('/editpass', 'user.editpass')->name('editpass');

    Route::post('/updatepass', [App\Http\Controllers\UserController::class, 'updatepass'])->name('updatepass');
});

Route::prefix('/post')->name('post.')->group(function(){
    Route::view('/create', 'post.create')->name('create');

    Route::post('/upload', [App\Http\Controllers\PostController::class, 'create'])->name('upload');

    Route::get('/view/{id}', function($id){
        $post = Post::findOrFail($id);

        return view('post.view', ['post' => $post]);
        
    })->name('view');
});

Route::prefix('/image')->name('image.')->group(function(){

    Route::get('/getavatar/{filename}', [App\Http\Controllers\ImageController::class, 'getAvatar'])->name('getavatar');

    Route::get('/getpostimg/{filename}', [App\Http\Controllers\ImageController::class, 'getPostImg'])->name('getpostimg');

});