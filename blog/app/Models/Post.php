<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category_id',
    ];

    //protected $guarded = ['id'];

    //Para no tener que poner ni with ni load en el fichero de rutas/controlador cuando se refiera a posts:
    //protected $with = ['category', 'author];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //cambiado user a author: el nombre de la función hace que Laravel asuma que existe author_id, por eso se especifica user_id en la relación.
    public function author(){   //public function user()->no hace falta especificar que la FK es user_id
        return $this->belongsTo(User::class, 'user_id');
    }
}

