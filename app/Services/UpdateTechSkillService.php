<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\TechSkillModel; //tapos adi an moddel

class UpdateTechSkillService
{
   
  
 
    public function upSkill($id, array $data)
    {
        $category = TechSkillModel::findOrFail($id);

        if (isset($data['tech_name'])) {
            $category->tech_name = $data['tech_name'];
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
