<?php

namespace App\Services;

use App\Models\SystemModel; //tapos adi an moddel

class SystemSettingService
{

    public function create(array $data)
    {
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return SystemModel::create([
            'system_name' => $data['system_name'],
            'img' => $data['img'],
        ]);
    }

}
