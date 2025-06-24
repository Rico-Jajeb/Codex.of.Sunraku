<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TechSkillController extends Controller
{
    public function techPage(){
        return Inertia::render('Admin/TechSkill');
    }
}
