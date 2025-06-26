<?php

namespace App\Services;

use App\Models\TechSkillModel; //tapos adi an moddel

class TechSkillService
{

    public function create(array $data)
    {
        
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return TechSkillModel::create([
            'tech_name' => $data['tech_name'],
            'img' => $data['img'],
          
        ]);
    

    }

}
