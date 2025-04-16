<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

//REQUEST
use App\Http\Requests\CodexCategoryRequest;
use App\Http\Requests\UpdateCodexCategoryRequest;

//SERVICES

use App\Services\CodexImageService;
use App\Services\CodexCategoryService;
use App\Services\DisplayCategoryCodexService;
use App\Services\UpdateCodexCategoryService;

//MODEL
use App\Models\CodexModel;
use App\Models\CodexCategoryModel;

class CategoryCodexController extends Controller
{

    protected $CodexImageService;
    protected $CodexCategoryService;
    protected $DisplayCategoryCodexService;
    protected $UpdateCodexCategoryService;

    public function __construct( CodexImageService $CodexImageService, CodexCategoryService $CodexCategoryService, 
    DisplayCategoryCodexService $DisplayCategoryCodexService, UpdateCodexCategoryService $UpdateCodexCategoryService)
    {
  
        $this->CodexImageService = $CodexImageService;
        $this->CodexCategoryService = $CodexCategoryService;
        $this->DisplayCategoryCodexService = $DisplayCategoryCodexService;
        $this->UpdateCodexCategoryService = $UpdateCodexCategoryService;
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




// public function update(Request $request, $id)
// {
//     $validated = $request->validate([
//         'CategoryName' => 'required|string|max:255',
//         'CategoryDesc' => 'nullable|string',
//         'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     // Optional: delegate logic to service
//     $category = CodexCategoryModel::findOrFail($id);
//     $category->category_name = $validated['CategoryName'];
//     $category->description = $validated['CategoryDesc'];
    
//     if ($request->hasFile('img')) {
//         $path = $request->file('img')->store('category_images', 'public');
//         $category->img = $path;
//     }
    
//     $category->save();

//     return back()->with('success', 'Category updated successfully.');
// }

// public function update(CodexCategoryRequest $request, $id)
// {
//     $validated = $request->validated();
//     // Optional: delegate logic to service
//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return back()->with('success', 'Category updated successfully.');
// }

// public function update(CodexCategoryRequest $request, $id)
// {
//      // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
//      $imageName = $this->CodexImageService->handleImageUpload($request); 

//      $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
//      $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
//     // Optional: delegate logic to service
//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return back()->with('success', 'Category updated successfully.');
// }

//amo ini an latest
// public function update(CodexCategoryRequest $request, $id)
// {
//     $imageName = $this->CodexImageService->handleImageUpload($request);

//     $validated = $request->validated();

//     if ($imageName) {
//         $validated['img'] = $imageName; // or 'output/' . $imageName if you return just the name
//     }

//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return back()->with('success', 'Category updated successfully.');
// }



// public function update(UpdateCodexCategoryRequest $request, $id)
// {
//     $imageName = $this->CodexImageService->handleImageUpload($request);

//     $validated = $request->validated();

//     if ($imageName) {
//         $validated['img'] = $imageName; // or 'output/' . $imageName if you return just the name
//     }

//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return back()->with('success', 'Category updated successfully.');
// }


// public function update(UpdateCodexCategoryRequest $request, $id)
// {
//     $validated = $request->validated();
//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return back()->with('success', 'Category updated successfully.');
// }


public function update(UpdateCodexCategoryRequest $request, $id)
{
    // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
    $imageName = $this->CodexImageService->handleImageUpload($request); 


    $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
   
    $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
   
    $this->UpdateCodexCategoryService->updateCategory($id, $validated);

    return redirect()->route('codex.category')->with('success', "Category Added Successfully!");
}


}
