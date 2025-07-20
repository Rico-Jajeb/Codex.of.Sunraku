<?php

namespace App\Services\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeService
{
    public function handleFileUpload(Request $request)
    {
        // Accept a file (PDF or image) under the key 'system_logo'
        if ($request->hasFile('resume') && $request->file('resume')->isValid()) {
            
            $file = $request->file('resume');

            // Optional: Validate file type manually if you want to be strict
            $allowedExtensions = ['pdf'];
            if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
                return null; // unsupported file type
            }

           
            // Assume $request->name contains "Juan Dela Cruz"
            $name = $request->input('name', 'Cabugatan Rico Jajeb');
            $cleanName = str_replace(' ', '_', $name); // Replace spaces with underscores

            $fileName = 'Resume_' . $cleanName . '.' . $file->getClientOriginalExtension();

            // Move to public/storage/output (make sure this folder exists)
            $file->move(public_path('storage/resume'), $fileName);

            return $fileName;
        }

        return null; // If no file is uploaded
    }
}
