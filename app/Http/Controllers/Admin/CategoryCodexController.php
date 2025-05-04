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
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $this->CodexCategoryService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->route('codex.category')->with('success', "Category Added Successfully!");

    }




// public function updateCategory(UpdateCodexCategoryRequest $request, $id)
// {
//     // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
//     $imageName = $this->CodexImageService->handleImageUpload($request); 


//     $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
   
//     $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
   
//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return redirect()->route('codex.category')->with('success', "Category Added Successfully!");
// }

// public function updateCategory(UpdateCodexCategoryRequest $request, $id)
// {
//     $validated = $request->validated(); // validate first

//     // Default to existing image if not replaced
 
//     $imageName = $validated['img'] ?? null;
    
//     // If a new image is uploaded
//     if ($request->hasFile('img') && $request->file('img')->isValid()) {
//         logger('Image file detected.');
    
//         $image = $request->file('img');
//         logger('Original image name: ' . $image->getClientOriginalName());
    
//         $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//         logger('Generated image name: ' . $imageName);
    
//         $image->move(public_path('storage/output'), $imageName);
//         logger('Image moved to: ' . public_path('storage/output/' . $imageName));
//     }
    

//     $validated['img'] = $imageName;

//     $this->UpdateCodexCategoryService->updateCategory($id, $validated);

//     return redirect()->route('codex.category')->with('success', 'Category updated successfully!');
// }


public function updateCategory(Request $request, $id)
{
    $validated = $request->validate([
        'category_name' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
    ]);

    logger('Starting category update for ID: ' . $id);

    if (isset($validated['category_name'])) {
        logger('Category name validated: ' . $validated['category_name']);
    } else {
        logger('Category name not provided; will keep existing.');
    }

    if (isset($validated['description'])) {
        logger('Description validated: ' . $validated['description']);
    } else {
        logger('Description not provided; will keep existing.');
    }

    if (isset($validated['img'])) {
        logger('Image input passed validation.');
    } else {
        logger('No new image uploaded or image not provided.');
    }

    $category = CodexCategoryModel::findOrFail($id);

    // Default to existing image if not replaced
    $imageName = $category->img;

    

    if ($request->hasFile('img')) {
        logger('Image file input detected.');
    
        if ($request->file('img')->isValid()) {
            logger('Image file is valid.');
            $image = $request->file('img');
    
            logger('Original image name: ' . $image->getClientOriginalName());
    
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            logger('Generated image name: ' . $imageName);
    
            try {
                $image->move(public_path('storage/output'), $imageName);
                logger('Image successfully moved to: ' . public_path('storage/output/' . $imageName));
            } catch (\Exception $e) {
                logger()->error('Failed to move image: ' . $e->getMessage());
            }
        } else {
            logger()->warning('Image file is not valid.');
        }
    } else {
        logger('No image file uploaded.');
    }
    
    $category->update([
        'category_name' => $validated['category_name'] ?? $category->category_name,
        'description' => $validated['description'] ?? $category->description,
        'img' => $imageName,
    ]);

    logger('Category ID ' . $id . ' updated successfully.');

    return redirect()->route('codex.category')->with('success', 'Category updated successfully!');
}






    public function destroy($id, DeleteCategoryService $deleteService)
    {
        $success = $deleteService->deleteCategory($id);

        return redirect()->back()->with(
            'message',
            $success ? 'Category deleted successfully.' : 'Category not found.'
        );
    }
}
