<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectScreenshot;

class DisplayScreenShotService
{
   

    public function getAllData()
    {
        return ProjectScreenshot::all();
    }
 
    
 
}
