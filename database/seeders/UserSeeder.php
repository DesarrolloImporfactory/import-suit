<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        User::create([
            'name' => 'Ariel Taipe',
            'email' => 'ariel.12isaias@gmail.com',
            'password' => md5(12345678),
        ])->assignRole('Admin');
    }
}
