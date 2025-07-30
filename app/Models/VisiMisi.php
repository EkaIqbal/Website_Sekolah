<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['visi', 'misi'];

    protected $casts = [
        'misi' => 'array',
    ];
}

