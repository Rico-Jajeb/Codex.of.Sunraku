<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Http\Requests\CodexRequest;
use App\Services\CodexServices;
use App\Services\CodexImageService;
use App\Models\CodexModel;

class CodexController extends Controller
{
    //

    protected $CodexServices;
    protected $CodexImageService;

    public function __construct(CodexServices $CodexServices, CodexImageService $CodexImageService)
    {
        $this->CodexServices = $CodexServices;
        $this->CodexImageService = $CodexImageService;
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

        return redirect()->back()->with('success', "Codex Added Successfully!");
    }

}
