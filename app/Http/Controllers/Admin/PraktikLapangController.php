<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrakLap;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PraktikLapangController extends Controller
{
    /**
     * Menampilkan daftar semua pengajuan Praktik Lapang dengan fitur pencarian.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        // Eager load semua relasi yang diperlukan
        $query = PrakLap::with(['mahasiswa1', 'mahasiswa2', 'mahasiswa3'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_instansi', 'like', '%' . $search . '%')
                    ->orWhere('alamat_instansi', 'like', '%' . $search . '%')
                    ->orWhere('skema', 'like', '%' . $search . '%')
                    ->orWhere('dosen_pembimbing', 'like', '%' . $search . '%')
                    ->orWhereHas('mahasiswa1', function ($mahasiswaQuery) use ($search) {
                        $mahasiswaQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('npm', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('mahasiswa2', function ($mahasiswaQuery) use ($search) {
                        $mahasiswaQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('npm', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('mahasiswa3', function ($mahasiswaQuery) use ($search) {
                        $mahasiswaQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('npm', 'like', '%' . $search . '%');
                    });
            });
        }

        $praktikLapangs = $query->get();

        // PERBAIKAN: Mengarahkan ke view 'index' yang terpisah
        return view('admin.praklap.index', compact('praktikLapangs', 'search'));
    }

    /**
     * Menampilkan detail pengajuan Praktik Lapang tertentu.
     */
    public function show(string $id): View
    {
        $praktikLapang = PrakLap::with(['mahasiswa1', 'mahasiswa2', 'mahasiswa3'])->findOrFail($id);

        return view('admin.praklap.show', compact('praktikLapang'));
    }

    // Metode edit, update, dan destroy lainnya tidak perlu diubah karena sudah benar
    public function edit(string $id): View
    {
        // Mencari pengajuan berdasarkan ID dan eager loading relasinya
        $praktikLapang = PrakLap::with(['mahasiswa1', 'mahasiswa2', 'mahasiswa3'])->findOrFail($id);

        return view('admin.praklap.edit', compact('praktikLapang'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat_instansi' => 'required|string',
            'skema' => ['required', 'string', Rule::in(['Instansi', 'Sekolah', 'UMKM'])],
            'tanggal_pelaksanaan' => 'required|date',
            'dosen_pembimbing' => 'nullable|string|max:255',
            'status_pl' => ['required', 'string', Rule::in(['Diajukan', 'Diterima', 'Ditolak'])],
            'nama_mhs_1' => 'required|string|max:255',
            'npm_mhs_1' => 'required|string|size:9',
            'nama_mhs_2' => 'nullable|string|max:255',
            'npm_mhs_2' => 'nullable|string|size:9',
            'nama_mhs_3' => 'nullable|string|max:255',
            'npm_mhs_3' => 'nullable|string|size:9',
            'campus_approval_file' => 'nullable|mimes:pdf|max:2048',
            'institution_approval_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $praktikLapang = PrakLap::findOrFail($id);

        try {
            DB::beginTransaction();

            // Perbarui data pengajuan Praktik Lapang
            $praktikLapang->update([
                'nama_instansi' => $validatedData['nama_instansi'],
                'alamat_instansi' => $validatedData['alamat_instansi'],
                'skema' => $validatedData['skema'],
                'tanggal_pelaksanaan' => $validatedData['tanggal_pelaksanaan'],
                'dosen_pembimbing' => $validatedData['dosen_pembimbing'] ?? null,
                'status_pl' => $validatedData['status_pl'],
            ]);

            // Tambahan: Unggah dan simpan file persetujuan kampus
            if ($request->hasFile('campus_approval_file')) {
                // Hapus file lama jika ada
                if ($praktikLapang->campus_approval_path) {
                    Storage::disk('public')->delete($praktikLapang->campus_approval_path);
                }
                $path = $request->file('campus_approval_file')->store('documents/campus_approvals', 'public');
                $praktikLapang->campus_approval_path = $path;
            }

            // Tambahan: Unggah dan simpan file persetujuan instansi
            if ($request->hasFile('institution_approval_file')) {
                // Hapus file lama jika ada
                if ($praktikLapang->institution_approval_path) {
                    Storage::disk('public')->delete($praktikLapang->institution_approval_path);
                }
                $path = $request->file('institution_approval_file')->store('documents/institution_approvals', 'public');
                $praktikLapang->institution_approval_path = $path;
            }
            
            // Tambahan: Unggah dan simpan file SIPU (jika ada)
            if ($request->hasFile('sipu_file')) {
                if ($praktikLapang->sipu_path) {
                    Storage::disk('public')->delete($praktikLapang->sipu_path);
                }
                $path = $request->file('sipu_file')->store('documents/sipu', 'public');
                $praktikLapang->sipu_path = $path;
            }

            // Simpan perubahan path file di model
            $praktikLapang->save();

            // Perbarui data mahasiswa 1
            $mahasiswa1 = User::findOrFail($praktikLapang->user_id_mhs_1);
            $mahasiswa1->update([
                'name' => $validatedData['nama_mhs_1'],
                'npm' => $validatedData['npm_mhs_1'],
            ]);

            // Perbarui data mahasiswa 2 (jika ada)
            if ($praktikLapang->user_id_mhs_2) {
                $mahasiswa2 = User::findOrFail($praktikLapang->user_id_mhs_2);
                $mahasiswa2->update([
                    'name' => $validatedData['nama_mhs_2'],
                    'npm' => $validatedData['npm_mhs_2'],
                ]);
            }

            // Perbarui data mahasiswa 3 (jika ada)
            if ($praktikLapang->user_id_mhs_3) {
                $mahasiswa3 = User::findOrFail($praktikLapang->user_id_mhs_3);
                $mahasiswa3->update([
                    'name' => $validatedData['nama_mhs_3'],
                    'npm' => $validatedData['npm_mhs_3'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.praklap.index')
                ->with('success', 'Pengajuan Praktik Lapang berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui pengajuan. Error: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus pengajuan Praktik Lapang tertentu dari database.
     */
    public function destroy(string $id): RedirectResponse
    {
        $praktikLapang = PrakLap::findOrFail($id);

        // Hapus file SIPU terkait jika ada
        if ($praktikLapang->sipu_path && Storage::disk('public')->exists($praktikLapang->sipu_path)) {
            Storage::disk('public')->delete($praktikLapang->sipu_path);
        }

        // Hapus file persetujuan kampus jika ada
        if ($praktikLapang->campus_approval_path && Storage::disk('public')->exists($praktikLapang->campus_approval_path)) {
            Storage::disk('public')->delete($praktikLapang->campus_approval_path);
        }

        // Hapus file persetujuan instansi jika ada
        if ($praktikLapang->institution_approval_path && Storage::disk('public')->exists($praktikLapang->institution_approval_path)) {
            Storage::disk('public')->delete($praktikLapang->institution_approval_path);
        }

        $praktikLapang->delete();

        return redirect()->route('admin.praklap.index')->with('success', 'Pengajuan Praktik Lapang berhasil dihapus.');
    }
}