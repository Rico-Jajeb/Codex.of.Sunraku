<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\TechSkillController;

use App\Http\Controllers\API\User\APIMainPageController;
use App\Http\Controllers\API\User\ProjectController;
use App\Http\Controllers\API\User\CodexController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware(['throttle:60,1'])
    ->prefix('v1')
    ->group(function () {
        Route::get('/tech-skills', [TechSkillController::class, 'index']);
        Route::get('/projects-api', [ProjectController::class, 'index']);
        Route::get('/screenshots-projects-api', [ProjectController::class, 'screenshot']);

        Route::get('/codex-category', [CodexController::class, 'index']);
        Route::get('/codex-api', [CodexController::class, 'Codex']);

        Route::post('/tech-skills', [TechSkillController::class, 'addSkills']);
});


Route::get('/system-info', [APIMainPageController::class, 'index']);