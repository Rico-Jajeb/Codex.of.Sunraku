<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;

//REQUEST
use App\Http\Requests\CodexRequest;
use App\Http\Requests\CodexCategoryRequest;

//SERVICES
use App\Services\CodexServices;
use App\Services\CodexImageService;
use App\Services\CodexCategoryService;

//MODEL
use App\Models\CodexModel;

class CodexController extends Controller
{
    //

    protected $CodexServices;
    protected $CodexImageService;
    protected $CodexCategoryService;

    public function __construct(CodexServices $CodexServices, CodexImageService $CodexImageService, CodexCategoryService $CodexCategoryService)
    {
        $this->CodexServices = $CodexServices;
        $this->CodexImageService = $CodexImageService;
        $this->CodexCategoryService = $CodexCategoryService;
    }
    

    public function index(){
        return Inertia::render('Admin/NewCodex');
    }

   

    public function AddCodex(CodexRequest $request)
    {
        // amo ini an knn image upload ato ha CodexImageService
        $imageName = $this->CodexImageService->handleImageUpload($request);

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $this->CodexServices->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('new.codex')->with('success', "Codex Added Successfully!");

    }

    public function codexCategory(){
        return Inertia::render('Admin/CodexCategories');
    }


    public function addCategory(CodexCategoryRequest $request){
        $imageName = $this->CodexImageService->handleImageUpload($request);

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $this->CodexCategoryService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('codex.category')->with('success', "Codex Added Successfully!");

    }

}
