<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use Illuminate\Support\Facades\Log;
//REQUEST
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ScreenShotRequest;

//SERVICE
use App\Services\CodexImageService;
use App\Services\ProjectService;
use App\Services\DisplayProjectService;
use App\Services\ScreenShotService;
use App\Services\ImageScreenShotService;
use App\Services\DisplayScreenShotService;


use App\Models\ProjectModel; 

class ProjectController extends Controller
{
    
    protected $ProjectService;
    protected $CodexImageService;
    protected $DisplayProjectService;
    protected $ScreenShotService;
    protected $ImageScreenShotService;
    protected $DisplayScreenShotService;


    public function __construct(ProjectService $ProjectService, CodexImageService $CodexImageService, DisplayProjectService $DisplayProjectService, 
    ScreenShotService $ScreenShotService, ImageScreenShotService $ImageScreenShotService,
    DisplayScreenShotService $DisplayScreenShotService) {
        $this->ProjectService = $ProjectService;
        $this->CodexImageService = $CodexImageService;
        $this->DisplayProjectService = $DisplayProjectService;
        $this->ScreenShotService = $ScreenShotService;
        $this->ImageScreenShotService = $ImageScreenShotService;
        $this->DisplayScreenShotService = $DisplayScreenShotService;
    }



    public function projects(){
        $data = $this->DisplayProjectService->displayProject();
        $ScreenShots = $this->DisplayScreenShotService->getAllData();
        return Inertia::render('Admin/Projects', [
            'data' => $data,
            'ScreenShots' => $ScreenShots,
        ]);
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
    

    public function AddScreenShot(ScreenShotRequest $request)
    {
        $validated = $request->validated();
 
    
        $imageName = $this->ImageScreenShotService->handleImageUpload($request);
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
       
        $this->ScreenShotService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('system.projects')->with('success', "Codex Added Successfully!");

    }
    
}
