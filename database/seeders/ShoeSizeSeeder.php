<?php

namespace Database\Seeders;

use App\Models\ShoeSize;
use Illuminate\Database\Seeder;

class ShoeSizeSeeder extends Seeder
{
    public function run(): void
    {
        $shoeSizes = [
            // Nike Dunk Low Retro (ID: 1)
            ['size' => 'EU 42', 'shoe_id' => 1],
            ['size' => 'EU 45', 'shoe_id' => 1],
            ['size' => 'EU 50', 'shoe_id' => 1],
            
            // Nike ZoomX Invincible Run Flyknit (ID: 2)
            ['size' => 'EU 40', 'shoe_id' => 2],
            ['size' => 'EU42', 'shoe_id' => 2],
            ['size' => 'EU45', 'shoe_id' => 2],
            
            // Adidas UltraBoost (ID: 3)
            ['size' => 'EU 40', 'shoe_id' => 3],
            ['size' => 'EU 42', 'shoe_id' => 3],
            
            // Chuck Taylor All Star* (ID: 4)
            ['size' => 'EU 42', 'shoe_id' => 4],
            ['size' => 'EU 45', 'shoe_id' => 4],
            ['size' => 'EU 45', 'shoe_id' => 4],
            
            // Chuck Taylor Green (ID: 5)
            ['size' => 'EU 40', 'shoe_id' => 5],
            ['size' => 'EU 42', 'shoe_id' => 5],
            ['size' => 'EU 45', 'shoe_id' => 5],
            ['size' => 'EU 50', 'shoe_id' => 5],
            
            // Chuck Taylor All Star (ID: 6)
            ['size' => 'EU 40', 'shoe_id' => 6],
            ['size' => 'EU 42', 'shoe_id' => 6],
            ['size' => 'EU 45', 'shoe_id' => 6],
            
            // Adidas Adilette Slides (ID: 7)
            ['size' => 'EU 43', 'shoe_id' => 7],
            ['size' => 'EU 45', 'shoe_id' => 7],
        ];

        foreach ($shoeSizes as $size) {
            ShoeSize::create($size);
        }
    }
} 