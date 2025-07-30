<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\VisiMisi;
use App\Models\HeroSection;

use App\Models\SosialMedia;


use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\View;


class UIController extends Controller
{
    public function __construct()
    {
        // Bagikan variabel $sosials ke semua view
        View::share('sosials', SosialMedia::all());
    }

    public function home()
    {
        $slides = Slide::where('active', 1)->orderBy('order_number')->get();
        $heroSections = HeroSection::all();
        $beritas = Berita::latest()->take(3)->get();
        $galeris = Galeri::orderBy('created_at', 'desc')->take(3)->get();

        return view('ui.home', compact(
            'slides',
            'heroSections',
            'beritas',
            'galeris'
        ));
    }


    public function profil()
    {
        return view('ui.profil');
    }

    public function tentang()
    {
        return view('ui.tentang');
    }

    public function kontak()
    {
        $kontak = Kontak::latest()->first();

        return view('ui.kontak', compact('kontak'));
    }

    public function visiMisi()
    {
        $data = VisiMisi::first();

        if ($data) {
            $data->misi = json_decode($data->misi, true);
        }

        return view('ui.visi_misi', compact('data'));
    }

    public function struktur()
    {
        $struktur = StrukturOrganisasi::latest()->first();
        return view('ui.struktur', compact('struktur'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->get();
        return view('ui.galeri', compact('galeris'));
    }


    public function storePenilaian(Request $request)
    {
        $request->validate([
            'ratings' => 'required|array',
            'ratings.*' => 'required|integer|min:1|max:5',
            'sarans' => 'nullable|array',
            'sarans.*' => 'nullable|string|max:1000'
        ]);

        return redirect()->route('kontak')->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
