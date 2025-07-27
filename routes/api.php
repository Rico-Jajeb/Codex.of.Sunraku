<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\TechSkillController;

use App\Http\Controllers\API\User\APIMainPageController;
use App\Http\Controllers\API\User\ProjectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware(['throttle:60,1'])
    ->prefix('v1')
    ->group(function () {
        Route::get('/tech-skills', [TechSkillController::class, 'index']);
        Route::get('/projects-api', [ProjectController::class, 'index']);
        Route::post('/tech-skills', [TechSkillController::class, 'addSkills']);
});


Route::get('/system-info', [APIMainPageController::class, 'index']);