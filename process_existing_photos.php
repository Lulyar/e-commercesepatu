<?php

require_once 'vendor/autoload.php';

use App\Services\BackgroundRemovalService;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Background Removal for Existing Photos ===\n\n";

// Check if API key is configured
$apiKey = env('REMOVEBG_API_KEY');
if (!$apiKey) {
    echo "❌ REMOVEBG_API_KEY not configured in .env file\n";
    echo "Please add: REMOVEBG_API_KEY=your_api_key_here\n";
    exit(1);
}

$service = new BackgroundRemovalService();

// Process photos from thumbnails folder
echo "📁 Processing photos from public/assets/images/thumbnails/\n";
$thumbnailPath = 'public/assets/images/thumbnails/';
$files = [
    'Nike Air Humara Shoes (1).png',
    'Nike Air Humara Shoes (2).png',
    'image1.png',
    'image2.png',
    'photo1.png',
    'photo2.png',
    'photo3.png',
    'photo4.png',
    'photo5.png',
    'photo6.png',
    'photo7.png'
];

foreach ($files as $file) {
    $fullPath = $thumbnailPath . $file;
    if (file_exists($fullPath)) {
        echo "Processing: {$file}\n";
        $newPath = $service->removeBackgroundFromPath($fullPath);
        if ($newPath) {
            echo "✅ Success: {$file} -> {$newPath}\n";
        } else {
            echo "❌ Failed: {$file}\n";
        }
    }
}

echo "\n📁 Processing photos from storage/app/public/\n";

// Get all image files from storage
$storagePath = 'storage/app/public/';
$imageFiles = glob($storagePath . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);

foreach ($imageFiles as $file) {
    $filename = basename($file);
    echo "Processing: {$filename}\n";
    $newPath = $service->removeBackgroundFromPath($file);
    if ($newPath) {
        echo "✅ Success: {$filename} -> {$newPath}\n";
    } else {
        echo "❌ Failed: {$filename}\n";
    }
}

echo "\n🎉 Background removal process completed!\n";
echo "Check storage/app/public/ for processed images with 'bg-removed-' prefix\n"; 