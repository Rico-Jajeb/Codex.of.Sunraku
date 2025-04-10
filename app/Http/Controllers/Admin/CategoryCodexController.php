<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

//REQUEST
use App\Http\Requests\CodexCategoryRequest;

//SERVICES

use App\Services\CodexImageService;
use App\Services\CodexCategoryService;
use App\Services\DisplayCategoryCodexService;

//MODEL
use App\Models\CodexModel;

class CategoryCodexController extends Controller
{

    protected $CodexImageService;
    protected $CodexCategoryService;
    protected $DisplayCategoryCodexService;

    public function __construct( CodexImageService $CodexImageService, CodexCategoryService $CodexCategoryService, DisplayCategoryCodexService $DisplayCategoryCodexService)
    {
  
        $this->CodexImageService = $CodexImageService;
        $this->CodexCategoryService = $CodexCategoryService;
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
    }
    




    public function index(){
        $data = $this->DisplayCategoryCodexService->getAllData();

        return Inertia::render('Admin/CodexCategories',[
            'data' => $data,
        ]);
    }

    public function addCategory(CodexCategoryRequest $request){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $this->CodexCategoryService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('codex.category')->with('success', "Category Added Successfully!");

    }

}
