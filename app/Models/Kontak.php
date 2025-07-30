<?php

// app/Models/Kontak.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'map_embed',
    ];
}
