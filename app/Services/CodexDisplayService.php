<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CodexModel;

class CodexDisplayService
{
   

    public function getAllData()
    {
        return CodexModel::all();  // Retrieve all data (you can modify this to add any filtering or sorting logic)
    }
 
    
 
}
