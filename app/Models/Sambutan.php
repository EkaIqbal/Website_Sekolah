<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    // Nama tabel (opsional jika sama dengan nama model jamak)
    protected $table = 'sambutans';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'judul',
        'sub_judul',
        'deskripsi',
        'foto'
    ];

    // Jika ingin akses URL lengkap ke foto
    public function getFotoUrlAttribute()
    {
        return asset('storage/' . $this->foto);
    }
}
