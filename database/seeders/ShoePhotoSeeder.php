<?php

namespace Database\Seeders;

use App\Models\ShoePhoto;
use Illuminate\Database\Seeder;

class ShoePhotoSeeder extends Seeder
{
    public function run(): void
    {
        $shoePhotos = [
            // Nike Dunk Low Retro (ID: 1)
            ['photo' => '01JYXNJAM8P7HDQM3WCX18YQVQ.avif', 'shoe_id' => 1],
            ['photo' => '01JYXNJAME4BDS2JCXCEGPQ9CW.avif', 'shoe_id' => 1],
            ['photo' => '01JYXNJAMMQP31HJJW4B6E015E.avif', 'shoe_id' => 1],
            ['photo' => '01JYXNJAMV6JMTEX39BNNGVB01.avif', 'shoe_id' => 1],
            
            // Nike ZoomX Invincible Run Flyknit (ID: 2)
            ['photo' => '01JYXNY7P016QXR20BX7HXCGGT.webp', 'shoe_id' => 2],
            ['photo' => '01JYXNZEJJA3ZHPX2RCCAVDEJ3.webp', 'shoe_id' => 2],
            ['photo' => '01JYXNZEJNVCX0V8GDQCDZ4J8B.webp', 'shoe_id' => 2],
            
            // Adidas UltraBoost (ID: 3)
            ['photo' => '01JYXP9GNH13TZPZA997R80YWH.png', 'shoe_id' => 3],
            ['photo' => '01JYXP9GNNXW4G6K8ZQ03CM92V.png', 'shoe_id' => 3],
            ['photo' => '01JYXP9GNVM3Q1XW5B0WWF2REN.png', 'shoe_id' => 3],
            ['photo' => '01JYXP9GNZQSV75WFWT3AGKFBF.png', 'shoe_id' => 3],
            
            // Chuck Taylor All Star* (ID: 4)
            ['photo' => '01JYXT5KPYMTJ84Z6DHR23FKSM.webp', 'shoe_id' => 4],
            ['photo' => '01JYXT5KQ21ZJXK0C1KWXS79C0.webp', 'shoe_id' => 4],
            ['photo' => '01JYXT5KQ7HBZ0Z2GMD8PSZT5T.webp', 'shoe_id' => 4],
            ['photo' => '01JYXT5KQBDSNKYNMY1H5PSHQB.webp', 'shoe_id' => 4],
            ['photo' => '01JYXT5KQGNBZG0YPW46AAT25P.webp', 'shoe_id' => 4],
            
            // Chuck Taylor Green (ID: 5)
            ['photo' => '01JYXQBQZ6PRFB2WPH3SSQ07SB.webp', 'shoe_id' => 5],
            ['photo' => '01JYXQBQZA4ZKNMSAH03HMDQ7D.webp', 'shoe_id' => 5],
            ['photo' => '01JYXQBQZF1YN08H0JEWN7THNX.webp', 'shoe_id' => 5],
            ['photo' => '01JYXQBQZMJ4TYEQP98FHQ24FW.webp', 'shoe_id' => 5],
            
            // Chuck Taylor All Star (ID: 6)
            ['photo' => '01JYXTKC6QABEHPW7VRCSYG0T8.webp', 'shoe_id' => 6],
            ['photo' => '01JYXTKC6WPPTE3C96470D9F1V.webp', 'shoe_id' => 6],
            ['photo' => '01JYXTKC71M6H5WZC07XSM997K.webp', 'shoe_id' => 6],
            ['photo' => '01JYXTKC7677JHC8Y6EX81CBVG.webp', 'shoe_id' => 6],
            
            // Adidas Adilette Slides (ID: 7)
            ['photo' => '01JYXTY2GV3SEANT90QJC6TVTK.webp', 'shoe_id' => 7],
            ['photo' => '01JYXTY2H0YC123Z7VKH5KQWBV.webp', 'shoe_id' => 7],
            ['photo' => '01JYXTY2H6GJFPT7N6AD5CYDVD.webp', 'shoe_id' => 7],
        ];

        foreach ($shoePhotos as $photo) {
            ShoePhoto::create($photo);
        }
    }
} 