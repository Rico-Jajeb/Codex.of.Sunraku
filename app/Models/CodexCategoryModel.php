<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
class CodexCategoryModel extends Model
{
    //
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [
        'category_name', 'description', 
        'status', 'img',
    ];
}
