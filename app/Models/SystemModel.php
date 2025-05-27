<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class SystemModel extends Model
{
    use HasFactory;
    protected $table = 'settings_info';
    protected $fillable = [
        'system_name', 'system_slogan', 'system_logo', 'system_favicon',
        'facebook', 'linked', 'github', 'email',
    
    ];
}
