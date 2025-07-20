<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TechSkillModel;

use App\Http\Resources\TechSkillResource;

class TechSkillController extends Controller
{
    
    public function index()
    {
        return response()->json(TechSkillResource::collection(TechSkillModel::all())->resolve());
    }
}
