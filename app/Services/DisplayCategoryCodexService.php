<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CodexCategoryModel;

class DisplayCategoryCodexService
{
   

    public function getAllData()
    {
        return CodexCategoryModel::all();  // Retrieve all data (you can modify this to add any filtering or sorting logic)
    }
 
    
 
}
