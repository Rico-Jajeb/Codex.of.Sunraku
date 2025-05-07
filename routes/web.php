<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\CodexController;
use App\Http\Controllers\Admin\CategoryCodexController;
use App\Http\Controllers\Admin\SystemController;


use App\Http\Controllers\User\MainPageController;

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

//ADMIN SIDE
Route::get('codex',[CodexController::class, 'index'])->name('new.codex');
Route::get('category',[CategoryCodexController::class, 'index'])->name('codex.category');
Route::get('settings',[SystemController::class, 'systemSetting'])->name('system.settings');


//kanan form
Route::post('add.Project', [CodexController::class, 'AddCodex'])->name('addProject');

Route::post('add.Category', [CategoryCodexController::class, 'addCategory'])->name('addProject');


Route::post('add.Setting', [SystemController::class, 'addSettings2'])->name('addSetting');

//kanan update form
//Route::post('/categories/update/{id}', [CategoryCodexController::class, 'update'])->name('categories.update');
Route::put('/categories/{id}', [CategoryCodexController::class, 'updateCategory'])->name('categories.update');



Route::put('/system/{id}', [SystemController::class, 'updateSetting'])->name('system.update');






Route::put('/admin/codex/{id}', [CodexController::class, 'updateCodex'])->name('codex.update');


//kanan delete
Route::delete('/posts/{id}', [CategoryCodexController::class, 'destroy'])->name('posts.destroy');