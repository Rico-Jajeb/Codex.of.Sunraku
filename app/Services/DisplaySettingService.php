<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SystemModel;

class DisplaySettingService
{
   

    public function getAllData()
    {
         //return SystemModel::all();  
       return SystemModel::find(1); 


    }
 
    
 
}
