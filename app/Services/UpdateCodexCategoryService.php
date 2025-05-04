<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\CodexCategoryModel; //tapos adi an moddel

class UpdateCodexCategoryService
{
   
  
    public function updateCategory(int $id, array $data)
    {
        logger($data); // See what's inside
        
    
        $category = CodexCategoryModel::findOrFail($id);
    
        $category->update([
            'category_name' => $data['category_name'] ?? $category->category_name,
            'description' => $data['description'] ?? $category->description,
            'img' => $data['img'] ?? $category->img,  // Just use the name returned
        ]);
    
        return $category;
    }
    
}
