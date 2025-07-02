<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

use App\Services\CodexDisplayService;
use App\Services\DisplayCategoryCodexService;
use App\Services\DisplaySettingService;
use App\Services\DisplayTechSkillService;
use App\Services\DisplayProjectService;
use App\Services\DisplayScreenShotService;

class MainPageController extends Controller
{

    protected $CodexDisplayService;
    protected $DisplayCategoryCodexService;
    protected $DisplaySettingService;
    protected $DisplayTechSkillService;
    protected $DisplayProjectService;
    protected $DisplayScreenShotService;

    public function __construct(CodexDisplayService $CodexDisplayService, DisplayCategoryCodexService $DisplayCategoryCodexService,
            DisplaySettingService $DisplaySettingService, DisplayTechSkillService $DisplayTechSkillService, 
            DisplayProjectService $DisplayProjectService, DisplayScreenShotService $DisplayScreenShotService )
    {
        $this->CodexDisplayService = $CodexDisplayService;
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
        $this->DisplaySettingService = $DisplaySettingService;
        $this->DisplayTechSkillService = $DisplayTechSkillService;
        $this->DisplayProjectService = $DisplayProjectService;
        $this->DisplayScreenShotService = $DisplayScreenShotService;
    }


    public function Home(){

        $data = $this->CodexDisplayService->getAllData();
        $category = $this->DisplayCategoryCodexService->getAllData();
        $setting = $this->DisplaySettingService->getAllData();
        $skill = $this->DisplayTechSkillService->displayTech();
        $project = $this->DisplayProjectService->displayProject();
        $screenshotimg = $this->DisplayScreenShotService->getAllData();
        
        return Inertia::render('Home/MainPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,

            //amo ini an kanan mga codex data
            'data' => $data,
            //tapos adi liwan an knan mga category
            'category' => $category,
            // amo ini an knan system info, logo, background image
            'setting' => $setting,
            'skill' => $skill,
            'project' => $project,
            'screenshotimg' => $screenshotimg,
        ]);

    }


}
