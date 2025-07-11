<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TechSkillModel;

class TechSkillController extends Controller
{
    //
      public function index()
    {
        return response()->json(TechSkillModel::all());
    }
}
