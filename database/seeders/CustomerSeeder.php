<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'phone' => '085727997837',
            'address' => 'Jl. Test No. 123, Jakarta',
        ]);
    }
}
