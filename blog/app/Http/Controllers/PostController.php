<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(){

        //dd(request(['search', 'category']));
        //$posts = Post::all(); //Con esto no se trae relaciones salvo que se usen (muchas peticiones, al final)
        //$posts = Post::latest()->with('category', 'author');    //Con esto se trae la clase y sus relaciones en una petición ordenada de más nuevo a más viejo. Se puede sustituir por $with en Post.php.

        //Primera aproximación a búsqueda:
        // if(request('search')){  //si hay una búsqueda...
        //     $posts
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString() //Segunda aproximación a búsqueda: con queryScope (creando scopeFilter en el modelo Post.php) y llamando a esa función como filter() aquí
            //'categories' => Category::all(),    //'categories' se pasa a través de CategoryDropdown.php (en app\view\components)
            //'currentCategory' => Category::firstWhere('slug', request('category'))    //se pasa a como 'categories'
        ]);
    }

    public function show(Post $post){   //Para que el binding funcione deben coincidir los nombres {post} y $post

        return view('posts.show', ['post' => $post]);
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

        return view('posts.create');
    }

    public function store(){

        //Guardar el archivo que viene desde thumbnail en un directorio llamado thumbnails
        //Prueba:
        // $path = request()->file('thumbnail')->store('thumbnails', 'public');

        // return 'Ok ' . $path;

        $attributes = request()->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug', //El slug de la tabla post, columna slug, debe ser único.
            'thumbnail' => 'required|image',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id' //category_id debe existir en la tabla categoría, columna id
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');

        Post::create($attributes);

        return redirect('/');
    }
}
