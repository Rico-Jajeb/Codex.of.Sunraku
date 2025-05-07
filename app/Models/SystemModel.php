<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class SystemModel extends Model
{
    use HasFactory;
    protected $table = 'setting';
    protected $fillable = [
        'system_name', 'img',
    
    ];
}
