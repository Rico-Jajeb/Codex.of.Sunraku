<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\AwardsModel;


class DeleteAwardService

{

    public function deleteAward(int $id)
    {
        //bali amo ini an code pag biling han data by id
        $category = AwardsModel::findOrFail($id); 

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
