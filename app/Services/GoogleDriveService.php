<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Http\UploadedFile;

//new
use Google\Service\Drive as GoogleServiceDrive;
use Illuminate\Http\File;
use Google\Client as GoogleClient;

use App\Models\SystemModel;

class GoogleDriveService
{
  
   protected $service;

 
      public function __construct()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        // $client->refreshToken(config('services.google.refresh_token'));

        // Fetch refresh token from DB
        $refreshToken = SystemModel::first()?->refresh_token;

        if (!$refreshToken) {
            throw new \Exception('Google Drive refresh token not found in database.');
        }

        $client->refreshToken($refreshToken);

        $this->service = new GoogleServiceDrive($client);
    }

    
    
// amo ini an kanan automatic pag upload
//    public function upload(File $file, string $folderId = null): array
//     {
//         $fileMetadata = new GoogleServiceDrive\DriveFile([
//             'name' => 'database_' . now()->format('Ymd_His') . '.sqlite',
//             'parents' => $folderId ? [$folderId] : [],
//         ]);

//         $content = file_get_contents($file->getRealPath());

//         $uploadedFile = $this->service->files->create($fileMetadata, [
//             'data' => $content,
//             'mimeType' => mime_content_type($file->getRealPath()),
//             'uploadType' => 'multipart',
//             'fields' => 'id, webViewLink',
//         ]);

//         return [
//             'id' => $uploadedFile->id,
//             'link' => $uploadedFile->webViewLink,
//         ];
//     }








  public function uploadFromPath(string $path, string $name = null, string $folderId = null): array
    {
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $name ?? basename($path),
            'parents' => $folderId ? [$folderId] : [],
        ]);

        $content = file_get_contents($path);
        $mimeType = mime_content_type($path);

        $uploadedFile = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink',
        ]);

        return [
            'id' => $uploadedFile->id,
            'link' => $uploadedFile->webViewLink,
        ];
    }




}
