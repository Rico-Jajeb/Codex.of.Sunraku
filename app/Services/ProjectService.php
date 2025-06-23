<?php

namespace App\Services;

use App\Models\ProjectModel; //tapos adi an moddel

class ProjectService
{

    public function create(array $data)
    {
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return ProjectModel::create([
            'proj_name' => $data['proj_name'],
            'proj_description' => $data['proj_description'],
            'framework' => $data['framework'],
            'tags' => $data['tags'],
            'status' => $data['status'],
            'github_url' => $data['github_url'],
            'live_url' => $data['live_url'],

            'thumbnail' => $data['img'],
            'screenshots' => $data['screenshots'],
        ]);
    }

}
