<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Athletics',
                'slug' => 'athletics',
                'icon' => '01JYWZ297EJJ9HQ7VESM9BG5TF.png',
            ],
            [
                'name' => 'Running',
                'slug' => 'running',
                'icon' => '01JYWYZ37Q6A19KFEDXHBTD6DY.png',
            ],
            [
                'name' => 'Slippers',
                'slug' => 'slippers',
                'icon' => '01JYWZ3KB67DWVG3EEGP3HDVJE.png',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'icon' => '01JYWZMDNE4JJFGESWAFSYRG85.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 