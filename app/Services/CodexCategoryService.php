<?php

namespace App\Services;

use App\Models\CodexCategoryModel; //tapos adi an moddel

class CodexCategoryService
{

    public function create(array $data)
    {
        
        //amo ini an code para pag insert han data tikang ha form tikadto database table
        return CodexCategoryModel::create([
            'category_name' => $data['CategoryName'],
            'description' => $data['CategoryDesc'],
            'status' => 'Active',
            'img' => $data['img'],
        ]);
    

    }

}
