<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Struktur;

class StrukturController extends Controller
{
    public function index()
    {
        return view('admin.struktur.index');
    }
}
