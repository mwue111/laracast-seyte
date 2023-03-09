<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create(){

        //Hacer que sólo el admin pueda entrar a la url en la que se crea un post - opciones:

        //Ningún guest puede entrar:
        // if(auth()->guest()){
        //     abort(Response::HTTP_FORBIDDEN);    //abort(403): FORBIDEN
        // }

        // //Ningún usuario que no sea test puede entrar:
        // if(auth()->user()->username !== 'test') {
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        //Si hay un usuario registrado y su nombre no es test, no puede entrar: esto se mueve a middleware
        // if(auth()->user()?->username !== 'test') {
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        return view('admin.posts.create');
    }

    public function store(){

        //Guardar el archivo que viene desde thumbnail en un directorio llamado thumbnails
        //Prueba:
        // $path = request()->file('thumbnail')->store('thumbnails', 'public');

        // return 'Ok ' . $path;

        //Primera aproximación: luego se unifica con el método validatePost (en este mismo controlador)
        // $attributes = request()->validate([
        //     'title' => 'required',
        //     'slug' => 'required|unique:posts,slug', //El slug de la tabla post, columna slug, debe ser único.
        //     'thumbnail' => 'required|image',
        //     'excerpt' => 'required',
        //     'body' => 'required',
        //     'category_id' => 'required|exists:categories,id' //category_id debe existir en la tabla categoría, columna id
        // ]);

        $post = new Post();

        //$attributes = $this->validatePost(); //Podemos ahorrarnos pasarle el post y que validatePost sepa que debe tener uno, para eso hay que poner (?Post $post = null) como parámetro de entrada en validatePost y declarar dentro de la función $post ??= new Post() (si no hay post declarado, que sea un nuevo objeto)

        $attributes = $this->validatePost($post);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post){
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post){
        //Antes de mover la validación a validatePost:
        // $attributes = request()->validate([
        //     'title' => 'required',
        //     'thumbnail' => 'image',
        //     'slug' => 'required',   //['required', Rule::unique('posts', 'slug')->ignore($post->id)] para que se pueda editar (si se dejara daría fallo porque el slug ya existe)
        //     'excerpt' => 'required',
        //     'body' => 'required',
        //     'category_id' => 'required|exists:categories,id'
        // ]);

        $attributes = $this->validatePost($post);

        if(isset($attributes['thumbnail'])){    // = $attributes['thumbnail] ?? false (asume que no hay thumbnail, pero si hay que sea lo que hay entre llaves a continuación)
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
        }

        $post->update($attributes);


        return back()->with('success', 'Post actualizado.');
    }

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'Post eliminado');
    }

    public function validatePost(Post $post) {

        return request()->validate([
            'title' => 'required',
            'slug' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],  //Si el post existe, debe ser una imagen. Si no, además es required.
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

    }
}

