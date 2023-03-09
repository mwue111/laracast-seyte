<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'slug',
    //     'excerpt',
    //     'body',
    //     'category_id',
    // ];

    //protected $guarded = ['id'];
    protected $guarded = [];

    //Para no tener que poner ni with ni load en el fichero de rutas/controlador cuando se refiera a posts:
    protected $with = ['category', 'author'];

    //Crear un método de busqueda (queryScope): $query se le pasa por Laravel automáticamente, es el queryBuilder.
    //el array de filtros es para que el modelo no tenga acceso a request('search'), porque no es su función.
    //el controlador se encarga del request('search'), lo convierte en array como request(['search']) y lo envía aquí
    public function scopeFilter($query, array $filters) {

        //Primera aproximación: usando request('search') aquí:
        // if($filters['search'] ?? false){
            //     $query
            //         ->where('title', 'like', '%' . request('search') . '%')
            //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        //segunda aproximación: no funciona porque cuando hay más de un criterio de filtro (p.ej, palabra + categoría) devuelve todo lo que cumpla el criterio del search sí o sí + el otro criterio (devuelve más de una categoría cuando hay varios títulos con una palabra que se ha buscado)
        // $query->when($filters['search'] ?? false, function($query, $search) {
        //     $query
        //     ->where('title', 'like', '%' . $search . '%')
        //     ->orWhere('body', 'like', '%' . $search . '%');
        // });

        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where(function($query) use($search){
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        //Hacer lo mismo pero con el dropdown de categorías:
        $query->when($filters['category'] ?? false, function($query, $category) {
            //Primera aproximación:
            // $query
            //     ->whereExists(function($query) use ($category){
            //         $query->from('categories')  //tabla
            //            ->whereColumn('categories.id', 'posts.category_id') //si se usa where en lugar de whereColumn, toma 'posts.category_id' como un string
            //            ->where('categories.slug', $category);
            //      });

            //Segunda aproximación:
            $query->whereHas('category', function($query) use($category){ //'category' es la función category() de aquí
                //dd($category);
                $query
                    ->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, function($query, $author) {
            $query->whereHas('author', function($query) use ($author){
                $query
                    ->where('username', $author);
            });
        });

    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //cambiado user a author: el nombre de la función hace que Laravel asuma que existe author_id, por eso se especifica user_id en la relación.
    public function author(){   //public function user()->no hace falta especificar que la FK es user_id
        return $this->belongsTo(User::class, 'user_id');
    }
}

