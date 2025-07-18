<?php

namespace App\Console\Commands;

use App\Services\BackgroundRemovalService;
use Illuminate\Console\Command;

class RemoveBackgroundCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:remove-background {--all : Process all existing images} {--shoe= : Process specific shoe ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove background from shoe images using AI';

    protected $backgroundRemovalService;

    public function __construct(BackgroundRemovalService $backgroundRemovalService)
    {
        parent::__construct();
        $this->backgroundRemovalService = $backgroundRemovalService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->backgroundRemovalService->apiKey) {
            $this->error('Remove.bg API key not configured. Please add REMOVEBG_API_KEY to your .env file');
            return 1;
        }

        if ($this->option('all')) {
            $this->info('Processing all existing images...');
            $results = $this->backgroundRemovalService->processAllImages();
            
            foreach ($results as $result) {
                $this->info($result);
            }
            
            $this->info('Background removal completed!');
        } elseif ($shoeId = $this->option('shoe')) {
            $this->info("Processing images for shoe ID: {$shoeId}");
            // Process specific shoe
            $shoe = \App\Models\Shoe::find($shoeId);
            if ($shoe) {
                if ($shoe->thumbnail) {
                    $newPath = $this->backgroundRemovalService->removeBackgroundFromPath($shoe->thumbnail);
                    if ($newPath) {
                        $shoe->update(['thumbnail' => $newPath]);
                        $this->info("Processed thumbnail for shoe: {$shoe->name}");
                    }
                }
                
                foreach ($shoe->photos as $photo) {
                    if ($photo->photo) {
                        $newPath = $this->backgroundRemovalService->removeBackgroundFromPath($photo->photo);
                        if ($newPath) {
                            $photo->update(['photo' => $newPath]);
                            $this->info("Processed photo for shoe: {$shoe->name}");
                        }
                    }
                }
            } else {
                $this->error("Shoe with ID {$shoeId} not found");
            }
        } else {
            $this->error('Please specify --all to process all images or --shoe=ID for specific shoe');
            return 1;
        }

        return 0;
    }
}
