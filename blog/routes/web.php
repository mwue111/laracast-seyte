<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
//use Spatie\YamlFrontMatter\YamlFrontMatter;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

//Comentado al usar la función scopeFilter en Post.php

// Route::get('/categories/{category:slug}', function(Category $category) {
//     //load es como with, pero se usa cuando se trabaja sobre un modelo existente. Si se pone $with en Post.php, se debe quitar load aquí.

//     return view('posts', [
//         //'posts' => $category->posts->load(['category', 'author']),   //posts es el método en el modelo de Category.php
//         'posts' => $category->posts,
//         'currentCategory' => $category,
//         'categories' => Category::all()
//     ]);

// })->name('category');

Route::get('/autor/{author:username}', function (User $author){
    return view('posts', [
        //'posts' => $author->posts->load(['category', 'author']),
        'posts' => $author->posts
        //'categories' => Category::all() //'categories' se pasa a través de CategoryDropdown.php (en app\view\components)
    ]);
});
