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


//MODEL

use App\Models\SystemModel;

class SystemController extends Controller
{

    protected $CodexImageService;
    protected $SystemSettingService;
    protected $DisplaySettingService;
    protected $UpdateSettingService;

    public function __construct( CodexImageService $CodexImageService, SystemSettingService $SystemSettingService, 
    DisplaySettingService $DisplaySettingService, UpdateSettingService $UpdateSettingService )
    {
        $this->CodexImageService = $CodexImageService;
        $this->SystemSettingService = $SystemSettingService;
        $this->DisplaySettingService = $DisplaySettingService;
        $this->UpdateSettingService = $UpdateSettingService;
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






// amo ini an nagana
// public function updateSetting(Request $request, $id)
// {
//     \Log::debug("Starting category update for ID: $id");

//     // Validate request
//     $validated = $request->validate([
//         'system_name' => 'nullable|string|max:255',
//         'img' => 'nullable|image|max:2048',
//     ]);

//     $system = SystemModel::findOrFail($id);

//     // Update system name if present
//     if ($request->has('system_name')) {
//         $system->system_name = $request->system_name;
//     } else {
//         \Log::debug("system_name not provided; will keep existing.");
//     }

//     // Handle image upload using the CodexImageService
//     if ($request->hasFile('img')) {
//         $imageName = $this->CodexImageService->handleImageUpload($request);
//         $system->img = $imageName;
//         \Log::debug("Image uploaded and stored: $imageName");
//     } else {
//         \Log::debug("No image file uploaded.");
//     }

//     $system->save();

//     \Log::debug("System ID {$id} updated successfully.");
    
//     return back();
// }


public function updateSetting(SystemRequest $request, $id)
{
    // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
    $imageName = $this->CodexImageService->handleImageUpload($request); 


    $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
   
    $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
   
    $this->UpdateSettingService->updateCategory($id, $validated);

    return back();
}


}
