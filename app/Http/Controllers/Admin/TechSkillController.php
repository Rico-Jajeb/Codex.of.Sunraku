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
use App\Services\DisplayTechSkillService;
use App\Services\UpdateTechSkillService;
use App\Services\DeleteTechSkillService;

//MODELS
use App\Models\TechSkillModel; 

class TechSkillController extends Controller
{


    protected $TechSkillService;
    protected $CodexImageService;
    protected $DisplayTechSkillService;
    protected $UpdateTechSkillService;
    protected $DeleteTechSkillService;

    public function __construct(TechSkillService $TechSkillService, CodexImageService $CodexImageService,
     DisplayTechSkillService $DisplayTechSkillService, UpdateTechSkillService $UpdateTechSkillService,
     DeleteTechSkillService $DeleteTechSkillService) {
        $this->TechSkillService = $TechSkillService;
        $this->CodexImageService = $CodexImageService;
        $this->DisplayTechSkillService = $DisplayTechSkillService;
        $this->UpdateTechSkillService = $UpdateTechSkillService;
        $this->DeleteTechSkillService = $DeleteTechSkillService;
    }


    public function techPage(){
        $data = $this->DisplayTechSkillService->displayTech();
        return Inertia::render('Admin/TechSkill',
        ['data' => $data])
        ;
    }



    public function addTechSkill(TechSkillRequest $request){
        $validated = $request->validated();

        $imageName = $this->CodexImageService->handleImageUpload($request);
        $validated['img'] = $imageName;

        $this->TechSkillService->create($validated);

        return redirect()->route('system.skills')->with('success', "Category Added Successfully!");
    }






    public function updateTechSkill(TechSkillRequest $request, $id){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
    
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
    
        $this->UpdateTechSkillService->upSkill($id, $validated); //adi an code para han up services

        // return redirect()->route('codex.category')->with('success', "Category Added Successfully!");return back();
        return redirect()->route('system.skills')->with('success', "Category Updated Successfully!");

    }



  public function destroy($id, DeleteTechSkillService $deleteService)
    {
        $success = $deleteService->deleteSkill($id);

        return redirect()->route('system.skills')->with('success', "Deleted  Successfully!");
    }


}
