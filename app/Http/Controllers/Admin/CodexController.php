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
use App\Services\UpdateCodexService;
use App\Services\DeleteCodexService;

//MODEL
use App\Models\CodexModel;

class CodexController extends Controller
{
    

    protected $CodexServices;
    protected $CodexImageService;
    protected $CodexCategoryService;
    protected $UpdateCodexService;
    protected $DeleteCodexService;

    public function __construct(CodexServices $CodexServices, CodexImageService $CodexImageService, CodexCategoryService $CodexCategoryService,
    UpdateCodexService $UpdateCodexService, DeleteCodexService $DeleteCodexService)
    {
        $this->CodexServices = $CodexServices;
        $this->CodexImageService = $CodexImageService;
        $this->CodexCategoryService = $CodexCategoryService;
        $this->UpdateCodexService = $UpdateCodexService;
        $this->DeleteCodexService = $DeleteCodexService;
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
        return redirect()->route('codex.category')->with('success', "Codex Added Successfully!");

    }




    // public function updateCodex(Request $request, $id)
    // {
    //     $request->validate([
    //         'CodexName' => 'nullable|string|max:255',
    //         'categoryName' => 'nullable|string|max:255',
    //         'language' => 'nullable|array',
    //         'framework' => 'nullable|array',
    //         'tag' => 'nullable|string',
    //         'level' => 'nullable|string',
    //         'content' => 'nullable|string',
    //         'code' => 'nullable|string',
    //         'instruction' => 'nullable|string',
    //         'output' => 'nullable|string',
    //         'img' => 'nullable|image|max:2048',
    //     ]);
    

        

    //     $codex = CodexModel::findOrFail($id);
    
    //     $codex->codex_name = $request->CodexName;
    //     $codex->category_name = $request->categoryName;
    //     $codex->language = $request->language;
    //     $codex->framework = $request->framework;
    //     $codex->tags = $request->tag;
    //     $codex->diffuclt_level = $request->level;
    //     $codex->content = $request->content;
    //     $codex->code_snippet = $request->code;
    //     $codex->instructions = $request->instruction;
    //     $codex->output = $request->output;
    
    //     if ($request->hasFile('img')) {
    //         $path = $request->file('img')->store('codex-images', 'public');
    //         $codex->img_path = $path;
    //     }
    
    //     $codex->save();
    
    //     return redirect()->back()->with('success', 'Codex updated successfully.');
    // }
    

    
  

    public function updateCodex(CodexRequest $request, $id){
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request); 

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request
    
        $validated['img'] = $imageName;  // amo ini an code  para an unique img name an ma store ha db
    
        $this->UpdateCodexService->upCodex($id, $validated); //adi an code para han up services

         return redirect()->route('codex.category')->with('success', "Codex updated Successfully!");
    }
 


    public function DeleteCodex($id, DeleteCodexService $deleteService)
    {
        $success = $deleteService->deleteCodex($id);

        return redirect()->route('codex.category')->with('success', "Deleted  Successfully!");
    }


}
