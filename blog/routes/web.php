<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;
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

//Comentado al crear la búsqueda de autor dentro de la función scope en Post.php

// Route::get('/author/{author:username}', function (User $author){
//     return view('posts.index', [
//         //'posts' => $author->posts->load(['category', 'author']),
//         'posts' => $author->posts
//         //'categories' => Category::all() //'categories' se pasa a través de CategoryDropdown.php (en app\view\components)
//     ]);
// });

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');
