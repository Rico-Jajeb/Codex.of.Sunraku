<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class TechSkillModel extends Model
{
    use HasFactory;
    protected $table = 'tech_skills';
    protected $fillable = [
        'tech_name' ,'img', 
    
    ];

    // kanan api ini pag return han url han system tas an image
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('storage/output/' . $this->img);
    }

}
