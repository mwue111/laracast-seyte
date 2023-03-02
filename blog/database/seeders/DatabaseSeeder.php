<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //si usamos migrate:fresh --seed no es necesario truncate
        // User::truncate();
        // Category::truncate();
        // Post::truncate();

        $user = User::factory()->create([   //se puede crear desde factoría con un atributo concreto
            'name' => 'Jane Doe'
        ]);

        //Esto ya crea usuarios y categorías. Se puede sobreescribir el id del usuario si queremos que sea uno en concreto.
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

        //$this->call(PostsTableSeeder::class);

        // $user = User::factory()->create();

        // Category::create([
        //     'name'=>'Personal',
        //     'slug'=>'personal'
        // ]);
        // Category::create([
        //     'name'=>'Family',
        //     'slug'=>'family'
        // ]);
        // Category::create([
        //     'name'=>'Hobbies',
        //     'slug'=>'hobbies'
        // ]);
        // \App\Models\User::factory(10)->create();
    }
}
