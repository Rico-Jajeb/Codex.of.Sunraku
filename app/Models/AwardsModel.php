<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class AwardsModel extends Model
{
    use HasFactory;
    protected $table='awards';
    protected $fillable =[
        'award_title', 'award_description', 'issuer',
        'Date', 'award_url', 'highlight', 'img',
    ];
}
