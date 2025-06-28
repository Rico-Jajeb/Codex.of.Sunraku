<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectScreenshot extends Model
{
    use HasFactory;

    protected $table = 'project_screenshot';

    protected $fillable = [
        'project_id',
        'img',
    ];

    /**
     * Each screenshot belongs to one project.
     */
    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id', 'id');
    }
}
