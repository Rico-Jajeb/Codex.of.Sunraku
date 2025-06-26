<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

//REQUEST
use App\Http\Requests\TechSkillRequest;

//SERVICE
use App\Services\TechSkillService;
use App\Services\CodexImageService;

//MODELS
use App\Models\TechSkillModel; 

class TechSkillController extends Controller
{


    protected $TechSkillService;

    public function __construct(TechSkillService $TechSkillService, CodexImageService $CodexImageService) {
        $this->TechSkillService = $TechSkillService;
        $this->CodexImageService = $CodexImageService;
    }


    public function techPage(){
        return Inertia::render('Admin/TechSkill');
    }



    public function addTechSkill(TechSkillRequest $request){
        $validated = $request->validated();

        $imageName = $this->CodexImageService->handleImageUpload($request);
        $validated['img'] = $imageName;

        $this->TechSkillService->create($validated);

        return redirect()->route('system.skills')->with('success', "Category Added Successfully!");
    }

}
