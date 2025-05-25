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
use App\Services\UpdateSettingService;

use App\Services\Image\SettingLogoService;
use App\Services\Image\SettingFaviconService;


//MODEL

use App\Models\SystemModel;

class SystemController extends Controller
{

    protected $CodexImageService;
    protected $SystemSettingService;
    protected $DisplaySettingService;
    protected $UpdateSettingService;
    protected $SettingLogoService;
    protected $SettingFaviconService;

    public function __construct( CodexImageService $CodexImageService, SystemSettingService $SystemSettingService, 
    DisplaySettingService $DisplaySettingService, UpdateSettingService $UpdateSettingService, 
    SettingLogoService $SettingLogoService, SettingFaviconService $SettingFaviconService )
    {
        $this->CodexImageService = $CodexImageService;
        $this->SystemSettingService = $SystemSettingService;
        $this->DisplaySettingService = $DisplaySettingService;
        $this->UpdateSettingService = $UpdateSettingService;
        $this->SettingLogoService = $SettingLogoService;
        $this->SettingFaviconService = $SettingFaviconService;
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





    // public function updateSetting(SystemRequest $request, $id){
    //     // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
    //     $imageName = $this->CodexImageService->handleImageUpload($request); 

    //     $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
    
    //     $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
    
    //     $this->UpdateSettingService->upSetting($id, $validated); //adi an code para han up services

    //     return back();
    // }


    public function updateSetting(SystemRequest $request, $id){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->SettingLogoService->handleImageUpload($request); 
        $imageName2 = $this->SettingFaviconService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
    
        $validated['system_logo'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $validated['system_favicon'] = $imageName2;  // amo ini an code  para an unique img name an ma store ha db
    
        $this->UpdateSettingService->upSetting($id, $validated); //adi an code para han up services

        // return redirect()->route('codex.category')->with('success', "Category Added Successfully!");return back();
        return redirect()->route('system.settings')->with('success', "Category Updated Successfully!");

    }
}
