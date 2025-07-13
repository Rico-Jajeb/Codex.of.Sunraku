<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class SystemModel extends Model
{
    use HasFactory;
    protected $table = 'settings_info';
    protected $fillable = [
        'system_name', 'system_slogan', 'system_logo', 'system_favicon',
        'facebook', 'linked', 'github', 'email',
    
    ];

    // kanan api ini pag return han url han system tas an image
  protected $appends = ['image_url', 'image_logo'];

    public function getImageUrlAttribute()
    {
        return url('storage/output/' . $this->system_favicon);
    }

    public function getImageLogoAttribute()
    {
        return url('storage/output/' . $this->system_logo);
    }

}
