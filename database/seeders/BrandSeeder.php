<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'logo' => '01JYXGKJ5KY45YRQEJ3SJ6XXRP.png',
            ],
            [
                'name' => 'Adiddas',
                'slug' => 'adiddas',
                'logo' => '01JYXGN7VGQKXEXSHBM37ZQ5K4.png',
            ],
            [
                'name' => 'Converse',
                'slug' => 'converse',
                'logo' => '01JYXGPQGXNHZASG8YC7DWW9SD.png',
            ],
            [
                'name' => 'Compass',
                'slug' => 'compass',
                'logo' => '01JYXN65X7XSSG1DE95STM5RS6.jpg',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
} 