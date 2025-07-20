<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TechSkillModel;

use App\Http\Resources\TechSkillResource;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class TechSkillController extends Controller
{
    
    public function index()
    {
        return response()->json(TechSkillResource::collection(TechSkillModel::all())->resolve());
    }

    
    // public function addSkills(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'tech_name' => 'required|string|max:255',
    //         'img' => 'required|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation failed',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $techSkill = TechSkillModel::create([
    //         'tech_name' => $request->tech_name,
    //         'img' => $request->img,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Tech skill added successfully',
    //         'data' => new TechSkillResource($techSkill),
    //     ], 201);
    // }


    public function addSkills(Request $request)
    {
        $request->validate([
            'tech_name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filename = $request->file('img')->store('public/storage/output');
        $basename = basename($filename);

        $techSkill = TechSkillModel::create([
            'tech_name' => $request->tech_name,
            'img' => $basename,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Skill uploaded successfully',
            'data' => new TechSkillResource($techSkill),
        ], 201);
    }


}
