<?php

namespace App\Http\Controllers\Admin\Manajemen_Sk;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSkPembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanSkPembimbingController extends Controller
{
    /**
     * Menampilkan detail pengajuan SK Pembimbing.
     * Menggunakan Route Model Binding untuk mengambil data pengajuan secara otomatis.
     */
    public function show(PengajuanSkPembimbing $pengajuan)
    {
        $pengajuans = PengajuanSkPembimbing::with('user')->latest()->get();

        return view('admin.manajemen_sk.pengajuan_sk_pembimbing.show', compact('pengajuans'));
    }

    /**
     * Menampilkan form untuk mengunggah SK Pembimbing.
     * Halaman ini digunakan oleh admin untuk memproses pengajuan.
     */
    public function edit(PengajuanSkPembimbing $pengajuan)
    {
        // Tampilkan view edit dan kirimkan data pengajuan
        return view('admin.manajemen_sk.pengajuan_sk_pembimbing.edit', compact('pengajuan'));
    }

    /**
     * Menyimpan file SK Pembimbing yang diunggah oleh admin.
     */
    public function update(Request $request, PengajuanSkPembimbing $pengajuan)
    {
        // Validasi file yang diunggah
        $request->validate([
            'sk_pembimbing' => 'required|file|mimes:pdf|max:2048', // File harus PDF dan maks 2MB
        ], [
            'sk_pembimbing.required' => 'File SK Pembimbing wajib diunggah.',
            'sk_pembimbing.mimes' => 'Format file harus PDF.',
            'sk_pembimbing.max' => 'Ukuran file tidak boleh melebihi 2MB.',
        ]);

        // Cek apakah ada file SK lama yang perlu dihapus
        if ($pengajuan->sk_pembimbing && Storage::disk('public')->exists($pengajuan->sk_pembimbing)) {
            Storage::disk('public')->delete($pengajuan->sk_pembimbing);
        }

        // Simpan file SK Pembimbing yang baru di direktori 'public/sk_pembimbing'
        $path = $request->file('sk_pembimbing')->store('sk_pembimbing', 'public');

        // Perbarui kolom 'sk_pembimbing' di database dengan path file
        $pengajuan->update(['sk_pembimbing' => $path]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('admin.manajemen_sk.pengajuan_sk_pembimbing.show')
                 ->with('success', 'SK Pembimbing berhasil diunggah.');

    }

        public function destroy(PengajuanSkPembimbing $pengajuan)
    {
        // Cek apakah ada file SK yang terhubung dan hapus dari storage
        if ($pengajuan->sk_pembimbing && Storage::disk('public')->exists($pengajuan->sk_pembimbing)) {
            Storage::disk('public')->delete($pengajuan->sk_pembimbing);
        }
        
        // Hapus record dari database
        $pengajuan->delete();

        // Redirect kembali ke halaman utama dengan pesan sukses
        return redirect()->route('admin.manajemen_sk.pengajuan_sk_pembimbing.show')
                         ->with('success', 'Pengajuan berhasil dihapus.');
    }
}
