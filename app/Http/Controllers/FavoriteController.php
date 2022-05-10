<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Favorite;

class FavoriteController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Favorite Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de la gestió dels favorits.
    | 
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Crea el favorite
     * 
     * @return void
     */
    public function favorite($post_id){

        $id= Auth::user()->id;

        $user_favorite = Favorite::where('user_id', $id)
                            ->where('post_id', $post_id)
                            ->count();

        if($user_favorite == 0){
            $favorite = Favorite::create();

            $favorite->user_id=$id;
            $favorite->post_id=$post_id;
            
            $favorite->save();

            return response(200);
        } else {
            return response(409);
        }
        

        
    }


    /**
     * Eliminar favorite
     * 
     * @return void
     */
    public function unfavorite($post_id){

        $user = Auth::user();
        $favorite = $user->favorites->where('post_id', $post_id)->firstOrFail();

        $favorite->delete();

        return response(200);
        
    }
}