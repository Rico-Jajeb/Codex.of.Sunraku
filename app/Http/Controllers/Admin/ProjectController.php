<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

class ProjectController extends Controller
{
    
    public function projects(){
        return Inertia::render('Admin/Projects');
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
    
}
