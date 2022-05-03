<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Rules\ComprovaContrasenya;

class UserController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | Aquest controlador s'encarrega de validar les actualitzacions de
    | les dades de l'usuari i del canvi de contrasenya
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
     * @return void
     */
    public function update(Request $request){

        $user = Auth::user();
        $id = Auth::user()->id;

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        $user->name=$request->input('name');
        $user->surname=$request->input('surname');
        $user->nick=$request->input('nick');
        $user->email=$request->input('email');

        $user->update();

        return redirect()->route('user.edit')
                         ->with(['message'=>'Usuari actualitzat correctament']);
    }

    /**
     * Valida que l'usuari conegui la contrasenya antiga i la canvia per la nova.
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

        /* Enviar un missatge si falla la validacó
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }*/

        $user->password = Hash::make($request->new_password);

        $user->update();

        return redirect()->route('user.editpass')
                         ->with(['message'=>'Contrasenya actualitzada correctament!']);

    }

}