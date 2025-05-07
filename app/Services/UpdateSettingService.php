<?php

namespace App\Services;

use App\Models\SystemModel;
use Illuminate\Support\Facades\Storage;

class UpdateSettingService
{

    public function upSetting($id, array $data)
    {
        $system = SystemModel::findOrFail($id);

        if (isset($data['system_name'])) {
            $system->system_name = $data['system_name'];
        }

        if (!empty($data['img'])) {
            // Delete the old image if it exists
            $oldImagePath = public_path('storage/output/' . $system->img);
            if ($system->img && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Remove old image file
            }

            // Save new image filename (already uploaded by CodexImageService)
            $system->img = $data['img'];
        }

        $system->save();

        return $system;
    }

}
