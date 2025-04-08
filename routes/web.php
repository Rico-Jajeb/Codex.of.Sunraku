<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\CodexController;
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

Route::post('add.Project', [CodexController::class, 'AddCodex'])->name('addProject');