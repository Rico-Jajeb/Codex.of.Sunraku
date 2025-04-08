<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

use App\Services\CodexDisplayService;

class MainPageController extends Controller
{
    //
    // public function Home(){
    //     return Inertia::render('Home/MainPage');
    // }

    protected $CodexDisplayService;

    public function __construct(CodexDisplayService $CodexDisplayService)
    {
        $this->CodexDisplayService = $CodexDisplayService;
    }


    public function Home(){

        $ab = [1,2,3,4,5];

        $data = $this->CodexDisplayService->getAllData();
        
        return Inertia::render('Home/MainPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,

            'msgg' => $ab,
            'data' => $data,
        ]);

    }


}
