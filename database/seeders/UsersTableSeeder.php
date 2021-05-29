<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('users')->insert([[
            'name' => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin'),
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'name' => 'nhuaman',
            'email'     => 'nhuamancerva@gmail.com',
            'password'  => bcrypt('12345678'),
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ]]);
    }
}
