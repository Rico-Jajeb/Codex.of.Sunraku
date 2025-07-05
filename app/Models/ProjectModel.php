<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

use App\Models\TestModel; 
use App\Models\ProjectScreenshot; 

class ProjectModel extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'proj_name', 'proj_description', 
        'img', 'github_url',
        'live_url', 'status',
        'language', 'framework', 'highlight', 
    ];

    protected $casts = [
        //amo ini an kanan multiselect han codex an kanan language ngan framework
        'language' => 'array',
        'framework' => 'array',
    ];


    // public function screenshots()
    // {
    //     return $this->hasMany(ProjectScreenshot::class);
    // }

    // public function test(){
    //     return $this->hasMany(TestModel::class,  'project_id' );
    // }
    public function screenshots(){
        return $this->hasMany(ProjectScreenshot::class,  'project_id' );
    }

}
