<?php

namespace App\Services;

use App\Models\CodexModel; //tapos adi an moddel

class CodexServices
{

    public function create(array $data)
    {
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return CodexModel::create([
            'codex_name' => $data['codex_name'],
       
            'language' => $data['language'],
            'framework' => $data['framework'],
            'tags' => $data['tags'],
            'diffuclt_level' => $data['diffuclt_level'],
            'content' => $data['content'],
            'code_snippet' => $data['code_snippet'],
            'instructions' => $data['instructions'],
            'output' => $data['output'],
            'img' => $data['img'],
            'category_name' => $data['category_name'],
        ]);
    }

}
