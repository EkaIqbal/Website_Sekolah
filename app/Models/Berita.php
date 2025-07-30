<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image_url',
        'link',
    ];
}

