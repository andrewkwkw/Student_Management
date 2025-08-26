<?php

namespace App\Http\Controllers\Pendaftaran_Sk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PengajuanSkPembimbing;

class PengajuanSkPembimbingController extends Controller
{
    /**
     * Menampilkan formulir pengajuan SK Pembimbing.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mendapatkan pengajuan SK Pembimbing yang sudah ada untuk pengguna saat ini.
        $pengajuan = PengajuanSkPembimbing::where('user_id', Auth::id())->first();

        // Jika pengajuan sudah ada, redirect ke halaman detail.
        if ($pengajuan) {
            return redirect()
                ->route('mahasiswa.pengajuan_sk_pembimbing.show', $pengajuan->id)
                ->with('info', 'Anda sudah mengajukan SK Pembimbing. Jika ada kekeliruan, silakan hubungi admin.');
        }

        return view('mahasiswa.pengajuan_sk_pembimbing.create');
    }

    /**
     * Menyimpan pengajuan SK Pembimbing dan mengunggah file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input, memastikan file yang diunggah adalah gambar dan tidak lebih dari 2MB.
        $request->validate([
            'bukti_acc_1'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_acc_2'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_bimbingan_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_bimbingan_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Siapkan array untuk data yang akan disimpan.
        $data = [
            'user_id' => Auth::id(),
        ];

        // Looping untuk setiap file yang diunggah.
        $fileFields = ['bukti_acc_1', 'bukti_acc_2', 'bukti_bimbingan_1', 'bukti_bimbingan_2'];
        foreach ($fileFields as $field) {
            // Periksa apakah ada file yang diunggah untuk field ini.
            if ($request->hasFile($field)) {
                // Simpan file dan dapatkan path-nya.
                $path = $request->file($field)->store('bukti_sk', 'public');
                $data[$field] = $path;
            }
        }

        // Buat entri baru di database.
        $pengajuan = PengajuanSkPembimbing::create($data);

        return redirect()->route('mahasiswa.pengajuan_sk_pembimbing.show', $pengajuan->id)
                             ->with('success', 'Pengajuan SK Pembimbing berhasil diajukan!');
    }

    /**
     * Menampilkan detail pengajuan SK Pembimbing.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // Cari pengajuan berdasarkan ID.
        $pengajuan = PengajuanSkPembimbing::find($id);

        // Jika tidak ditemukan, redirect ke halaman buat.
        if (!$pengajuan) {
            return redirect()
                ->route('mahasiswa.pengajuan_sk_pembimbing.create')
                ->with('warning', 'Data pengajuan SK Pembimbing Anda sudah dihapus admin. Silakan daftar kembali.');
        }

        // Pastikan pengguna hanya bisa melihat data miliknya sendiri.
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak boleh mengakses data ini');
        }

        return view('mahasiswa.pengajuan_sk_pembimbing.show', compact('pengajuan'));
    }
}
