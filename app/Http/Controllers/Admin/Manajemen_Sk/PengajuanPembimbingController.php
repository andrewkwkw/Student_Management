<?php

namespace App\Http\Controllers\Admin\Manajemen_Sk;

use App\Http\Controllers\Controller;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;

class PengajuanPembimbingController extends Controller
{
    // Menampilkan daftar pengajuan pembimbing (dengan pencarian)
    public function show(Request $request)
    {
        $query = PengajuanPembimbing::with('user')->latest();

        // 🔍 Jika ada pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('bidang_minat', 'like', "%{$search}%")
                  ->orWhere('dosen_1', 'like', "%{$search}%")
                  ->orWhere('dosen_2', 'like', "%{$search}%");
            })->orWhere('judul_sk', 'like', "%{$search}%");
        }

        $pengajuans = $query->get();

        return view('admin.manajemen_sk.pengajuan_pembimbing.show', compact('pengajuans'));
    }

    // Form edit pengajuan pembimbing
    public function edit($id)
    {
        $pengajuan = PengajuanPembimbing::findOrFail($id);
        return view('admin.manajemen_sk.pengajuan_pembimbing.edit', compact('pengajuan'));
    }

    // Update pengajuan pembimbing
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pengajuan' => 'required|in:Diajukan,Diterima,Ditolak',
            'dosen_1'          => 'required|max:255',
            'dosen_2'          => 'nullable|max:255',
        ]);

        $pengajuan = PengajuanPembimbing::findOrFail($id);
        $pengajuan->update([
            'status_pengajuan' => $request->status_pengajuan,
            'dosen_1'          => $request->dosen_1,
            'dosen_2'          => $request->dosen_2,
        ]);

        return redirect()->route('admin.manajemen_sk.pengajuan_pembimbing.show')
                         ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    // Hapus pengajuan pembimbing
    public function destroy($id)
    {
        $pengajuan = PengajuanPembimbing::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('admin.manajemen_sk.pengajuan_pembimbing.show')
                        ->with('success', 'Pengajuan berhasil dihapus.');
    }

}
