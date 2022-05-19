<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Pas;
use App\Models\Ingredient;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Comment;

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
            'description' => ['required', 'string', 'max:1000'],
            'passos.*' => ['required', 'string', 'max:1000'],
            'ingredients.*' => ['required', 'string', 'max:1000'],
            'fotos' =>['required', 'image','mimes:jpg,png,jpeg','dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'],
            'dificultat' => ['required', Rule::in(['facil', 'normal', 'dificil'])],
            'tipus' => ['required', Rule::in(['entrant', 'principal', 'postre'])]
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
        $post->dificultat = $request->input('dificultat');
        $post->tipus = $request->input('tipus');
        $post->save();

        /* Creació dels passos */

        $passos = $request->input('passos');

        foreach ($passos as $pas) {
            $pasdb = new Pas;
            $pasdb->post_id = $post->id;
            $pasdb->content = $pas;
            $pasdb->save();
        }

        /* Creació dels ingredients */

        $ingredients = $request->input('ingredients');

        foreach ($ingredients as $ingredient) {
            $ingredientdb = new Ingredient;
            $ingredientdb->post_id = $post->id;
            $ingredientdb->content = $ingredient;
            $ingredientdb->save();
        }

        return redirect()->route('post.create')
                         ->with(['message'=>'Recepta publicada correctament!']);
    }

    /**
     * Actualitza i valida tant el post, comprovant que cada ingredient i pas 
     * siguin d'aquesta recepta, validant que l'usuari que l'edita sigui el propietari.
     * 
     * @return void
     */
    public function update(Request $request){

        $post = Post::findOrFail($request->post_id);
        $user_id = Auth::user()->id;

        if($post->user_id == $user_id){
            $this->validate($request, [
                'titol' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:1000'],
                'passos.*' => ['required', 'string', 'max:1000'],
                'ingredients.*' => ['required', 'string', 'max:1000'],
                'fotos' =>['required', 'image','mimes:jpg,png,jpeg','dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'],
                'dificultat' => ['required', Rule::in(['facil', 'normal', 'dificil'])],
                'tipus' => ['required', Rule::in(['entrant', 'principal', 'postre'])]
            ]);
            
            /* Actualització dels passos */
    
            $passos = $request->input('passos');
            $passos_ids = json_decode($request->passos_ids);
            $index = 0;
            
            foreach ($passos as $pas) {
                $pasdb = Pas::findOrFail($passos_ids[$index]);

                if($pasdb->post->user->id == $user_id){
                    $pasdb->content = $pas;
                    $pasdb->update();
                    $index += 1;
                } else {
                    return abort(405);
                }
            }

            /* Actualització dels ingredients */
    
            $ingredients = $request->input('ingredients');
            $ingredients_ids = json_decode($request->ingredients_ids);
            $index = 0;
            
            foreach ($ingredients as $ingredient) {
                $ingredientdb = Ingredient::findOrFail($ingredients_ids[$index]);

                if($ingredientdb->post->user->id == $user_id){
                    $ingredientdb->content = $ingredient;
                    $ingredientdb->update();
                    $index += 1;
                } else {
                    return abort(405);
                }
            }
            
            $image_path = $request->file('fotos');
    
            $path = $image_path->store('posts');
    
            $fotoname = preg_replace('/^.+[\\\\\\/]/', '', $path);
    
            /* Actualització del post */
            $post->titol = $request->input('titol');
            $post->description = $request->input('description');
            $post->image_path = $fotoname;
            $post->dificultat = $request->input('dificultat');
            $post->tipus = $request->input('tipus');
            $post->update();
    
            return redirect()->back()
                             ->with(['message'=>'Recepta publicada correctament!']);
        } else {
            abort(405);
        }
        
    }

    /**
     * Elimina el post enviat com paràmetre.
     * 
     * @return void
     */
    public function delete(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        if ($post->user_id == Auth::user()->id){

            Like::where('post_id', $post->id)->delete();

            Favorite::where('post_id', $post->id)->delete();

            Pas::where('post_id', $post->id)->delete();

            Ingredient::where('post_id', $post->id)->delete();

            Comment::where('post_id', $post->id)->delete();

            $post->delete();

            return redirect()->back();
            
        } else {
            return abort(403);
        }

    }

    
}