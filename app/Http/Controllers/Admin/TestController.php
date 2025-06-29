<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\TestRequest;

//SERVICE
use App\Services\CodexImageService;
use App\Services\AddTestService;

use App\Models\TestModel; 

class TestController extends Controller
{
    
    
  
    protected $CodexImageService;
    protected $AddTestService;
 

    public function __construct( CodexImageService $CodexImageService, AddTestService $AddTestService) {
      
        $this->CodexImageService = $CodexImageService;
        $this->AddTestService = $AddTestService;
    
    }

    
    public function addTest(TestRequest $request){
        $validated = $request->validated();

        $imageName = $this->CodexImageService->handleImageUpload($request);
        $validated['img'] = $imageName;

        $this->AddTestService->create($validated);

        return redirect()->route('system.projects')->with('success', "Category Added Successfully!");
    }



    
}
