<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\ProjectModel;
use App\Models\ProjectScreenshot;


class DeleteProjectService

{

    public function deleteProject(int $id)
    {
        //bali amo ini an code pag biling han data by id
        $category = ProjectModel::findOrFail($id); 

        //amo liwat ini an code han pag delete han image
        if ($category->img) {
            $imagePath = public_path('storage/output/' . $category->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

    // Get all screenshots for this project
    $screenshots = ProjectScreenshot::where('project_id', $category->id)->get();

    foreach ($screenshots as $sc) {
        if ($sc->img) {
            $imagePath = public_path('storage/screenshot/' . $sc->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $sc->delete();
    }
        $category->delete();
        return true;
    }
 
}
