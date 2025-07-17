<?php

namespace App\Observers;

use App\Models\ShoePhoto;
use App\Services\BackgroundRemovalService;

class ShoePhotoObserver
{
    protected $backgroundRemovalService;

    public function __construct(BackgroundRemovalService $backgroundRemovalService)
    {
        $this->backgroundRemovalService = $backgroundRemovalService;
    }

    /**
     * Handle the ShoePhoto "created" event.
     */
    public function created(ShoePhoto $shoePhoto): void
    {
        // Auto remove background for new photos
        if ($shoePhoto->photo) {
            $newPath = $this->backgroundRemovalService->removeBackgroundFromPath($shoePhoto->photo);
            if ($newPath) {
                $shoePhoto->update(['photo' => $newPath]);
            }
        }
    }

    /**
     * Handle the ShoePhoto "updated" event.
     */
    public function updated(ShoePhoto $shoePhoto): void
    {
        // Handle background removal for updated photos if needed
    }

    /**
     * Handle the ShoePhoto "deleted" event.
     */
    public function deleted(ShoePhoto $shoePhoto): void
    {
        // Clean up processed images if needed
    }
} 