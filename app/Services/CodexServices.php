<?php

namespace App\Services;

use App\Models\CodexModel; //tapos adi an moddel

class CodexServices
{

    public function create(array $data)
    {
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return CodexModel::create([
            'codex_name' => $data['CodexName'],
            'language' => $data['language'],
            'framework' => $data['framework'],
            'tags' => $data['tag'],
            'diffuclt_level' => $data['level'],
            'content' => $data['content'],
            'code_snippet' => $data['code'],
            'instructions' => $data['instruction'],
            'output' => $data['output'],
            'img' => $data['img'],
        ]);
    }

}
