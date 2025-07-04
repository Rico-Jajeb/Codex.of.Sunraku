<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleDriveService;
use Illuminate\Http\File;

class UploadSqliteToDrive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:upload-sqlite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload database/database.sqlite file to Google Drive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dbPath = database_path('database.sqlite');

        if (!file_exists($dbPath)) {
            $this->error("SQLite database file not found at: {$dbPath}");
            return;
        }

        // Create File instance
        $file = new File($dbPath);

        // Your Google Drive folder ID (or null to upload to root)
        $folderId = '1RJSKJgzuR7nQQg2s69z0fdRRgDXcF9cO'; // ← change this!

     
        $driveService = app(GoogleDriveService::class);

        $result = $driveService->upload($file, $folderId);

        $this->info("Database uploaded successfully! Google Drive link: {$result['link']}");
    }
}
