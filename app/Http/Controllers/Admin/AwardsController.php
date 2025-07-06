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
use App\Services\UpdateAwardService;
use App\Services\DeleteAwardService;

//MODEL
use App\Models\AwardsModel;

class AwardsController extends Controller
{


    protected $AddAwardService;
    protected $CodexImageService;
    protected $DisplayAwardService;
    protected $UpdateAwardService;
    protected $DeleteAwardService;

    public function __construct(AddAwardService $AddAwardService, CodexImageService $CodexImageService,
    DisplayAwardService $DisplayAwardService, UpdateAwardService $UpdateAwardService,
    DeleteAwardService $DeleteAwardService
    ) {
        $this->AddAwardService = $AddAwardService;
        $this->CodexImageService = $CodexImageService;
        $this->DisplayAwardService = $DisplayAwardService;
        $this->UpdateAwardService = $UpdateAwardService;
        $this->DeleteAwardService = $DeleteAwardService;
     
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


    
    public function updateAwards(AwardRequest $request, $id){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
    
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
    
        $this->UpdateAwardService->upAward($id, $validated); //adi an code para han up services

        // return redirect()->route('codex.category')->with('success', "Category Added Successfully!");return back();
        return redirect()->route('system.achievement')->with('success', "Category Updated Successfully!");

    }

    
    public function destroyAward($id, DeleteAwardService $deleteService)
    {
        $success = $deleteService->deleteAward($id);

        return redirect()->route('system.achievement')->with('success', "Deleted  Successfully!");
    }


}
