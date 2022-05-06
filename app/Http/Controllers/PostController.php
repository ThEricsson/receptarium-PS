<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Pas;

class PostController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Post Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de la gestió dels posts.
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
     * Crea i valida tant el post, com els passos
     * que el componen.
     * 
     * @return void
     */
    public function create(Request $request){

        $id = Auth::user()->id;

        $this->validate($request, [
            'titol' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'passos.*' => ['required', 'string', 'max:255'],
            'fotos' =>['required', 'image','mimes:jpg,png,jpeg','dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000']
        ]);
        
        $image_path = $request->file('fotos');

        $path = $image_path->store('posts');

        $fotoname = preg_replace('/^.+[\\\\\\/]/', '', $path);

        /* Creació del post */
        
        $post = new Post;
        $post->user_id = $id;
        $post->titol = $request->input('titol');
        $post->description = $request->input('description');
        $post->image_path = $fotoname;
        $post->save();

        /* Creació dels passos */

        $passos = $request->input('passos');

        foreach ($passos as $pas) {
            $pasdb = new Pas;
            $pasdb->post_id = $post->id;
            $pasdb->content = $pas;
            $pasdb->save();
        }

        return redirect()->route('post.create')
                         ->with(['message'=>'Recepta publicada correctament!']);
    }

    

}