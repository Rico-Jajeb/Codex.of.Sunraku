<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AwardsModel;

class DisplayAwardService
{
    public function getData(){
        return AwardsModel::all();
    }
}