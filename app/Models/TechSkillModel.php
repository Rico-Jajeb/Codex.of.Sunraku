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
}
