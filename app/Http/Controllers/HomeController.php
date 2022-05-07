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
    $posts = Post::orderBy('id', 'desc')->paginate(5);
        
        return view('home',compact('posts'));
    }
}
