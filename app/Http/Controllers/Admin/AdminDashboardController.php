<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\HeroSection;
use App\Models\Slideshow;
use App\Models\Sambutan; // ✅ Tambahkan ini

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBerita'        => Berita::count(),
            'totalKonten'        => HeroSection::count(),
            'totalSlideshow'     => Slideshow::count(),
            'totalSambutan'      => Sambutan::count(), // ✅ Tambahkan ini
        ]);
    }
}
