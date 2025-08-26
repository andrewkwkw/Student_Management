<?php

namespace App\Http\Controllers\Pendaftaran_Sk;

use App\Http\Controllers\Controller;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanPembimbingController extends Controller
{
    public function create()
    {

        $pengajuan = PengajuanPembimbing::where('user_id', Auth::id())->first();

        if ($pengajuan) {
            return redirect()
                ->route('mahasiswa.pengajuan_pembimbing.show', $pengajuan->id)
                ->with('info', 'Anda sudah mendaftar dosen pembimbing. Jika ada kekeliruan, hubungi admin: admin@example.com');
        }

        return view('mahasiswa.pengajuan_pembimbing.create');
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_sk'      => 'required|max:255',
            'bidang_minat'  => 'required|in:RPL,Kecerdasan Buatan,Jaringan,Hardware',
        ]);

        $pengajuan = PengajuanPembimbing::create([
            'user_id'           => Auth::id(),
            'judul_sk'          => $request->judul_sk,
            'bidang_minat'      => $request->bidang_minat,
            'dosen_1'           => '',
            'dosen_2'           => '',
            'status_pengajuan'  => 'Diajukan',
        ]);

        // langsung redirect ke halaman detail
        return redirect()->route('mahasiswa.pengajuan_pembimbing.show', $pengajuan->id)
                         ->with('success', 'Pengajuan berhasil diajukan!');
    }

    public function show($id)
    {
        // Cari data berdasarkan id
        $pengajuan = PengajuanPembimbing::find($id);

        // Kalau data tidak ada (sudah dihapus admin)
        if (!$pengajuan) {
            return redirect()
                ->route('mahasiswa.pengajuan_pembimbing.create')
                ->with('warning', 'Data pengajuan Anda sudah dihapus admin. Silakan daftar kembali.');
        }

        // Pastikan mahasiswa hanya bisa lihat punyanya sendiri
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak boleh mengakses data ini');
        }

        return view('mahasiswa.pengajuan_pembimbing.show', compact('pengajuan'));
    }
}
