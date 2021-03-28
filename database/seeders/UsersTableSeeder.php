<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin BPN Langsa',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'level' => 'admin',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Andra Bekbon',
            'email' => 'andra@gmail.com',
            'password' => bcrypt('password'),
            'level' => 'pegawai',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Eka Pertiwi',
            'email' => 'eka@gmail.com',
            'password' => bcrypt('password'),
            'level' => 'pegawai',
            'remember_token' => Str::random(60),
        ]);
    }
}
