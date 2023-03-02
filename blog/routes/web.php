<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //$posts = Post::all(); //Con esto no se trae relaciones salvo que se usen (muchas peticiones, al final)
    $posts = Post::latest()->with('category', 'author')->get(); //Con esto se trae la clase y sus relaciones en una petición ordenada de más nuevo a más viejo. Se puede sustituir por $with en Post.php.
    return view('posts', ['posts' => $posts]);
});

Route::get('/posts/{post:slug}', function(Post $post) {  //Para que el binding funcione deben coincidir los nombres {post} y $post
    return view('post', ['post' => $post]);
});

Route::get('/categoria/{category:slug}', function(Category $category) {
    //load es como with, pero se usa cuando se trabaja sobre un modelo existente. Si se pone $with en Post.php, se debe quitar load aquí.
    return view('posts', ['posts' => $category->posts->load(['category', 'author'])]);    //posts es el método en el modelo de Category.php
});

Route::get('/autor/{author:username}', function (User $author){
    return view('posts', ['posts' => $author->posts->load(['category', 'author'])]);
});
