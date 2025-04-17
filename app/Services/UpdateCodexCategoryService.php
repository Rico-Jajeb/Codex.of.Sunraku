<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\CodexCategoryModel; //tapos adi an moddel

class UpdateCodexCategoryService
{
   
    // public function updateCategory($id, $data)
    // {
    //     $category = CodexCategoryModel::findOrFail($id);

    //     // $category->category_name = $data['CategoryName'] ?? null;
    //     // $category->description = $data['CategoryDesc'] ?? null;
    //     $category->category_name = $data['CategoryName'] ?? $category->category_name;
    //     $category->description = $data['CategoryDesc'] ?? $category->description;
        
    //     // if (!empty($data['img'])) {
    //     //     // Save file path directly (already uploaded)
    //     //     $category->img = 'output/' . $data['img'];
    //     // }
    //     if (!empty($data['img'])) {
    //         // Save file path directly (already uploaded)
    //         $category->category_name = $data['CategoryName'] ?? $category->category_name;
    //         $category->description = $data['CategoryDesc'] ?? $category->description;

    //         $category->img = 'storage/output/' . $data['img'];

            
    //         $category->save();

            
    //     }

    //     $category->save();

    //     return $category;
    // }




    // public function updateCategory($id, $data)
    // {
    //     $category = CodexCategoryModel::findOrFail($id);


    //     $category->update([
    //         'category_name' => $data['category_name'],
    //         'description' => $data['description'],
    //         'img' => $data['img'] ?? $category->img,  
    //     ]);
    





    //     // // Update text fields
    //     // $category->category_name = $data['CategoryName'] ?? $category->category_name;
    //     // $category->description = $data['CategoryDesc'] ?? $category->description;

    //     // // Handle image upload if present
    //     // if (!empty($data['img'])) {
    //     // }

        
    //     // $category->save();

    //     return $category;
    // }

  

    // public function updateCategory(int $id, array $data)
    // {
       

    //     $category = CodexCategoryModel::findOrFail($id);
    
    //     // Handle image upload (only if a new image is provided)
    //     if ($data['img']) {
    //         $path = $data['img']->store('categories', 'public');
    //     }else{
    //         $category->update([
    //             'category_name' => $data['category_name'],
    //             'description' => $data['description'],
    //             'img' => $path ?? $category->img,  // Fallback to the old image if no new one is uploaded
    //         ]);
        
    //     }
    

    
    //     return $category;
    // }
        
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
