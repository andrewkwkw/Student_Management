<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dari request
        $search = $request->input('search');

        // Mulai query dengan kondisi dasar (role 'mahasiswa')
        $query = User::where('role', 'mahasiswa');

        // Jika ada input pencarian, tambahkan kondisi WHERE
        if ($search) {
            $query->where(function ($q) use ($search) {
                // Mencari di kolom 'name', 'email', atau 'npm'
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        // Ambil data mahasiswa sesuai query yang sudah dibuat
        $mahasiswa = $query->get();

        // Kirim data ke view
        return view('admin.dashboard', compact('mahasiswa'));
    }

    public function edit($id)
    {
        // Temukan user berdasarkan ID
        $mahasiswa = User::findOrFail($id);
        
        // Pastikan user yang diedit adalah mahasiswa
        if ($mahasiswa->role !== 'mahasiswa') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'npm' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users')->ignore($id),
            ],
            'jumlah_sks' => 'required|integer|min:0',
            'tahun_masuk' => 'nullable|string|max:20',
            'status_aktif' => 'required|in:aktif,tidak aktif',
            'admin_note' => 'nullable|string',
        ]);

        $mhs = User::findOrFail($id);
        $mhs->update([
            'name' => $request->name,
            'email' => $request->email,
            'npm' => $request->npm,
            'jumlah_sks' => $request->jumlah_sks,
            'tahun_masuk' => $request->tahun_masuk,
            'status_aktif' => $request->status_aktif,
            'admin_note' => $request->admin_note,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mhs = User::findOrFail($id);
        $mhs->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
