<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\ProjectModel; //tapos adi an moddel

class UpdateProjectService
{
   
  
 
    public function upProject($id, array $data)
    {
        $category = ProjectModel::findOrFail($id);

        if (isset($data['proj_name'])) {
            $category->proj_name = $data['proj_name'];
        }
        if (isset($data['proj_description'])) {
            $category->proj_description = $data['proj_description'];
        }
        if (isset($data['language'])) {
            $category->language = $data['language'];
        }
        if (isset($data['framework'])) {
            $category->framework = $data['framework'];
        }
        if (isset($data['status'])) {
            $category->status = $data['status'];
        }
        if (isset($data['github_url'])) {
            $category->github_url = $data['github_url'];
        }
        if (isset($data['live_url'])) {
            $category->live_url = $data['live_url'];
        }
        if (isset($data['highlight'])) {
            $category->highlight = $data['highlight'];
        }

  
        if (!empty($data['img'])) {
            // Delete the old image if it exists
            $oldImagePath = public_path('storage/output/' . $category->img);
            if ($category->img && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Remove old image file
            }

            // Save new image filename (already uploaded by CodexImageService)
            $category->img = $data['img'];
        }

        $category->save();

        return $category;
    }
    
}
