<?php

namespace App\Http\Controllers\Admin\Manajemen_Sk;

use App\Http\Controllers\Controller;
use App\Models\SidangHasil;
use Illuminate\Http\Request;

class SidangHasilController extends Controller
{
    /**
     * Menampilkan daftar pengajuan sidang hasil.
     */
    public function show(Request $request)
    {
        $query = SidangHasil::with('user')->latest();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            })
            ->orWhere('nilai_sidang_hasil', 'like', "%{$search}%");
        }

        // Mengubah nama variabel dari $sidangHasil menjadi $sidangHasils (plural)
        $sidangHasils = $query->get();

        return view('admin.manajemen_sk.sidang_hasil.show', compact('sidangHasils'));
    }

    /**
     * Menampilkan form untuk mengedit nilai sidang hasil.
     */
    public function edit($id)
    {
        $sidangHasil = SidangHasil::findOrFail($id);
        
        return view('admin.manajemen_sk.sidang_hasil.edit', compact('sidangHasil'));
    }

    /**
     * Memperbarui nilai sidang hasil.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_sidang_hasil' => 'nullable|string|max:255',
        ]);
        
        $sidangHasil = SidangHasil::findOrFail($id);

        $sidangHasil->nilai_sidang_hasil = $request->input('nilai_sidang_hasil');
        $sidangHasil->save();

        // Menggunakan rute yang konsisten: admin.manajemen_sk.sidang_hasil.show
        return redirect()->route('admin.manajemen_sk.sidang_hasil.show')
                         ->with('success', 'Nilai sidang hasil berhasil diperbarui.');
    }

    /**
     * Menghapus data sidang hasil.
     */
    public function destroy($id)
    {
        $sidangHasil = SidangHasil::findOrFail($id);

        $sidangHasil->delete();

        // Menggunakan rute yang konsisten: admin.manajemen_sk.sidang_hasil.show
        return redirect()->route('admin.manajemen_sk.sidang_hasil.show')
                         ->with('success', 'Data sidang hasil berhasil dihapus.');
    }
}
