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
use App\Services\DisplayAwardService;
use App\Services\DisplayUserService;



class DashboardController extends Controller
{


    protected $CodexDisplayService;
    protected $DisplayCategoryCodexService;
    protected $DisplayProjectService;
    protected $DisplayTechSkillService;
    protected $DisplayAwardService;
    protected $DisplayUserService;

    
    public function __construct( CodexDisplayService $CodexDisplayService, DisplayCategoryCodexService $DisplayCategoryCodexService,
    DisplayProjectService $DisplayProjectService, DisplayTechSkillService $DisplayTechSkillService,
    DisplayAwardService $DisplayAwardService, DisplayUserService $DisplayUserService)
    {
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
        $this->CodexDisplayService = $CodexDisplayService;
        $this->DisplayProjectService = $DisplayProjectService;
        $this->DisplayTechSkillService = $DisplayTechSkillService;
        $this->DisplayAwardService = $DisplayAwardService;
        $this->DisplayUserService = $DisplayUserService;
    }
    





    public function dashboard(){
        $data = $this->DisplayCategoryCodexService->getAllData();
        $codex = $this->CodexDisplayService->getAllData();
        $project = $this->DisplayProjectService->displayProject();
        $skill = $this->DisplayTechSkillService->displayTech();
        $award = $this->DisplayAwardService->getData();
        $user = $this->DisplayUserService->getUsers();

        return Inertia::render('Admin/Dashboard',[
            'data' => $data,
            'codex' => $codex,
            'project' => $project,
            'skill' => $skill,
            'award' => $award,
            'user' => $user,

        ]);
    }

    public function SystemUsers(){
      
        $data = $this->DisplayUserService->getUsers();
        return Inertia::render('Admin/SystemUsers',[
            'data' => $data,
        ]);
    }


}
