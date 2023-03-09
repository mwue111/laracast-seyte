<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentsController extends Controller
{
    //Guardar un nuevo comentario en un post concreto
    public function store(Post $post) {
        //dd(request()->user()->id); //Para ver lo que llega al método

        //validar datos
        request()->validate([
            'body' => 'required'
        ]);

        //crear el comentario en la base de datos
        $post->comments()->create([   //El método comments del modelo
            //El id del post ya lo tengo por Post $post
            'user_id' => request()->user()->id, //aquí - 6:58 vídeo 56
            'body' => request('body')
        ]);

        //redirigir a la página anterior
        return back();

    }
}
