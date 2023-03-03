<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(){

        //dd(request(['search', 'category']));
        //$posts = Post::all(); //Con esto no se trae relaciones salvo que se usen (muchas peticiones, al final)
        //$posts = Post::latest()->with('category', 'author');    //Con esto se trae la clase y sus relaciones en una petición ordenada de más nuevo a más viejo. Se puede sustituir por $with en Post.php.
        $posts = Post::latest();

        //Primera aproximación a búsqueda:
        // if(request('search')){  //si hay una búsqueda...
        //     $posts
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        return view('posts.index', [
            'posts' => $posts->filter(request(['search', 'category']))->get(), //Segunda aproximación a búsqueda: con queryScope (creando scopeFilter en el modelo Post.php) y llamando a esa función como filter() aquí
            //'categories' => Category::all(),    //'categories' se pasa a través de CategoryDropdown.php (en app\view\components)
            //'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }

    public function show(Post $post){   //Para que el binding funcione deben coincidir los nombres {post} y $post

        return view('posts.show', ['post' => $post]);
    }
}
