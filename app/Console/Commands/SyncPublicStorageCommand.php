<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class SyncPublicStorageCommand extends Command
{
    protected $signature = 'sync:public-storage';
    protected $description = 'Sync all files from storage/app/public to public/storage (for Windows/XAMPP symlink issues)';

    public function handle()
    {
        $source = storage_path('app/public');
        $destination = public_path('storage');
        $filesystem = new Filesystem();

        $this->info("Syncing files from $source to $destination ...");
        $this->copyDirectory($filesystem, $source, $destination);
        $this->info('Sync completed!');
    }

    private function copyDirectory(Filesystem $filesystem, $source, $destination)
    {
        if (!is_dir($source)) {
            $this->error("Source directory does not exist: $source");
            return;
        }
        if (!is_dir($destination)) {
            mkdir($destination, 0777, true);
        }
        $items = scandir($source);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            $src = $source . DIRECTORY_SEPARATOR . $item;
            $dst = $destination . DIRECTORY_SEPARATOR . $item;
            if (is_dir($src)) {
                $this->copyDirectory($filesystem, $src, $dst);
            } else {
                if (!is_dir(dirname($dst))) {
                    mkdir(dirname($dst), 0777, true);
                }
                copy($src, $dst);
                // Set permission (Windows: will be ignored, Linux: will work)
                @chmod($dst, 0777);
            }
        }
    }
} 