<?php

namespace App\Http\Controllers\Praktik_lapang;

use App\Http\Controllers\Controller;
use App\Models\PrakLap;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\User;

class PraktikLapangController extends Controller
{
    /**
     * Tampilkan form pendaftaran atau detail pengajuan jika sudah ada.
     */
    public function create(): View|RedirectResponse
    {
        $user = Auth::user();

        // Validasi pendaftar utama
        if ($user->jumlah_sks < 128 || $user->status_aktif != 'aktif') {
            return view('mahasiswa.praklap.create')->with('error', 'Anda tidak memenuhi syarat untuk mendaftar Praktik Lapang. SKS Anda kurang dari 128 atau status kuliah tidak aktif.');
        }

        // Cek apakah user sudah punya pengajuan
        $praktikLapang = $this->getPengajuanMahasiswa();

        if ($praktikLapang) {
            return redirect()->route('mahasiswa.praklap.show');
        }

        return view('mahasiswa.praklap.create');
    }

    /**
     * Simpan data pendaftaran Praktik Lapang.
     */
    public function store(Request $request): RedirectResponse
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // **PERTAHANAN KEDUA**: Lakukan pengecekan duplikasi lagi di sini sebelum membuat entri baru.
        $existingPrakLap = $this->getPengajuanMahasiswa();

        if ($existingPrakLap) {
            return redirect()->route('mahasiswa.praklap.show')->with('error', 'Anda sudah terdaftar dalam pengajuan Praktik Lapang.')->withInput();
        }

        // Validasi input form dasar dan cek duplikasi di dalam form
        $validated = $request->validate([
            'skema'               => ['required', 'string', Rule::in(['Instansi', 'Sekolah', 'UMKM'])],
            'sipu_file'           => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:10240'],
            'nama_instansi'       => ['required', 'string', 'max:255'],
            'alamat_instansi'     => ['required', 'string', 'max:255'],
            'tanggal_pelaksanaan' => ['required', 'date'],

            'npm_mhs_2'           => [
                'nullable',
                'digits:9',
                'exists:users,npm',
                'different:npm_mhs_3',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value && $value == $user->npm) {
                        $fail('NPM anggota kedua tidak boleh sama dengan NPM Anda.');
                    }
                },
            ],
            'npm_mhs_3'           => [
                'nullable',
                'digits:9',
                'exists:users,npm',
                'different:npm_mhs_2',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value && $value == $user->npm) {
                        $fail('NPM anggota ketiga tidak boleh sama dengan NPM Anda.');
                    }
                },
            ],
        ]);

        // Ambil data user untuk semua anggota (termasuk yang kosong)
        $userMhs1 = $user;
        $userMhs2 = $request->filled('npm_mhs_2') ? User::where('npm', $validated['npm_mhs_2'])->first() : null;
        $userMhs3 = $request->filled('npm_mhs_3') ? User::where('npm', $validated['npm_mhs_3'])->first() : null;

        // Kumpulkan semua user yang terisi ke dalam array
        $members = array_filter([$userMhs1, $userMhs2, $userMhs3]);

        // Loop untuk memeriksa validasi SKS dan status kuliah untuk setiap anggota
        foreach ($members as $member) {
            // Perbaikan: Menggunakan 'jumlah_sks' dan 'status_aktif' (huruf kecil)
            if ($member->jumlah_sks < 128 || $member->status_aktif != 'aktif') {
                return back()->withInput()->with('error', 'Anggota dengan NPM ' . $member->npm . ' tidak memenuhi syarat (SKS < 128 atau status tidak aktif).');
            }
        }

        // Handle file upload
        $sipuPath = null;
        if ($request->hasFile('sipu_file')) {
            $sipuPath = $request->file('sipu_file')->store('sipu_files', 'public');
        }

        // Buat entri baru di database
        PrakLap::create([
            'user_id_mhs_1'       => $userMhs1->id,
            'skema'               => $validated['skema'],
            'sipu_path'           => $sipuPath,
            'nama_instansi'       => $validated['nama_instansi'],
            'alamat_instansi'     => $validated['alamat_instansi'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'status_pl'           => 'Diajukan',
            'user_id_mhs_2'       => $userMhs2 ? $userMhs2->id : null,
            'user_id_mhs_3'       => $userMhs3 ? $userMhs3->id : null,
        ]);

        return redirect()->route('mahasiswa.praklap.show')->with('success', 'Pengajuan Praktik Lapang berhasil dikirim!');
    }

    /**
     * Menampilkan detail pendaftaran Praktik Lapang.
     */
    public function show(): View|RedirectResponse
    {
        $praktikLapang = $this->getPengajuanMahasiswa();

        if (!$praktikLapang) {
            return redirect()->route('mahasiswa.praklap.create')->with('info', 'Anda belum mengajukan Praktik Lapang. Silakan isi formulir.');
        }

        return view('mahasiswa.praklap.show', compact('praktikLapang'));
    }

    /**
     * Handle the upload of the institution approval file.
     * This method is newly added to fix the error.
     */
    public function uploadInstitutionApproval(Request $request): RedirectResponse
    {
        // Temukan pengajuan praktik lapang user yang sedang login
        $praktikLapang = $this->getPengajuanMahasiswa();

        // Pastikan ada pengajuan sebelum mengunggah file
        if (!$praktikLapang) {
            return redirect()->route('mahasiswa.praklap.show')->with('error', 'Anda belum memiliki pengajuan Praktik Lapang.');
        }

        // Validasi file yang diunggah
        $request->validate([
            'institution_approval_file' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:10240'],
        ]);

        // Hapus file lama jika ada untuk menghindari duplikasi
        if ($praktikLapang->institution_approval_path) {
            Storage::disk('public')->delete($praktikLapang->institution_approval_path);
        }

        // Simpan file baru dan dapatkan path-nya
        $filePath = $request->file('institution_approval_file')->store('institution_approvals', 'public');

        // Perbarui record di database
        $praktikLapang->update([
            'institution_approval_path' => $filePath,
        ]);

        return redirect()->route('mahasiswa.praklap.show')->with('success', 'Surat persetujuan instansi berhasil diunggah.');
    }

    /**
     * Metode helper untuk menghindari pengulangan kode query.
     */
    private function getPengajuanMahasiswa()
    {
        return PrakLap::where(function ($query) {
            $query->where('user_id_mhs_1', Auth::id())
                ->orWhere('user_id_mhs_2', Auth::id())
                ->orWhere('user_id_mhs_3', Auth::id());
        })
            ->with(['mahasiswa1', 'mahasiswa2', 'mahasiswa3'])
            ->first();
    }
}
