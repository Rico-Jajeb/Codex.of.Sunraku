<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodexCategoryModel extends Model
{
    //
    use HasFactory;
    protected $table    = 'category';
    protected $fillable = [
        'category_name', 'description',
        'status', 'img',
    ];

    // kanan api ini pag return han url han system tas an image
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('storage/output/' . $this->img);
    }
}
