<?php

namespace App\Http\Controllers\Pendaftaran_Sk;

use App\Http\Controllers\Controller;
use App\Models\PengajuanProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanProposalController extends Controller
{
    /**
     * Tampilkan form pengajuan proposal (mahasiswa)
     */
    public function create()
    {
        // Cari apakah mahasiswa sudah punya proposal
        $proposal = PengajuanProposal::where('user_id', Auth::id())->first();

        // Jika sudah ada, redirect ke halaman show dengan ID proposal
        if ($proposal) {
            return redirect()->route('mahasiswa.pengajuan_proposal.show', $proposal->id)
                             ->with('info', 'Anda sudah mengajukan proposal. Anda dapat melihat detailnya di sini.');
        }

        // Jika belum, tampilkan form
        return view('mahasiswa.pengajuan_proposal.create');
    }

    /**
     * Simpan data pengajuan proposal dari mahasiswa
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk. Semua file sekarang 'required'.
        $request->validate([
            'bukti_acc_1' => 'required|file|mimes:pdf,png,jpg,doc,docx|max:2048',
            'bukti_acc_2' => 'required|file|mimes:pdf,png,jpg,doc,docx|max:2048',
            'bukti_bimbingan_1' => 'required|file|mimes:pdf,png,jpg,doc,docx|max:2048',
            'bukti_bimbingan_2' => 'required|file|mimes:pdf,png,jpg,doc,docx|max:2048',
        ]);

        // Siapkan array data
        $data = [
            'user_id' => Auth::id(),
        ];

        // Simpan setiap file ke direktori yang berbeda untuk menghindari konflik
        foreach (['bukti_acc_1', 'bukti_acc_2', 'bukti_bimbingan_1', 'bukti_bimbingan_2'] as $field) {
            if ($request->hasFile($field)) {
                // Simpan file ke folder sesuai nama field
                $data[$field] = $request->file($field)->store($field, 'public');
            }
        }

        // Buat entri baru di database
        $proposal = PengajuanProposal::create($data);

        return redirect()->route('mahasiswa.pengajuan_proposal.show', $proposal->id)
                         ->with('success', 'Pengajuan proposal berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail pengajuan proposal milik mahasiswa
     */
    public function show($id)
    {
        // Cari data berdasarkan id, atau tampilkan 404 jika tidak ditemukan
        $proposal = PengajuanProposal::find($id);

        // Kalau data tidak ada (sudah dihapus admin)
        if (!$proposal) {
            return redirect()
                ->route('mahasiswa.pengajuan_proposal.create')
                ->with('warning', 'Data pengajuan Anda sudah dihapus admin. Silakan daftar kembali.');
        }

        // Pastikan mahasiswa hanya bisa lihat datanya sendiri
        if ($proposal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak boleh mengakses data ini');
        }

        return view('mahasiswa.pengajuan_proposal.show', compact('proposal'));
    }
}
