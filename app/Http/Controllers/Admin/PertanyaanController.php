<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertanyaan;

class PertanyaanController extends Controller
{

    public function index()
    {
        return view('admin.pertanyaan.index', ['pertanyaans' => Pertanyaan::all()]);
    }

    public function create()
    {
        return view('admin.pertanyaan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['pertanyaan' => 'required']);
        Pertanyaan::create($request->only('pertanyaan'));
        return redirect()->route('admin.pertanyaan.index');
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        return view('admin.pertanyaan.edit', compact('pertanyaan'));
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $request->validate(['pertanyaan' => 'required']);
        $pertanyaan->update($request->only('pertanyaan'));
        return redirect()->route('admin.pertanyaan.index');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        return back();
    }

    public function hasil()
    {
        $data = Pertanyaan::with('penilaians')->get();

        // Tambahkan persentase ke setiap pertanyaan
        foreach ($data as $pertanyaan) {
            $totalNilai = $pertanyaan->penilaians->sum('rating');
            $jumlahPenilaian = $pertanyaan->penilaians->count();
            $maksimalNilai = 5;

            if ($jumlahPenilaian > 0) {
                $rataRata = $totalNilai / $jumlahPenilaian;
                $persentase = ($rataRata / $maksimalNilai) * 100;
            } else {
                $persentase = 0;
            }

            // Tambahkan ke dalam model sementara
            $pertanyaan->persentase_nilai = round($persentase, 2); // 2 angka desimal
        }

        return view('admin.pertanyaan.hasil', compact('data'));
    }   
}
