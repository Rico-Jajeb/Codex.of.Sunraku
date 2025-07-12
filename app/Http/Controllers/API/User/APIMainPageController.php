<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemModel;

class APIMainPageController extends Controller
{
       public function index()
    {
        return response()->json(SystemModel::find(1));
    }
}

