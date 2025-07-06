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
use App\Services\DisplayAwardService;

//MODEL
use App\Models\AwardsModel;

class AwardsController extends Controller
{


    protected $AddAwardService;
    protected $CodexImageService;
    protected $DisplayAwardService;

    public function __construct(AddAwardService $AddAwardService, CodexImageService $CodexImageService,
    DisplayAwardService $DisplayAwardService,
    ) {
        $this->AddAwardService = $AddAwardService;
        $this->CodexImageService = $CodexImageService;
        $this->DisplayAwardService = $DisplayAwardService;
     
    }





    public function awards(){

        $data = $this->DisplayAwardService->getData();
        return Inertia::render('Admin/Awards',[
            'data' => $data,
        ]);
    }





    
    public function addAwards(AwardRequest $request){
        $validated = $request->validated();

        $imageName = $this->CodexImageService->handleImageUpload($request);
        $validated['img'] = $imageName;

        $this->AddAwardService->create($validated);

        return redirect()->route('system.achievement')->with('success', "Category Added Successfully!");
    }


}
