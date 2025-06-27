<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TechSkillModel;

class DisplayTechSkillService
{
   
    public function displayTech(){
        return TechSkillModel::all();
    }
}