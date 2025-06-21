<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

class ProjectController extends Controller
{
    
    public function projects(){
        return Inertia::render('Admin/Projects');
    }

    
}
