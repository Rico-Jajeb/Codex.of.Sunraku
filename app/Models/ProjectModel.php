<?php
namespace App\Models;

use App\Models\ProjectScreenshot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table    = 'projects';
    protected $fillable = [
        'proj_name', 'proj_description',
        'img', 'github_url',
        'live_url', 'status',
        'language', 'framework', 'highlight',
    ];

    protected $casts = [
        //amo ini an kanan multiselect han codex an kanan language ngan framework
        'language'  => 'array',
        'framework' => 'array',
    ];

    public function screenshots()
    {
        return $this->hasMany(ProjectScreenshot::class, 'project_id');
    }

    // kanan api ini pag return han url han system tas an image

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('storage/output/' . $this->img);
    }
}
