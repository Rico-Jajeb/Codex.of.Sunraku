<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\CodexController;
use App\Http\Controllers\Admin\CategoryCodexController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechSkillController;
use App\Http\Controllers\Admin\TestController;


use App\Http\Controllers\User\MainPageController;
use App\Http\Controllers\User\CodexDocuController;

// Route::get('/', function () {
//     return Inertia::render('Home/MainPage', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


Route::get('/', [MainPageController::class, 'Home'])->name('Main.page');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//USER SIDE
Route::get('Home',[MainPageController::class, 'Home'])->name('Main.page');

Route::get('document',[CodexDocuController::class, 'codexDocu'])->name('codex.page');

//ADMIN SIDE
Route::get('codex',[CodexController::class, 'index'])->name('new.codex');
Route::get('category',[CategoryCodexController::class, 'index'])->name('codex.category');
Route::get('settings',[SystemController::class, 'systemSetting'])->name('system.settings');
Route::get('systemProjects',[ProjectController::class, 'projects'])->name('system.projects');
Route::get('techSkill',[TechSkillController::class, 'techPage'])->name('system.skills');


//kanan create form
Route::post('add.Codex', [CodexController::class, 'AddCodex'])->name('addProject');

Route::post('add.Category', [CategoryCodexController::class, 'addCategory'])->name('add.Category');


Route::post('add.Setting', [SystemController::class, 'addSettings2'])->name('addSetting');

Route::post('add.Tech', [TechSkillController::class, 'addTechSkill'])->name('add.Tech');

Route::post('add.Projects', [ProjectController::class, 'AddProject'])->name('add.Projects');
Route::post('add.ScreenShot', [ProjectController::class, 'AddScreenShot'])->name('add.ScreenShot');

Route::post('add.Test', [TestController::class, 'addTest'])->name('add.Test');

//kanan update form
//Route::post('/categories/update/{id}', [CategoryCodexController::class, 'update'])->name('categories.update');
Route::put('/categories/{id}', [CategoryCodexController::class, 'updateCategory'])->name('categories.update');



Route::put('/system/{id}', [SystemController::class, 'updateSetting'])->name('system.update');


Route::put('/codexup/{id}', [CodexController::class, 'updateCodex'])->name('codex.update');


Route::put('/skillup/{id}', [TechSkillController::class, 'updateTechSkill'])->name('skill.update');

Route::put('/projectup/{id}', [ProjectController::class, 'updateProject'])->name('project.update');






// Route::put('/admin/codex/{id}', [CodexController::class, 'updateCodex'])->name('codex.update');


//kanan delete
Route::delete('/posts/{id}', [CategoryCodexController::class, 'destroy'])->name('posts.destroy');

Route::delete('/skill/{id}', [TechSkillController::class, 'destroy'])->name('skill.destroy');

Route::delete('/deleteCodex/{id}', [CodexController::class, 'DeleteCodex'])->name('codex.destroy');

Route::delete('/deletProject/{id}', [ProjectController::class, 'destroyProject'])->name('project.destroy');

Route::delete('/deletScreenshot/{id}', [ProjectController::class, 'destroyScreenshot'])->name('screenshot.destroy');