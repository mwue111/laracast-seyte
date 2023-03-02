<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'slug' => 'my-first-post',
            'title' => 'Mi primer post personal desde Seeder',
            'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
            'body' => '<p>Harum perferendis, a eos at quis ab odio ducimus iste. Voluptate sapiente quaerat perferendis temporibus a cum laborum, ullam tempora nisi facilis.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi suscipit libero dignissimos amet qui. Quas ad, saepe unde voluptatem ut beatae consequuntur distinctio sed totam iste cumque reiciendis, impedit fugiat!
            Reiciendis, non perferendis! Itaque harum, dolorum deserunt excepturi dolore assumenda ex sit animi atque voluptatem consequatur similique quas cumque enim quasi corporis alias soluta sunt natus numquam eum quisquam? Exercitationem.</p>'
        ]);
        DB::table('posts')->insert([
            'user_id' => 1,
            'category_id' => 2,
            'slug' => 'my-second-post',
            'title' => 'Mi segundo post de trabajo desde Seeder',
            'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
            'body' => '<p>Harum perferendis, a eos at quis ab odio ducimus iste. Voluptate sapiente quaerat perferendis temporibus a cum laborum, ullam tempora nisi facilis.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi suscipit libero dignissimos amet qui. Quas ad, saepe unde voluptatem ut beatae consequuntur distinctio sed totam iste cumque reiciendis, impedit fugiat!
            Reiciendis, non perferendis! Itaque harum, dolorum deserunt excepturi dolore assumenda ex sit animi atque voluptatem consequatur similique quas cumque enim quasi corporis alias soluta sunt natus numquam eum quisquam? Exercitationem.</p>'
        ]);
        DB::table('posts')->insert([
            'user_id' => 1,
            'category_id' => 3,
            'slug' => 'my-third-post',
            'title' => 'Mi tercer post de hobby desde Seeder',
            'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
            'body' => '<p>Harum perferendis, a eos at quis ab odio ducimus iste. Voluptate sapiente quaerat perferendis temporibus a cum laborum, ullam tempora nisi facilis.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi suscipit libero dignissimos amet qui. Quas ad, saepe unde voluptatem ut beatae consequuntur distinctio sed totam iste cumque reiciendis, impedit fugiat!
            Reiciendis, non perferendis! Itaque harum, dolorum deserunt excepturi dolore assumenda ex sit animi atque voluptatem consequatur similique quas cumque enim quasi corporis alias soluta sunt natus numquam eum quisquam? Exercitationem.</p>'
        ]);
    }
}
