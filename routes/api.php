<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\TechSkillController;

use App\Http\Controllers\API\User\APIMainPageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {
    Route::get('/tech-skills', [TechSkillController::class, 'index']);
});


Route::get('/system-info', [APIMainPageController::class, 'index']);