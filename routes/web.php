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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AwardsController;

use App\Http\Controllers\Admin\GoogleUploadController; //kanan google ini


use App\Http\Controllers\User\MainPageController;
use App\Http\Controllers\User\CodexDocuController;
use App\Http\Controllers\User\ProjectControllerUser;

use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleServiceDrive;



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
    Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');   
});

//USER SIDE
Route::get('Home',[MainPageController::class, 'Home'])->name('Main.page');



Route::get('document',[CodexDocuController::class, 'codexDocu'])->name('codex.page');

Route::get('projects',[ProjectControllerUser::class, 'projectPage'])->name('project.page');

//ADMIN SIDE
Route::get('codex',[CodexController::class, 'index'])->name('new.codex');
Route::get('category',[CategoryCodexController::class, 'index'])->name('codex.category');
Route::get('settings',[SystemController::class, 'systemSetting'])->name('system.settings');
Route::get('systemProjects',[ProjectController::class, 'projects'])->name('system.projects');
Route::get('techSkill',[TechSkillController::class, 'techPage'])->name('system.skills');
Route::get('achievement',[AwardsController::class, 'awards'])->name('system.achievement');


//kanan create form
Route::post('add.Codex', [CodexController::class, 'AddCodex'])->name('addProject');

Route::post('add.Category', [CategoryCodexController::class, 'addCategory'])->name('add.Category');


Route::post('add.Setting', [SystemController::class, 'addSettings2'])->name('addSetting');

Route::post('add.Tech', [TechSkillController::class, 'addTechSkill'])->name('add.Tech');

Route::post('add.Projects', [ProjectController::class, 'AddProject'])->name('add.Projects');
Route::post('add.ScreenShot', [ProjectController::class, 'AddScreenShot'])->name('add.ScreenShot');

Route::post('add.Test', [TestController::class, 'addTest'])->name('add.Test');

Route::post('add.Award', [AwardsController::class, 'addAwards'])->name('add.Award');

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





Route::post('/upload-drive', [GoogleUploadController::class, 'uploadToDrive']);


//----- api --------
// Route::get('/auth/google', function () {
//     $client = new GoogleClient();
//     $client->setClientId(env('GOOGLE_CLIENT_ID'));
//     $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
//     $client->setRedirectUri('http://127.0.0.1:8000/callback/google');
//     $client->addScope(GoogleServiceDrive::DRIVE);
//     $client->setAccessType('offline');
//     $client->setApprovalPrompt('force');

//     $authUrl = $client->createAuthUrl();
//     return redirect($authUrl);
// });


Route::get('/callback/google', function (\Illuminate\Http\Request $request) {
    $client = new GoogleClient();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri('http://127.0.0.1:8000/callback/google');

    $code = $request->get('code');
    $token = $client->fetchAccessTokenWithAuthCode($code);
    $refreshToken = $client->getRefreshToken();

    dd($token, $refreshToken);
});


