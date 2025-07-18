<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            PromoCodeSeeder::class,
            ShoeSeeder::class,
            ShoePhotoSeeder::class,
            ShoeSizeSeeder::class,
        ]);
    }
}
