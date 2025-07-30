<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Pertanyaan;

class PenilaianController extends Controller
{
    public function index()
    {
        $pertanyaans = Pertanyaan::all();
        return view('kontak', compact('pertanyaans'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $ratings = $request->input('ratings'); // array [pertanyaan_id => rating]
        $sarans  = $request->input('sarans');  // array [pertanyaan_id => saran]

        foreach ($ratings as $pertanyaan_id => $rating) {
            Penilaian::create([
                'pertanyaan_id' => $pertanyaan_id,
                'rating'        => $rating ?? 0, // default 0 jika tidak diisi
                'saran'         => $sarans[$pertanyaan_id] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
