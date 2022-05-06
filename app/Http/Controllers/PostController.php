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

    public function create(Request $request){

        $user = Auth::user();
        $id = Auth::user()->id;

        dd($request['passos']);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'passos' => ['required', 'string', 'max:255'],
        ]);
     
    }

}