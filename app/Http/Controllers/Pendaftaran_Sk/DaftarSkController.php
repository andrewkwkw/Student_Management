<?php

namespace App\Http\Controllers\Pendaftaran_Sk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarSk;
use App\Models\SidangHasil;
use Illuminate\Support\Facades\Auth;

class DaftarSkController extends Controller
{
    public function create()
    {
        $userId = Auth::id();
        $sidangHasil = SidangHasil::where('user_id', $userId)->first();

        if (!$sidangHasil || !$sidangHasil->nilai_sidang_hasil) {
            return redirect()->back()->with('warning', 'Anda belum memiliki nilai Sidang Hasil.');
        }

        // Cek apakah user sudah pernah daftar SK
        $sudahAda = DaftarSk::where('user_id', $userId)->first();
        if ($sudahAda) {
            return redirect()->route('mahasiswa.pendaftaran_sk.show', $sudahAda->id)
                            ->with('info', 'Anda sudah pernah mendaftar SK.');
        }

        return view('mahasiswa.pendaftaran_sk.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        // Pastikan nilai sidang hasil sudah ada
        $sidangHasil = SidangHasil::where('user_id', $userId)->first();
        if (!$sidangHasil || !$sidangHasil->nilai_sidang_hasil) {
            return redirect()->back()->with('warning', 'Nilai Sidang Hasil Anda belum ada.');
        }

        // Validasi input jadwal_yudisium
        $validated = $request->validate([
            'jadwal_yudisium' => ['nullable','string','max:255'],
        ]);

        // Cegah double daftar
        $sudahAda = DaftarSk::where('user_id', $userId)->first();
        if ($sudahAda) {
            return redirect()->route('mahasiswa.pendaftaran_sk.show', $sudahAda->id)
                             ->with('info', 'Anda sudah pernah mendaftar SK.');
        }

        $daftarSk = DaftarSk::create([
            'user_id' => $userId,
            'jadwal_yudisium' => $validated['jadwal_yudisium'] ?? null,
        ]);

        return redirect()->route('mahasiswa.pendaftaran_sk.show', $daftarSk->id)
                         ->with('success', 'Pendaftaran SK berhasil.');
    }

    public function show(DaftarSk $daftarSk)
    {
        if (Auth::id() !== $daftarSk->user_id) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan melihat data ini.');
        }

        // Ambil nilai sidang hasil langsung dari tabel sidang_hasil
        $nilaiSidangHasil = SidangHasil::where('user_id', $daftarSk->user_id)->value('nilai_sidang_hasil');

        return view('mahasiswa.pendaftaran_sk.show', compact('daftarSk', 'nilaiSidangHasil'));
    }
}
