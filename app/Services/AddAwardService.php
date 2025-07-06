<?php

namespace App\Services;

use App\Models\AwardsModel; //tapos adi an moddel

class AddAwardService
{

    public function create(array $data){

        return AwardsModel::create([
            'award_title' => $data['award_title'],
            'award_description' => $data['award_description'],
            'issuer' => $data['issuer'],
            'Date' => $data['Date'],
            'award_url' => $data['award_url'],
            'highlight' => $data['highlight'],
            'img' => $data['img'],
        ]);

    }
}
