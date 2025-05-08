<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\CodexCategoryModel; //tapos adi an moddel

class UpdateCodexCategoryService
{
   
  
 
    public function upCategory($id, array $data)
    {
        $category = CodexCategoryModel::findOrFail($id);

        if (isset($data['category_name'])) {
            $category->category_name = $data['category_name'];
        }

        if (isset($data['description'])) {
            $category->description = $data['description'];
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
