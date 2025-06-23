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
        'thumbnail', 'github_url',
        'live_url', 'status',
    ];

    protected $casts = [
        //amo ini an kanan multiselect han codex an kanan language ngan framework
        'language' => 'array',
        'framework' => 'array',
        'screenshots' => 'array',
    ];
}
