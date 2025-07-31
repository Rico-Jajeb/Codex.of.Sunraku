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
        'category_name', 'categoryName',
    ];

    protected $casts = [
        //amo ini an kanan multiselect han codex an kanan language ngan framework
        'language' => 'array',
        'framework' => 'array',
    ];

    // kanan api ini pag return han url han system tas an image
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('storage/output/' . $this->img);
    }
}
