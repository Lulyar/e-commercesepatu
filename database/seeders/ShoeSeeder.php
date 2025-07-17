<?php

namespace Database\Seeders;

use App\Models\Shoe;
use Illuminate\Database\Seeder;

class ShoeSeeder extends Seeder
{
    public function run(): void
    {
        $shoes = [
            [
                'name' => 'Nike Dunk Low Retro',
                'slug' => 'nike-dunk-low-retro',
                'thumbnail' => '01JYXNJAM14H1C3NW23N9SC57Z.jpg',
                'about' => 'Siluet klasik Dunk Low dengan perpaduan bahan kulit dan suede yang premium untuk kenyamanan dan gaya. Kombinasi warna ungu dan putih memberikan tampilan yang cerah dan bersih, menjadikannya pilihan yang serbaguna untuk pakaian kasual atau bahkan aktivitas olahraga ringan.',
                'price' => 1500000,
                'stock' => 6,
                'is_popular' => 1,
                'category_id' => 1,
                'brand_id' => 1,
                'rating' => 0.00,
            ],
            [
                'name' => 'Nike ZoomX Invincible Run Flyknit',
                'slug' => 'nike-zoomx-invincible-run-flyknit',
                'thumbnail' => '01JYXNY7NWHVC16BB3WDDGQPBX.webp',
                'about' => 'Desain: Sepatu ini dirancang dengan teknologi ZoomX yang menawarkan kenyamanan ekstra, dengan bantalan yang responsif dan ringan. Desainnya memiliki kombinasi warna putih dan hijau neon yang mencolok, serta detail hitam pada logo Nike, memberikan tampilan yang modern dan energik. Sepatu ini juga didesain untuk memberikan stabilitas dan dukungan ekstra selama lari jarak jauh.',
                'price' => 2500000,
                'stock' => 8,
                'is_popular' => 0,
                'category_id' => 2,
                'brand_id' => 1,
                'rating' => 0.00,
            ],
            [
                'name' => 'Adidas UltraBoost',
                'slug' => 'adidas-ultraboost',
                'thumbnail' => '01JYXQ4G1NE40HWMN15HC1X9VB.png',
                'about' => 'Desain: Sepatu ini menggabungkan desain futuristik dengan kenyamanan tinggi. Bagian atas terbuat dari bahan Primeknit yang elastis dan dapat menyesuaikan dengan bentuk kaki, memberikan kenyamanan maksimal. Bagian midsole menggunakan teknologi Boost, yang dikenal dengan kemampuan menyerap benturan yang sangat baik dan memberikan kembalinya energi yang responsif selama lari. Warna abu-abu yang lembut dengan aksen hijau neon pada bagian sol memberikan tampilan yang segar dan modern.',
                'price' => 3000000,
                'stock' => 6,
                'is_popular' => 1,
                'category_id' => 2,
                'brand_id' => 2,
                'rating' => 0.00,
            ],
            [
                'name' => 'Chuck Taylor All Star*',
                'slug' => 'chuck-taylor-all-star',
                'thumbnail' => '01JYXT5KPP51Q395T20JGM5V8D.webp',
                'about' => 'Converse Canvas Sneakers\nStylish and comfortable with a unique touch of floral design. Perfect for casual days!',
                'price' => 899000,
                'stock' => 8,
                'is_popular' => 1,
                'category_id' => 4,
                'brand_id' => 3,
                'rating' => 0.00,
            ],
            [
                'name' => 'Chuck Taylor Green',
                'slug' => 'chuck-taylor-green',
                'thumbnail' => '01JYXQBQZ0T2HF63452811GDRG.webp',
                'about' => 'IMPIAN NENEKMU\n\nTinggalkan saja sulaman lama itu di rumah. Chucks ini memberimu sentuhan buatan tangan—sejak pertama kali dipakai.',
                'price' => 720000,
                'stock' => 4,
                'is_popular' => 0,
                'category_id' => 4,
                'brand_id' => 3,
                'rating' => 0.00,
            ],
            [
                'name' => 'Chuck Taylor All Star',
                'slug' => 'chuck-taylor-all-star',
                'thumbnail' => '01JYXTKC6EGKF8DCG6XQ2F3PYR.webp',
                'about' => 'Converse Chuck Taylor All-Star White\nClassic and versatile. Timeless design for everyday style and comfort.',
                'price' => 899000,
                'stock' => 6,
                'is_popular' => 1,
                'category_id' => 4,
                'brand_id' => 3,
                'rating' => 0.00,
            ],
            [
                'name' => 'Adidas Adilette Slides',
                'slug' => 'adidas-adilette-slides',
                'thumbnail' => '01JYXTY2GMWKJE8WGS49XPB3AK.webp',
                'about' => 'Desain: Sandal dengan desain minimalis namun tetap stylish, dilengkapi dengan tiga garis ikonik Adidas di bagian atas. Sangat cocok untuk digunakan di rumah, di tepi kolam renang, atau untuk berjalan santai.',
                'price' => 600000,
                'stock' => 4,
                'is_popular' => 1,
                'category_id' => 3,
                'brand_id' => 2,
                'rating' => 0.00,
            ],
        ];

        foreach ($shoes as $shoe) {
            Shoe::create($shoe);
        }
    }
} 