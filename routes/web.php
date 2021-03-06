<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Like;
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

Route::get('/', function(){
    if(Auth::check()){
        return redirect()->route('home.main');
    }

    return view('welcome');
});

Route::prefix('/home')->name('home.')->group(function(){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');

    Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

});

Route::prefix('/user')->name('user.')->group(function(){
    Route::view('/edit', 'user.edit')->name('edit');

    Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');

    Route::view('/editpass', 'user.editpass')->name('editpass');

    Route::post('/updatepass', [App\Http\Controllers\UserController::class, 'updatepass'])->name('updatepass');

    Route::get('/profile/{id}', function($id){
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->orderBy('id', 'desc')->paginate(5);
        $totalLikes = Post::with('likes')->whereUserId($id)->get()->sum(function($post) {
            return $post->likes->count();
        });
        $totalFavs = Post::with('favorites')->whereUserId($id)->get()->sum(function($post) {
            return $post->favorites->count();
        });

        return view('user.profile', ['user' => $user, 'posts' => $posts, 'totalLikes' => $totalLikes, 'totalFavs' => $totalFavs]);
    })->name('profile');

});

Route::prefix('/post')->name('post.')->group(function(){
    Route::view('/create', 'post.create')->name('create');

    Route::post('/upload', [App\Http\Controllers\PostController::class, 'create'])->name('upload');

    Route::get('/view/{id}', function($id){
        $post = Post::findOrFail($id);

        return view('post.view', ['post' => $post]);
        
    })->name('view');
    
    Route::get('/editar/{post_id}', function($post_id){
        $post = Post::findOrFail($post_id);

        if(Auth::check() && Auth::user()->id == $post->user_id){
            return view('post.edit', ['post' => $post]);
        } else {
            return abort(403);
        }
        
    })->name('edit');

    Route::post('/update', [App\Http\Controllers\PostController::class, 'update'])->name('update');

    Route::get('/like/{post_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like');

    Route::get('/dislike/{post_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('dislike');

    Route::get('/favorite/{post_id}', [App\Http\Controllers\FavoriteController::class, 'favorite'])->name('favorite');

    Route::get('/unfavorite/{post_id}', [App\Http\Controllers\FavoriteController::class, 'unfavorite'])->name('unfavorite');

    Route::post('/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('delete');
    
    Route::post('/comentar', [App\Http\Controllers\ComentController::class, 'create'])->name('comentar');
});

Route::prefix('/image')->name('image.')->group(function(){

    Route::get('/getavatar/{filename}', [App\Http\Controllers\ImageController::class, 'getAvatar'])->name('getavatar');

    Route::get('/getpostimg/{filename}', [App\Http\Controllers\ImageController::class, 'getPostImg'])->name('getpostimg');

});

