<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Pas;

class ImageController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Image Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de retornar les fotografies emmagatzemades
    | al servidor.
    | 
    |
    */

    /**
     * Retorna l'avatar de l'usuari.
     * 
     * @param filename
     * 
     * @return file
     */
    public function getAvatar($filename){
        
        $file = Storage::disk('users')->get($filename);
        
        return new Response($file,200);
    }

    /**
     * Retorna la imatge de la recepta.
     * 
     * @param filename
     * 
     * @return file
     */
    public function getPostImg($filename){
        
        $file = Storage::disk('posts')->get($filename);
        
        return new Response($file,200);
    }
}