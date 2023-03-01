<?php
namespace App\Models;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

class Post {

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all(){

        return cache() -> rememberForever('posts.all', function(){
            //tercera aproximación: una colección que con un primer mapeo recoge $file y los envía como $document a un segundo mapeo
            $files = File::files(resource_path("posts"));
            $posts = collect($files)
                ->map(function($file){
                    return YamlFrontMatter::parseFile($file);
                })
                ->map(function ($document) {
                    return new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug
                    );
                })
                ->sortByDesc('date');
                return $posts;
        });


    //segunda aproximación: un array_map puede ser una colección
    // $posts = [];
    // $posts = array_map(function($file){
    //     $document = YamlFrontMatter::parseFile($file);

    //     return new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );

    // }, $files);

    //primera aproximación: si en un foreach se meten datos en un array, se puede usar array_map.
    //posts = [];
    // foreach($files as $file) {
    //     $document = YamlFrontMatter::parseFile($file);
    //     $posts[] = new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );
    // }

    }

    public static function find($slug){
        //segunda aproximación: haciendo uso de la colección en all():
        $posts = static::all();

        return $posts->firstWhere('slug', $slug);

        //primera aproximación: navegar en los ficheros de resource (file database), guardar en caché y devolver el post
        // $path = resource_path("posts/{$slug}.html");

        // if(!file_exists($path)){
        //     throw new ModelNotFoundException();
        // }

        // return cache()->remember("posts.{$slug}", now()->addMinutes(20), function() use($path){
        //     return file_get_contents($path);
        // });
    }
}

?>
