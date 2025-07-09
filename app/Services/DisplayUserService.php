<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class DisplayUserService
{
    public function getUsers(){
        return UserModel::all();
    }
}