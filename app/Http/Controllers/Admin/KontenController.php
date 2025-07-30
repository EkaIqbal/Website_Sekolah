<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    public function index()
    {
        // Ganti ini dengan logika sesuai kebutuhan kamu
        return view('admin.konten.index', [
            'kontenList' => [] // contoh data kosong
        ]);
    }
}
