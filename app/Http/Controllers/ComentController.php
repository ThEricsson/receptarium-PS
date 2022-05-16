<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;

class ComentController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Favorite Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de la gestió dels comentaris.
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

    public function create(Request $request){
        
        $id = Auth::user()->id;

        $this->validate($request, [
            'comment' => ['required', 'string', 'max:255'],
        ]);

        $post_id = Post::findOrFail($request->post_id)->id;

        $comment = new Comment;
        $comment->user_id = $id;
        $comment->post_id = $post_id;
        $comment->content = $request->input('comment');
        $comment->save();

        return redirect()->back();


    }


}