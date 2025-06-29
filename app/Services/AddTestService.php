<?php

namespace App\Services;

use App\Models\TestModel; //tapos adi an moddel
use App\Models\ProjectModel; //tapos adi an moddel

class AddTestService
{

    public function create(array $data)
    {
        
     


        $project = ProjectModel::findOrFail($data['project_id']);

        // Then use the relationship
        return $project->test()->create([
            'img' => $data['img'],
        ]);
    

    }

}
