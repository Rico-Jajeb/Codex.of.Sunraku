<?php
namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectScreenshotResource;
use App\Models\ProjectModel;
use App\Models\ProjectScreenshot;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = ProjectModel::all();

        return response()->json([
            'data'    => ProjectResource::collection($projects),
            'message' => 'Projects retrieved successfully',
            'status'  => 'success',
        ], 200);
    }

    public function screenshot()
    {
        $screenshots = ProjectScreenshot::all();

        return response()->json([
            'data'    => ProjectScreenshotResource::collection($screenshots),
            'message' => 'Screenshots retrieved successfully',
            'status'  => 'success',
        ], 200);
    }

}
