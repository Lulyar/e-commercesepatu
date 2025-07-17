<?php

namespace App\Observers;

use App\Models\Shoe;
use App\Services\BackgroundRemovalService;

class ShoeObserver
{
    protected $backgroundRemovalService;

    public function __construct(BackgroundRemovalService $backgroundRemovalService)
    {
        $this->backgroundRemovalService = $backgroundRemovalService;
    }

    /**
     * Handle the Shoe "created" event.
     */
    public function created(Shoe $shoe): void
    {
        // Auto remove background for new thumbnails
        if ($shoe->thumbnail) {
            $newPath = $this->backgroundRemovalService->removeBackgroundFromPath($shoe->thumbnail);
            if ($newPath) {
                $shoe->update(['thumbnail' => $newPath]);
            }
        }
    }

    /**
     * Handle the Shoe "updated" event.
     */
    public function updated(Shoe $shoe): void
    {
        // Handle background removal for updated thumbnails if needed
        if ($shoe->wasChanged('thumbnail') && $shoe->thumbnail) {
            $newPath = $this->backgroundRemovalService->removeBackgroundFromPath($shoe->thumbnail);
            if ($newPath) {
                $shoe->update(['thumbnail' => $newPath]);
            }
        }
    }

    /**
     * Handle the Shoe "deleted" event.
     */
    public function deleted(Shoe $shoe): void
    {
        // Clean up processed images if needed
    }
} 