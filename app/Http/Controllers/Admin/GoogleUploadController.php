<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GoogleDriveService;

class GoogleUploadController extends Controller
{
    public function uploadToDrive(Request $request, GoogleDriveService $driveService)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $file = $request->file('file');
        $folderId = '1RJSKJgzuR7nQQg2s69z0fdRRgDXcF9cO';
        //$result = $driveService->upload($file);

        $result = $driveService->upload($file, $folderId );

        return response()->json([
            'message' => 'File uploaded to Google Drive!',
            'drive_file_id' => $result['id'],
            'drive_link' => $result['link'],
        ]);
    }
}
