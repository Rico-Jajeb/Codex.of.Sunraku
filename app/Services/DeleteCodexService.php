<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\CodexCategoryModel;
use App\Models\CodexModel;

class DeleteCodexService
{

    public function deleteCodex(int $id)
    {
        //bali amo ini an code pag biling han data by id
        $category = CodexModel::findOrFail($id); 

        //amo liwat ini an code han pag delete han image
        if ($category->img) {
            $imagePath = public_path('storage/output/' . $category->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $category->delete();
        return true;
    }
 
}
