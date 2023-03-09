<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\AdminPostController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
//use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\Route;
use App\Services\Newsletter;

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

//Probando Mailchimp:
Route::get('ping', function () {
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us18'
    ]);

    $response = $mailchimp->lists->addListMember("ee6c38ab0d", [
        "email_address" => "mwue111@g.educaand.es", //Esto vendría del input
        "status" => "subscribed",
    ]);

    ddd($response);
});

//Ruta para la newsletter: es un controlador con una única función
Route::post('newsletter', NewsletterController::class);

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

//Administración de posts:

//1. Cambiar el middleware eliminado por can:admin (can:nombre especificado en App\Providers\AppServiceProvider.php)
// Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
// Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
// Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
// Route::post('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
// Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('can:admin');
// Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('can:admin');

//2. Agrupar las rutas y hacer que a todas se aplique el middleware can:admin:
Route::middleware('can:admin')->group(function () {

    //3. Usar resource en lugar del verbo de cada ruta e indicar que NO tenemos el método show:
    Route::resource('admin/posts', AdminPostController::class)->except('show');

    // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    // Route::get('admin/posts', [AdminPostController::class, 'index']);
    // Route::post('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
