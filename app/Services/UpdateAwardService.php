<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\AwardsModel; //tapos adi an moddel

class UpdateAwardService
{
   
    public function upAward($id, array $data)
    {
        $category = AwardsModel::findOrFail($id);

        if (isset($data['award_title'])) {
            $category->award_title = $data['award_title'];
        }

        if (isset($data['award_description'])) {
            $category->award_description = $data['award_description'];
        }

        if (isset($data['issuer'])) {
            $category->issuer = $data['issuer'];
        }

        if (isset($data['Date'])) {
            $category->Date = $data['Date'];
        }

        if (isset($data['award_url'])) {
            $category->award_url = $data['award_url'];
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
