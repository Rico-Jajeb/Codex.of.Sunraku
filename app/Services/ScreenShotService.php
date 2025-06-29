<?php

namespace App\Services;

use App\Models\ProjectScreenshot; //tapos adi an moddel
use App\Models\ProjectModel; //tapos adi an moddel
use App\Models\TestModel; //tapos adi an moddel

class ScreenShotService
{

    public function create(array $data)
    {
        //amo ini an code para pag insert han data tikang ha form tikadto database table
      
         // Make sure you receive or find the project instance first
        // $project = ProjectModel::findOrFail($data['project_id']);

        // // Then use the relationship
        // return $project->screenshots()->create([
        //     'img' => $data['img'],
        // ]);
             
        $project = ProjectModel::findOrFail($data['project_id']);

        return $project->screenshots()->create([
            'img' => $data['img'],
        ]);
    }

}
