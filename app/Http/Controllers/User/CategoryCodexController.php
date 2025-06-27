<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use Illuminate\Support\Facades\Log;

//REQUEST
use App\Http\Requests\CodexCategoryRequest;
use App\Http\Requests\UpdateCodexCategoryRequest;

//SERVICES

use App\Services\CodexImageService;
use App\Services\CodexCategoryService;
use App\Services\DisplayCategoryCodexService;
use App\Services\UpdateCodexCategoryService;
use App\Services\DeleteCategoryService;
use App\Services\CodexDisplayService;

//MODEL
use App\Models\CodexModel;
use App\Models\CodexCategoryModel;

class CategoryCodexController extends Controller
{

    protected $CodexImageService;
    protected $CodexCategoryService;
    protected $DisplayCategoryCodexService;
    protected $UpdateCodexCategoryService;
    protected $DeleteCategoryService;
    protected $CodexDisplayService;

    public function __construct( CodexImageService $CodexImageService, CodexCategoryService $CodexCategoryService, 
    DisplayCategoryCodexService $DisplayCategoryCodexService, UpdateCodexCategoryService $UpdateCodexCategoryService,
    DeleteCategoryService $DeleteCategoryService, CodexDisplayService $CodexDisplayService)
    {
  
        $this->CodexImageService = $CodexImageService;
        $this->CodexCategoryService = $CodexCategoryService;
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
        $this->UpdateCodexCategoryService = $UpdateCodexCategoryService;
        $this->DeleteCategoryService = $DeleteCategoryService;
        $this->CodexDisplayService = $CodexDisplayService;

    }
    




    public function index(){
        $data = $this->DisplayCategoryCodexService->getAllData();
        $codex = $this->CodexDisplayService->getAllData();

        return Inertia::render('Admin/CodexCategories',[
            'data' => $data,
            'codex' => $codex,
        ]);
    }




    public function addCategory(CodexCategoryRequest $request){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request      


        $imageName = $this->CodexImageService->handleImageUpload($request); 
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db

        $this->CodexCategoryService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('codex.category')->with('success', "Category Added Successfully!");

    }




    public function updateCategory(UpdateCodexCategoryRequest $request, $id){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
    
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
    
        $this->UpdateCodexCategoryService->upCategory($id, $validated); //adi an code para han up services

        // return redirect()->route('codex.category')->with('success', "Category Added Successfully!");return back();
        return redirect()->route('codex.category')->with('success', "Category Updated Successfully!");

    }







    public function destroy($id, DeleteCategoryService $deleteService)
    {
        $success = $deleteService->deleteCategory($id);

        return redirect()->route('codex.category')->with('success', "Deleted  Successfully!");
    }

}
