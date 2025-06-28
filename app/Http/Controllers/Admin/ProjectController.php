<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use Illuminate\Support\Facades\Log;
//REQUEST
use App\Http\Requests\ProjectRequest;

//SERVICE
use App\Services\CodexImageService;
use App\Services\ProjectService;


use App\Models\ProjectModel; 

class ProjectController extends Controller
{
    
    protected $ProjectService;
    protected $CodexImageService;


    public function __construct(ProjectService $ProjectService, CodexImageService $CodexImageService) {
        $this->ProjectService = $ProjectService;
        $this->CodexImageService = $CodexImageService;
    }



    public function projects(){
        return Inertia::render('Admin/Projects');
    }


    public function AddProject(ProjectRequest $request)
    {
        $validated = $request->validated();
 
    
        $imageName = $this->CodexImageService->handleImageUpload($request);
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
       
        $this->ProjectService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('system.projects')->with('success', "Codex Added Successfully!");

    }
    
}
