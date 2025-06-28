<?php

namespace App\Services;

use App\Models\ProjectScreenshot; //tapos adi an moddel

class ScreenShotService
{

    public function create(array $data)
    {
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return ProjectScreenshot::create([
            'img' => $data['img'], 
        ]);
    }

}
