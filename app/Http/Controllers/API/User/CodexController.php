<?php
namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CodexCategoryResource;
use App\Models\CodexCategoryModel;

class CodexController extends Controller
{
    public function index()
    {
        $category = CodexCategoryModel::all();

        return response()->json([
            'data'    => CodexCategoryResource::collection($category),
            'message' => 'Projects retrieved successfully',
            'status'  => 'success',
        ], 200);
    }
}
