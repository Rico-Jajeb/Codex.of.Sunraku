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

class GoogleDriveService
{
    // protected Google_Service_Drive $service;
   protected $service;
    // public function __construct()
    // {
    //     $client = new Google_Client();
    //     $client->setClientId(config('services.google.client_id'));
    //     $client->setClientSecret(config('services.google.client_secret'));
    //     $client->refreshToken(config('services.google.refresh_token'));

    //     $this->service = new Google_Service_Drive($client);
    // }
 
      public function __construct()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->refreshToken(config('services.google.refresh_token'));

        $this->service = new GoogleServiceDrive($client);
    }

    // public function upload(UploadedFile $file, string $folderId = null): array
    // {
    //     $fileMetadata = new Google_Service_Drive_DriveFile([
    //         'name' => $file->getClientOriginalName(),
    //         'parents' => $folderId ? [$folderId] : [],
    //     ]);

    //     $content = file_get_contents($file->getRealPath());

    //     $uploadedFile = $this->service->files->create($fileMetadata, [
    //         'data' => $content,
    //         'mimeType' => $file->getMimeType(),
    //         'uploadType' => 'multipart',
    //         'fields' => 'id, webViewLink',
    //     ]);

    //     return [
    //         'id' => $uploadedFile->id,
    //         'link' => $uploadedFile->webViewLink,
    //     ];
    // }

//     public function upload(UploadedFile $file, string $folderId = null): array
// {
//     $fileMetadata = new Google_Service_Drive_DriveFile([
//         'name' => $file->getClientOriginalName(),
//         'parents' => $folderId ? [$folderId] : [],
//     ]);

//     $content = file_get_contents($file->getRealPath());

//     $uploadedFile = $this->service->files->create($fileMetadata, [
//         'data' => $content,
//         'mimeType' => $file->getMimeType(),
//         'uploadType' => 'multipart',
//         'fields' => 'id, webViewLink',
//     ]);

//     return [
//         'id' => $uploadedFile->id,
//         'link' => $uploadedFile->webViewLink,
//     ];
// }


    // public function upload($file, string $folderId = null): array
    // {
    //     $fileMetadata = new GoogleServiceDrive\DriveFile([
    //         'name' => $file->getFilename(),
    //         'parents' => $folderId ? [$folderId] : [],
    //     ]);

    //     $content = file_get_contents($file->getRealPath());

    //     $uploadedFile = $this->service->files->create($fileMetadata, [
    //         'data' => $content,
    //         'mimeType' => mime_content_type($file->getRealPath()),
    //         'uploadType' => 'multipart',
    //         'fields' => 'id, webViewLink',
    //     ]);

    //     return [
    //         'id' => $uploadedFile->id,
    //         'link' => $uploadedFile->webViewLink,
    //     ];
    // }
   public function upload(File $file, string $folderId = null): array
    {
        $fileMetadata = new GoogleServiceDrive\DriveFile([
            'name' => 'database_' . now()->format('Ymd_His') . '.sqlite',
            'parents' => $folderId ? [$folderId] : [],
        ]);

        $content = file_get_contents($file->getRealPath());

        $uploadedFile = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($file->getRealPath()),
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink',
        ]);

        return [
            'id' => $uploadedFile->id,
            'link' => $uploadedFile->webViewLink,
        ];
    }
}
