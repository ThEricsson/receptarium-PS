<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\ComprovaContrasenya;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de validar les actualitzacions de
    | les dades de l'usuari, del canvi de contrasenya i de la cerca d'avatars.
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
     * Valida les dades introduïdes per l'usuari abans d'actualitzar-les.
     * 
     * @param request
     * 
     * @return void
     */
    public function update(Request $request){

        $user = Auth::user();
        $id = Auth::user()->id;

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'description' => ['nullable','string', 'max:500'],
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'avatar' =>['image','mimes:jpg,png,jpeg','dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000']
        ]);
     
        $image_path = $request->file('avatar');

        if($image_path){

            $path = $image_path->store('users');

            $avatarname = preg_replace('/^.+[\\\\\\/]/', '', $path);

            $user->image = $avatarname;
        }

        $user->name=$request->input('name');
        $user->surname=$request->input('surname');
        $user->description=$request->input('description');
        $user->nick=$request->input('nick');
        $user->email=$request->input('email');

        $user->update();

        return redirect()->route('user.edit')
                         ->with(['message'=>'Usuari actualitzat correctament']);
    }

    /**
     * Valida que l'usuari conegui la contrasenya antiga i la canvia per la nova.
     * 
     * @param request
     * 
     * @return void
     */
    public function updatepass(Request $request){

        $user = Auth::user();

        $request->validate([

            'old_password' => ['required', new ComprovaContrasenya],
            'new_password' => ['required'],
            'confirm_new_password' => ['same:new_password'],

        ]);

        $user->password = Hash::make($request->new_password);

        $user->update();

        return redirect()->route('user.editpass')
                         ->with(['message'=>'Contrasenya actualitzada correctament!']);

    }

}