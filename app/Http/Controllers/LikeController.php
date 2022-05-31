<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Like;

class LikeController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Like Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de la gestió dels likes.
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
     * Crea el like
     * 
     * @return void
     */
    public function like($post_id){

        $id= Auth::user()->id;

        $user_like = Like::where('user_id', $id)
                            ->where('post_id', $post_id)
                            ->count();

        if($user_like == 0){
            $like = Like::create();

            $like->user_id=$id;
            $like->post_id=$post_id;

            $like->save();

            return response(200);
        } else {
            return response(400);
        }
        

        
    }


    /**
     * Eliminar like
     * 
     * @return void
     */
    public function dislike($post_id){

        $user = Auth::user();
        $like = $user->likes->where('post_id', $post_id)->firstOrFail();

        $like->delete();

        return response(200);
        
    }
}