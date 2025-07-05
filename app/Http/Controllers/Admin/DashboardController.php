<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

//SERVICES
use App\Services\DisplayCategoryCodexService;
use App\Services\CodexDisplayService;
use App\Services\DisplayProjectService;
use App\Services\DisplayTechSkillService;



class DashboardController extends Controller
{


    protected $CodexDisplayService;
    protected $DisplayCategoryCodexService;
    protected $DisplayProjectService;
    protected $DisplayTechSkillService;

    
    public function __construct( CodexDisplayService $CodexDisplayService, DisplayCategoryCodexService $DisplayCategoryCodexService,
    DisplayProjectService $DisplayProjectService, DisplayTechSkillService $DisplayTechSkillService)
    {
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
        $this->CodexDisplayService = $CodexDisplayService;
        $this->DisplayProjectService = $DisplayProjectService;
        $this->DisplayTechSkillService = $DisplayTechSkillService;
    }
    





    public function dashboard(){
        $data = $this->DisplayCategoryCodexService->getAllData();
        $codex = $this->CodexDisplayService->getAllData();
        $project = $this->DisplayProjectService->displayProject();
        $skill = $this->DisplayTechSkillService->displayTech();

        return Inertia::render('Admin/Dashboard',[
            'data' => $data,
            'codex' => $codex,
            'project' => $project,
            'skill' => $skill,
        ]);
    }


}
