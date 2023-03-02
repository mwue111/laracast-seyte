<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'name' => 'admin',
            'slug' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'is_admin' => true
        ]);
    }
}
