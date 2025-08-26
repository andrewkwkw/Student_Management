<?php

namespace App\Http\Controllers\Pendaftaran_Sk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SidangHasil;
use Illuminate\Support\Facades\Auth;

class SidangHasilController extends Controller
{
    public function create()
    {
        $sidangHasil = SidangHasil::where('user_id', Auth::id())->first();

        if ($sidangHasil) {
            return redirect()->route('mahasiswa.sidang_hasil.show', $sidangHasil->id)
                             ->with('info', 'Anda sudah mengajukan sidang hasil. Anda dapat melihat detailnya di sini.');
        }

        return view('mahasiswa.sidang_hasil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bukti_acc_1' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'bukti_acc_2' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'bukti_bimbingan_1' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'bukti_bimbingan_2' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $sidangHasil = new SidangHasil();
        $sidangHasil->user_id = Auth::id();

        if ($request->hasFile('bukti_acc_1')) {
            $path = $request->file('bukti_acc_1')->store('bukti_acc_1', 'public');
            $sidangHasil->bukti_acc_1 = $path;
        }

        if ($request->hasFile('bukti_acc_2')) {
            $path = $request->file('bukti_acc_2')->store('bukti_acc_2', 'public');
            $sidangHasil->bukti_acc_2 = $path;
        }

        if ($request->hasFile('bukti_bimbingan_1')) {
            $path = $request->file('bukti_bimbingan_1')->store('bukti_bimbingan_1', 'public');
            $sidangHasil->bukti_bimbingan_1 = $path;
        }

        if ($request->hasFile('bukti_bimbingan_2')) {
            $path = $request->file('bukti_bimbingan_2')->store('bukti_bimbingan_2', 'public');
            $sidangHasil->bukti_bimbingan_2 = $path;
        }

        $sidangHasil->nilai_sidang_hasil = $request->nilai_sidang_hasil;
        $sidangHasil->save();

        return redirect()->route('mahasiswa.sidang_hasil.show', $sidangHasil->id)
                         ->with('success', 'Data sidang hasil berhasil disimpan.');
    }

    public function show($id)
    {
        $sidangHasil = SidangHasil::find($id);
        if (!$sidangHasil) {
            return redirect()
                ->route('mahasiswa.sidang_hasil.create')
                ->with('warning', 'Data pengajuan Anda sudah dihapus admin. Silakan daftar kembali.');
        }
        if ($sidangHasil->user_id !== Auth::id()) {

            abort(403, 'Anda tidak boleh mengakses data ini');
        }

        return view('mahasiswa.sidang_hasil.show', compact('sidangHasil'));
    }
    
}
