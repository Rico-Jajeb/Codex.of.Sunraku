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

class CodexDocuController extends Controller
{

    protected $CodexDisplayService;
    protected $DisplayCategoryCodexService;
    protected $DisplaySettingService;

    public function __construct(CodexDisplayService $CodexDisplayService, DisplayCategoryCodexService $DisplayCategoryCodexService,
            DisplaySettingService $DisplaySettingService )
    {
        $this->CodexDisplayService = $CodexDisplayService;
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
        $this->DisplaySettingService = $DisplaySettingService;
    }

    //
    public function codexDocu(){

        $data = $this->CodexDisplayService->getAllData();
        $category = $this->DisplayCategoryCodexService->getAllData();
        $setting = $this->DisplaySettingService->getAllData();


        return Inertia::render('Home/Codex', [
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
        ]);
    }
}
