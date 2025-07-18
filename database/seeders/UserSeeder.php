<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Gemma Albani',
            'email' => 'gemmaalbani34@gmail.com',
            'password' => 'albani117102', // akan di-hash otomatis
        ]);
        User::create([
            'name' => 'Luly Admin',
            'email' => 'luly@gmail.com',
            'password' => '12345', // akan di-hash otomatis
        ]);
    }
}
