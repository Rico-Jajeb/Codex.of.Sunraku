<?php

namespace App\Services;

use App\Models\SystemModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UpdateSettingService
{

    public function upSetting($id, array $data)
    {
        $system = SystemModel::findOrFail($id);

        $fillableFields = [
            'system_name', 'system_slogan',
        ]; // add more fields as needed

        if (isset($data['system_name'])) {
            $system->system_name = $data['system_name'];
        }

        if (isset($data['system_slogan'])) {
            $system->system_slogan = $data['system_slogan'];
        }

       
        if (!empty($data['system_logo'])) {
            // Delete the old image if it exists
            $oldImagePath = public_path('storage/output/' . $system->system_logo);
            if ($system->system_logo && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Remove old image file
            }

            // Save new image filename (already uploaded by CodexImageService)
            $system->system_logo = $data['system_logo'];
        }

        if (!empty($data['system_favicon'])) {
            // Delete the old image if it exists
            $oldImagePath = public_path('storage/output/' . $system->system_favicon);
            if ($system->system_favicon && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Remove old image file
            }

            // Save new image filename (already uploaded by CodexImageService)
            $system->system_favicon = $data['system_favicon'];
        }

        $system->save();

        return $system;
    }

}
