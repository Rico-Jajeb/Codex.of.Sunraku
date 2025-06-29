<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


use App\Models\ProjectModel; 

class TestModel extends Model
{
    use HasFactory;
    protected $table = 'test';
    protected $fillable = [
        'img', 'project_id'
    
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class,  'project_id');
    }
}
