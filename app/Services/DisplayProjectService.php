<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectModel;

class DisplayProjectService
{
   
    public function displayProject(){
        return ProjectModel::all();
    }
}