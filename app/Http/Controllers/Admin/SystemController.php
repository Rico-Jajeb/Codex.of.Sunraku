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





//     public function updateSetting(Request $request, $id)
// {
//     $validated = $request->validate([
//         'system_name' => 'nullable|string|max:255',
//         'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
//     ]);

//     logger('Starting category update for ID: ' . $id);

//     if (isset($validated['system_name'])) {
//         logger('system_name name validated: ' . $validated['system_name']);
//     } else {
//         logger('system_name name not provided; will keep existing.');
//     }


//     if (isset($validated['img'])) {
//         logger('Image input passed validation.');
//     } else {
//         logger('No new image uploaded or image not provided.');
//     }

//     $system = SystemModel::findOrFail($id);

//     // Default to existing image if not replaced
//     $imageName = $system->img;

    

//     if ($request->hasFile('img')) {
//         logger('Image file input detected.');
    
//         if ($request->file('img')->isValid()) {
//             logger('Image file is valid.');
//             $image = $request->file('img');
    
//             logger('Original image name: ' . $image->getClientOriginalName());
    
//             $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//             logger('Generated image name: ' . $imageName);
    
//             try {
//                 $image->move(public_path('storage/output'), $imageName);
//                 logger('Image successfully moved to: ' . public_path('storage/output/' . $imageName));
//             } catch (\Exception $e) {
//                 logger()->error('Failed to move image: ' . $e->getMessage());
//             }
//         } else {
//             logger()->warning('Image file is not valid.');
//         }
//     } else {
//         logger('No image file uploaded.');
//     }
    
//     $system->update([
//         'system_name' => $validated['system_name'] ?? $system->system_name,
//         'img' => $imageName,
//     ]);

//     logger('system ID ' . $id . ' updated successfully.');

//     return redirect()->back()->with(
//         'message',
//     );
// }



// public function updateSetting(Request $request, $id)
// {
//     \Log::debug("Starting category update for ID: $id");

//     $validated = $request->validate([
//         'system_name' => 'nullable|string|max:255',
//         'img' => 'nullable|image|max:2048',
//     ]);

//     $system = SystemModel::findOrFail($id);

//     if ($request->has('system_name')) {
//         $system->system_name = $request->system_name;
//     } else {
//         \Log::debug("system_name not provided; will keep existing.");
//     }

//     if ($request->hasFile('img')) {
//         $file = $request->file('img');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $file->storeAs('public/storage/output', $filename);
//         $system->img = $filename;
//     } else {
//         \Log::debug("No image file uploaded.");
//     }

//     $system->save();

//     \Log::debug("system ID {$id} updated successfully.");
    
//     return back();
// }

public function updateSetting(Request $request, $id)
{
    \Log::debug("Starting category update for ID: $id");

    // Validate request
    $validated = $request->validate([
        'system_name' => 'nullable|string|max:255',
        'img' => 'nullable|image|max:2048',
    ]);

    $system = SystemModel::findOrFail($id);

    // Update system name if present
    if ($request->has('system_name')) {
        $system->system_name = $request->system_name;
    } else {
        \Log::debug("system_name not provided; will keep existing.");
    }

    // Handle image upload using the CodexImageService
    if ($request->hasFile('img')) {
        $imageName = $this->CodexImageService->handleImageUpload($request);
        $system->img = $imageName;
        \Log::debug("Image uploaded and stored: $imageName");
    } else {
        \Log::debug("No image file uploaded.");
    }

    $system->save();

    \Log::debug("System ID {$id} updated successfully.");
    
    return back();
}



}
