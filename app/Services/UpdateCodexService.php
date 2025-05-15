<?php

namespace App\Services;

use App\Models\CodexModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UpdateCodexService
{

    // public function upCodex($id, array $data)
    // {
    //     $codex = CodexModel::findOrFail($id);

    //     $fillableFields = [
    //         'codex_name','category_name','tags','content',
    //         'code_snippet', 'instructions', 'output', 'diffuclt_level',
    //         'framework', 'language',
    
    //     ]; // add more fields as needed

    //     if (isset($data['codex_name'])) {
    //         $codex->codex_name = $data['codex_name'];
    //     }

    //     if (isset($data['category_name'])) {
    //         $codex->category_name = $data['category_name'];
    //     }

    //     if (isset($data['tags'])) {
    //         $codex->tags = $data['tags'];
    //     }

    //     if (isset($data['content'])) {
    //         $codex->content = $data['content'];
    //     }

    //     if (isset($data['code_snippet'])) {
    //         $codex->code_snippet = $data['code_snippet'];
    //     }

    //     if (isset($data['instructions'])) {
    //         $codex->instructions = $data['instructions'];
    //     }

    //     if (isset($data['output'])) {
    //         $codex->output = $data['output'];
    //     }

    //     if (isset($data['diffuclt_level'])) {
    //         $codex->diffuclt_level = $data['diffuclt_level'];
    //     }

    //     if (isset($data['framework'])) {
    //         $codex->framework = $data['framework'];
    //     }

    //     if (isset($data['language'])) {
    //         $codex->language = $data['language'];
    //     }




    //     if (!empty($data['img'])) {
    //         // Delete the old image if it exists
    //         $oldImagePath = public_path('storage/output/' . $codex->img);
    //         if ($codex->img && file_exists($oldImagePath)) {
    //             unlink($oldImagePath); // Remove old image file
    //         }

    //         // Save new image filename (already uploaded by CodexImageService)
    //         $codex->img = $data['img'];
    //     }

    //     $codex->save();

    //     return $codex;
    // }







    public function upCodex($id, array $data)
    {

           Log::info("UpdateCodexService called", [
            'id' => $id,
            'incoming_data' => $data,
        ]);


        $codex = CodexModel::findOrFail($id);

        $fillableFields = [
            'codex_name','category_name','tags','content',
            'code_snippet', 'instructions', 'output', 'diffuclt_level',
            'framework', 'language',
    
        ]; // add more fields as needed

        if (isset($data['codex_name'])) {
            $codex->codex_name = $data['codex_name'];
        }

        if (isset($data['category_name'])) {
            $codex->category_name = $data['category_name'];
        }

        if (isset($data['tags'])) {
            $codex->tags = $data['tags'];
        }

        if (isset($data['content'])) {
            $codex->content = $data['content'];
        }

        if (isset($data['code_snippet'])) {
            $codex->code_snippet = $data['code_snippet'];
        }

        if (isset($data['instructions'])) {
            $codex->instructions = $data['instructions'];
        }

        if (isset($data['output'])) {
            $codex->output = $data['output'];
        }

        if (isset($data['diffuclt_level'])) {
            $codex->diffuclt_level = $data['diffuclt_level'];
        }

        if (isset($data['framework'])) {
            $codex->framework = $data['framework'];
        }

        if (isset($data['language'])) {
            $codex->language = $data['language'];
        }




        if (!empty($data['img'])) {
            // Delete the old image if it exists
            $oldImagePath = public_path('storage/output/' . $codex->img);
            if ($codex->img && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Remove old image file
            }

            // Save new image filename (already uploaded by CodexImageService)
            $codex->img = $data['img'];
        }

        $codex->save();

        return $codex;
    }

}
