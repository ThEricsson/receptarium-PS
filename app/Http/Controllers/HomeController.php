<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Favorite;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $cerca = "";
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        
        return view('home',compact('posts', 'cerca'));
    }

    /**
     * Cerca la cerca de l'usuari a la base de dades, en cas que la cerca 
     * que faci l'usuari sigui nul·la, retornarà totes les receptes.
    * 
     * @return posts
     */
    public function search(Request $request){
        if($request->cerca){
            $cerca = $request->cerca;
        }
        else{
            $cerca = "";
        }
        
        if($request->action == "favs" && Auth::check()){
            
            $posts = Post::whereHas('favorites', function ($query) {
                $query->where('user_id', Auth::id());
            })->where('titol', 'like', '%'.$cerca.'%');
            
        } else {
            $posts = Post::where('titol', 'like', '%'.$cerca.'%');
        }
        
        if($request->dificultat != "all"){
            $dificultat = $request->dificultat;

            $posts = $posts->where('dificultat', $dificultat);

        }

        if($request->tipus != "all"){
            $tipus = $request->tipus;

            $posts = $posts->where('tipus', $tipus);

        }

        if($request->action == "better"){

            $posts = $posts->where('titol', 'like', '%'.$cerca.'%')->withCount('likes')->orderByDesc('likes_count')->paginate(5);

        } else{
            $posts = $posts->orderBy('id', 'desc')->paginate(5);
        }

        return view('home',compact('posts', 'cerca'));

    }
}
