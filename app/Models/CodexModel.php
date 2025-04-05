<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory; 

class CodexModel extends Model
{
    
    //
    use HasFactory;
    protected $table = 'codex';
    protected $fillable = [
        'codex_name', 'language', 
        'framework', 'tags',
        'diffuclt_level', 'content',
        'code_snippet', 'instructions',
        'output', 'img',
    ];
   
}
