<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use App\Models\CodexCategoryModel; //tapos adi an moddel

class UpdateCodexCategoryService
{
   
    public function updateCategory($id, $data)
    {
        $category = CodexCategoryModel::findOrFail($id);

        $category->category_name = $data['CategoryName'];
        $category->description = $data['CategoryDesc'] ?? null;

        if (!empty($data['img'])) {
            // Save file path directly (already uploaded)
            $category->img = 'output/' . $data['img'];
        }

        $category->save();

        return $category;
    }
}
