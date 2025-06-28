<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class ProjectModel extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'proj_name', 'proj_description', 
        'img', 'github_url',
        'live_url', 'status',
        'language', 'framework' 
    ];

    protected $casts = [
        //amo ini an kanan multiselect han codex an kanan language ngan framework
        'language' => 'array',
        'framework' => 'array',
    ];
}
