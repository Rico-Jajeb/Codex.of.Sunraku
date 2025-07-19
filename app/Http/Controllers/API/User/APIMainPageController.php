<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SystemModel;
use App\Models\CodexModel;

class APIMainPageController extends Controller
{
       public function index()
    {

        // Get system data
        $systemData = SystemModel::find(1);


       $codexData = CodexModel::orderBy('created_at', 'desc')->take(4)->get();



        return response()->json([
            'system' => $systemData,
            'codex' => $codexData,
        ]);
    }
}

