<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class BackgroundRemovalService
{
    public $apiKey;
    protected $apiUrl = 'https://api.remove.bg/v1.0/removebg';

    public function __construct()
    {
        $this->apiKey = config('services.removebg.api_key');
    }

    /**
     * Remove background from uploaded image
     */
    public function removeBackground(UploadedFile $file): ?string
    {
        try {
            // Check if API key is configured
            if (!$this->apiKey) {
                \Log::warning('Remove.bg API key not configured');
                return null;
            }

            // Prepare the request
            $response = Http::withHeaders([
                'X-Api-Key' => $this->apiKey,
            ])->attach(
                'image_file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post($this->apiUrl, [
                'size' => 'auto',
                'format' => 'png',
            ]);

            if ($response->successful()) {
                // Generate unique filename
                $filename = 'bg-removed-' . uniqid() . '.png';
                $path = 'public/photos/' . $filename;
                
                // Store the processed image
                Storage::put($path, $response->body());
                
                return $path;
            } else {
                \Log::error('Background removal failed: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Background removal error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Remove background from existing image
     */
    public function removeBackgroundFromPath(string $imagePath): ?string
    {
        try {
            if (!Storage::exists($imagePath)) {
                return null;
            }

            $imageContent = Storage::get($imagePath);
            
            // Create temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'bg_removal_');
            file_put_contents($tempFile, $imageContent);

            // Prepare the request
            $response = Http::withHeaders([
                'X-Api-Key' => $this->apiKey,
            ])->attach(
                'image_file',
                file_get_contents($tempFile),
                basename($imagePath)
            )->post($this->apiUrl, [
                'size' => 'auto',
                'format' => 'png',
            ]);

            // Clean up temp file
            unlink($tempFile);

            if ($response->successful()) {
                // Generate unique filename
                $filename = 'bg-removed-' . uniqid() . '.png';
                $newPath = 'public/photos/' . $filename;
                
                // Store the processed image
                Storage::put($newPath, $response->body());
                
                return $newPath;
            } else {
                \Log::error('Background removal failed: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Background removal error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Process all existing images in batch
     */
    public function processAllImages(): array
    {
        $results = [];
        
        // Process shoe thumbnails
        $shoes = \App\Models\Shoe::all();
        foreach ($shoes as $shoe) {
            if ($shoe->thumbnail) {
                $newPath = $this->removeBackgroundFromPath($shoe->thumbnail);
                if ($newPath) {
                    $shoe->update(['thumbnail' => $newPath]);
                    $results[] = "Processed thumbnail for shoe: {$shoe->name}";
                }
            }
        }

        // Process shoe photos
        $photos = \App\Models\ShoePhoto::all();
        foreach ($photos as $photo) {
            if ($photo->photo) {
                $newPath = $this->removeBackgroundFromPath($photo->photo);
                if ($newPath) {
                    $photo->update(['photo' => $newPath]);
                    $results[] = "Processed photo for shoe: {$photo->shoe->name}";
                }
            }
        }

        return $results;
    }
} 