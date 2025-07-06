<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

//REQUEST
use App\Http\Requests\AwardRequest;

//SERVICE
use App\Services\AddAwardService;
use App\Services\CodexImageService;

//MODEL
use App\Models\AwardsModel;

class AwardsController extends Controller
{


    protected $AddAwardService;
    protected $CodexImageService;

    public function __construct(AddAwardService $AddAwardService, CodexImageService $CodexImageService,
    ) {
        $this->AddAwardService = $AddAwardService;
        $this->CodexImageService = $CodexImageService;
     
    }





    public function awards(){
        return Inertia::render('Admin/Awards');
    }





    
    public function addAwards(AwardRequest $request){
        $validated = $request->validated();

        $imageName = $this->CodexImageService->handleImageUpload($request);
        $validated['img'] = $imageName;

        $this->AddAwardService->create($validated);

        return redirect()->route('system.achievement')->with('success', "Category Added Successfully!");
    }


}
