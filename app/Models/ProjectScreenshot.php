<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectScreenshot extends Model
{
    use HasFactory;

    protected $table = 'project_screenshot';

    protected $fillable = [
        'project_id',
        'img',
        'features',
    ];

    /**
     * Each screenshot belongs to one project.
     */
    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id');
    }

    protected $appends = ['image_url2'];

    public function getImageUrl2Attribute()
    {
        return url('storage/screenshot/' . $this->img);
    }

}
