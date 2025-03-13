<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DeleteOldExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exports:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete exported XLSX files older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = storage_path('app/filament_exports'); // Main export directory

        if (!File::exists($directory)) {
            $this->info('Filament export directory does not exist.');
            return;
        }

        $folders = File::directories($directory); // Get all subdirectories

        foreach ($folders as $folder) {
            $files = File::files($folder);
            $allOld = true;

            foreach ($files as $file) {
                if (Carbon::createFromTimestamp($file->getMTime())->addDay()->isFuture()) {
                    $allOld = false; // If even one file is less than 24 hours old, keep the folder
                    break;
                }
            }

            if ($allOld) {
                File::deleteDirectory($folder);
                $this->info("Deleted folder and all its files: {$folder}");
            }
        }

        $this->info('Old Filament exports cleaned up successfully.');
    }
}
