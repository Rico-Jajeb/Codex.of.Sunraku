<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemRequest;
use App\Services\CodexImageService;

//REQUEST
use App\Services\DisplaySettingService;

//SERVICES

use App\Services\GoogleDriveService;
use App\Services\Image\SettingFaviconService;
use App\Services\Image\SettingLogoService;
use App\Services\Image\ResumeService;

use App\Services\SystemSettingService;
use App\Services\UpdateSettingService;

//MODEL

use Inertia\Inertia;

class SystemController extends Controller
{

    protected $CodexImageService;
    protected $SystemSettingService;
    protected $DisplaySettingService;
    protected $UpdateSettingService;
    protected $SettingLogoService;
    protected $SettingFaviconService;
    protected $GoogleDriveService;
    protected $ResumeService;

    public function __construct(CodexImageService $CodexImageService, SystemSettingService $SystemSettingService,
        DisplaySettingService $DisplaySettingService, UpdateSettingService $UpdateSettingService,
        SettingLogoService $SettingLogoService, SettingFaviconService $SettingFaviconService, 
        GoogleDriveService $GoogleDriveService, ResumeService $ResumeService) {
        $this->CodexImageService     = $CodexImageService;
        $this->SystemSettingService  = $SystemSettingService;
        $this->DisplaySettingService = $DisplaySettingService;
        $this->UpdateSettingService  = $UpdateSettingService;
        $this->SettingLogoService    = $SettingLogoService;
        $this->SettingFaviconService = $SettingFaviconService;
        $this->GoogleDriveService    = $GoogleDriveService;
        $this->ResumeService         = $ResumeService;
    }

    public function systemSetting()
    {
        $data = $this->DisplaySettingService->getAllData();

        return Inertia::render('Admin/SystemSettings', [
            'data' => $data,
        ]);
    }

    public function addSettings2(SystemRequest $request)
    {
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName = $this->CodexImageService->handleImageUpload($request);

        $validated        = $request->validated();       // amo liwat ini an kanna validation adto ha request
        $validated['img'] = $imageName;                  // amo ini an code  para an unique img name an ma store ha db
        $this->SystemSettingService->create($validated); // tas ig ppasa an data ngadto serivice para pag insert ngadto database

        // return redirect()->back()->with('success', "Codex Added Successfully!");
        return redirect()->back()->with('success', 'Codex updated successfully.');

    }



    // public function updateSetting(SystemRequest $request, $id)
    // {
    //     // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
    //     $imageName  = $this->SettingLogoService->handleImageUpload($request);
    //     $imageName2 = $this->SettingFaviconService->handleImageUpload($request);

    //     $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request

    //     $validated['system_logo']    = $imageName;  // amo ini an code  para an unique img name an ma store ha db
    //     $validated['system_favicon'] = $imageName2; // amo ini an code  para an unique img name an ma store ha db

    //     $this->UpdateSettingService->upSetting($id, $validated); //adi an code para han up services

    //     // return redirect()->route('codex.category')->with('success', "Category Added Successfully!");return back();
    //     return redirect()->route('system.settings')->with('success', "Category Updated Successfully!");
    // }


    public function updateSetting(SystemRequest $request, $id)
    {
        // amo ini an knn image upload ato ha CodexImageService (bali reusable ini)
        $imageName  = $this->SettingLogoService->handleImageUpload($request);
        $imageName2 = $this->SettingFaviconService->handleImageUpload($request);
        $cv = $this->ResumeService->handleFileUpload($request);

        $validated = $request->validated(); // amo liwat ini an kanna validation adto ha request

        $validated['system_logo']    = $imageName;  // amo ini an code  para an unique img name an ma store ha db
        $validated['system_favicon'] = $imageName2; // amo ini an code  para an unique img name an ma store ha db
        $validated['resume'] = $cv; // amo ini an code  para an unique img name an ma store ha db

        $this->UpdateSettingService->upSetting($id, $validated); //adi an code para han up services

        // return redirect()->route('codex.category')->with('success', "Category Added Successfully!");return back();
        return redirect()->route('system.settings')->with('success', "Category Updated Successfully!");
    }



//    public function uploadToDrive(Request $request, GoogleDriveService $driveService)
//     {
//         $request->validate([
//             'file' => 'required|file|max:10240',
//         ]);

//         $file = $request->file('file');
//         $folderId = '1RJSKJgzuR7nQQg2s69z0fdRRgDXcF9cO';
//         //$result = $driveService->upload($file);

//         $result = $driveService->upload($file, $folderId );

//         return response()->json([
//             'message' => 'File uploaded to Google Drive!',
//             'drive_file_id' => $result['id'],
//             'drive_link' => $result['link'],
//         ]);
//     }

    public function uploadDatabaseToDrive(GoogleDriveService $driveService)
    {
        $dbPath   = database_path('database.sqlite');
        $folderId = '1RJSKJgzuR7nQQg2s69z0fdRRgDXcF9cO';

        if (! file_exists($dbPath)) {
            return response()->json(['message' => 'Database file not found.'], 404);
        }

        $result = $driveService->uploadFromPath($dbPath, 'database.sqlite', $folderId);

        return redirect()->route('system.settings')->with('success', "Category Updated Successfully!");
    }

}
