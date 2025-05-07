<?php

namespace App\Services;

use App\Models\SystemModel;

class UpdateSettingService
{
    public function updateCategory($id, array $data)
    {
        $system = SystemModel::findOrFail($id);

        if (isset($data['system_name'])) {
            $system->system_name = $data['system_name'];
        }

        if (!empty($data['img'])) {
            $system->img = $data['img'];
        }

        $system->save();

        return $system;
    }
}
