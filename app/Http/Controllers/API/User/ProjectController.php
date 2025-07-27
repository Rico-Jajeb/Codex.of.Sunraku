<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProjectResource;

use App\Models\ProjectModel;


class ProjectController extends Controller
{
    public function index(){
        return response()->json(ProjectResource::collection(ProjectModel::all())->resolve());
    }
}
