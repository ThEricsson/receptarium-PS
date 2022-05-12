<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
            $posts = Post::where('titol', 'like', '%'.$cerca.'%')->orderBy('id', 'desc')->paginate(5);
        }else{
            $cerca = "";
            $posts = Post::orderBy('id', 'desc')->paginate(5);
        }

        return view('home',compact('posts', 'cerca'));

    }
}
