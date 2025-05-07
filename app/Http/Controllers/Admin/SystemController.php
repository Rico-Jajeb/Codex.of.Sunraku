<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;


use Illuminate\Support\Facades\Log;



//REQUEST
use App\Http\Requests\SystemRequest;

//SERVICES

use App\Services\CodexImageService;
use App\Services\SystemSettingService;
use App\Services\DisplaySettingService;


//MODEL

use App\Models\SystemModel;

class SystemController extends Controller
{

    protected $CodexImageService;
    protected $SystemSettingService;
    protected $DisplaySettingService;

    public function __construct( CodexImageService $CodexImageService, SystemSettingService $SystemSettingService, DisplaySettingService $DisplaySettingService )
    {
        $this->CodexImageService = $CodexImageService;
        $this->SystemSettingService = $SystemSettingService;
        $this->DisplaySettingService = $DisplaySettingService;
    }





    public function systemSetting(){
        $data = $this->DisplaySettingService->getAllData();

        return Inertia::render('Admin/SystemSettings',[
            'data' => $data,
        ]);
    }



    public function addSettings2(SystemRequest $request){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $this->SystemSettingService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->back()->with('success', 'Codex updated successfully.');

    }

}
