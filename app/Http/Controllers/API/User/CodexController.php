<?php
namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CodexCategoryResource;
use App\Http\Resources\CodexResource;
use App\Models\CodexCategoryModel;
use App\Models\CodexModel;

class CodexController extends Controller
{
    public function index()
    {
        $category = CodexCategoryModel::all();

        return response()->json([
            'data'    => CodexCategoryResource::collection($category),
            'message' => 'Category retrieved successfully',
            'status'  => 'success',
        ], 200);
    }

    public function Codex()
    {

        $codex = CodexModel::all();

        return response()->json([
            'data'    => CodexResource::collection($codex),
            'message' => 'codex retrieved successfully',
            'status'  => 'success',
        ], 200);
    }

}
