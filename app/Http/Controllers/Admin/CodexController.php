<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Http\Requests\CodexRequest;
use App\Services\CodexServices;
use App\Models\CodexModel;

class CodexController extends Controller
{
    //

    protected $CodexServices;

    public function __construct(CodexServices $CodexServices)
    {
        $this->CodexServices = $CodexServices;
    }
    

    public function index(){
        return Inertia::render('Admin/NewCodex');
    }

    public function AddCodex(CodexRequest $request){
        $validated = $request->validated();
        $this->CodexServices->create($validated); //bali an code para han create aadto ha services
        return redirect()->back()->with('success', "");
    }
}
