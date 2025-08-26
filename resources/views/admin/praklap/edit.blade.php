<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengajuan Praktik Lapang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Ada kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Form Edit Pengajuan</h3>

                {{-- FORM PERBAIKAN: Mengubah method dari PUT menjadi PATCH --}}
                <form action="{{ route('admin.praklap.update', $praktikLapang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Informasi Instansi --}}
                    <div class="space-y-4 mb-6">
                        <div>
                            <label for="nama_instansi" class="block text-sm font-medium text-gray-700">Nama Instansi</label>
                            <input type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi', $praktikLapang->nama_instansi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="alamat_instansi" class="block text-sm font-medium text-gray-700">Alamat Instansi</label>
                            <textarea id="alamat_instansi" name="alamat_instansi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat_instansi', $praktikLapang->alamat_instansi) }}</textarea>
                        </div>
                        <div>
                            <label for="skema" class="block text-sm font-medium text-gray-700">Skema</label>
                            <select id="skema" name="skema" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Sekolah" {{ $praktikLapang->skema == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                <option value="UMKM" {{ $praktikLapang->skema == 'UMKM' ? 'selected' : '' }}>UMKM</option>
                                <option value="Instansi" {{ $praktikLapang->skema == 'Instansi' ? 'selected' : '' }}>Instansi</option>
                            </select>
                        </div>
                        <div>
                            <label for="tanggal_pelaksanaan" class="block text-sm font-medium text-gray-700">Tanggal Pelaksanaan</label>
                            <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', \Carbon\Carbon::parse($praktikLapang->tanggal_pelaksanaan)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        @if($praktikLapang->skema === 'UMKM' && $praktikLapang->sipu_path)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">File SIPU</label>
                            <div class="mt-1 block w-full text-sm text-blue-600 hover:text-blue-800">
                                <a href="{{ Storage::url($praktikLapang->sipu_path) }}" target="_blank">Lihat File Bukti SIPU</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Detail Mahasiswa --}}
                    <h4 class="text-xl font-semibold text-gray-800 mb-4 mt-6 border-t pt-6">Detail Mahasiswa</h4>
                    
                    {{-- Mahasiswa 1 --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="nama_mhs_1" class="block text-sm font-medium text-gray-700">Nama Mahasiswa 1</label>
                            <input type="text" id="nama_mhs_1" name="nama_mhs_1" value="{{ old('nama_mhs_1', $praktikLapang->mahasiswa1->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="npm_mhs_1" class="block text-sm font-medium text-gray-700">NPM Mahasiswa 1</label>
                            <input type="text" id="npm_mhs_1" name="npm_mhs_1" value="{{ old('npm_mhs_1', $praktikLapang->mahasiswa1->npm) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    {{-- Mahasiswa 2 (jika ada) --}}
                    @if($praktikLapang->mahasiswa2)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="nama_mhs_2" class="block text-sm font-medium text-gray-700">Nama Mahasiswa 2</label>
                            <input type="text" id="nama_mhs_2" name="nama_mhs_2" value="{{ old('nama_mhs_2', $praktikLapang->mahasiswa2->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="npm_mhs_2" class="block text-sm font-medium text-gray-700">NPM Mahasiswa 2</label>
                            <input type="text" id="npm_mhs_2" name="npm_mhs_2" value="{{ old('npm_mhs_2', $praktikLapang->mahasiswa2->npm) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    @endif

                    {{-- Mahasiswa 3 (jika ada) --}}
                    @if($praktikLapang->mahasiswa3)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="nama_mhs_3" class="block text-sm font-medium text-gray-700">Nama Mahasiswa 3</label>
                            <input type="text" id="nama_mhs_3" name="nama_mhs_3" value="{{ old('nama_mhs_3', $praktikLapang->mahasiswa3->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="npm_mhs_3" class="block text-sm font-medium text-gray-700">NPM Mahasiswa 3</label>
                            <input type="text" id="npm_mhs_3" name="npm_mhs_3" value="{{ old('npm_mhs_3', $praktikLapang->mahasiswa3->npm) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    @endif

                    {{-- Dosen Pembimbing dan Status --}}
                    <div class="mt-8 pt-8 border-t">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Penugasan & Status</h4>
                        <div class="mb-6">
                            <label for="dosen_pembimbing" class="block text-sm font-medium text-gray-700">Dosen Pembimbing:</label>
                            <input type="text" id="dosen_pembimbing" name="dosen_pembimbing" value="{{ old('dosen_pembimbing', $praktikLapang->dosen_pembimbing) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-6">
                            <label for="status_pl" class="block text-sm font-medium text-gray-700">Status Pengajuan:</label>
                            <select id="status_pl" name="status_pl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Diajukan" {{ $praktikLapang->status_pl == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                <option value="Diterima" {{ $praktikLapang->status_pl == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ $praktikLapang->status_pl == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        {{-- Tambahan: Blok untuk unggah file persetujuan kampus --}}
                        <div class="mt-6 mb-4">
                            <label for="campus_approval_file" class="block text-sm font-medium text-gray-700">Surat Persetujuan Kampus (PDF)</label>
                            @if($praktikLapang->campus_approval_path)
                                <div class="mt-1">
                                    <a href="{{ Storage::url($praktikLapang->campus_approval_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">
                                        Lihat Dokumen Saat Ini
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="campus_approval_file" id="campus_approval_file" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            @error('campus_approval_file')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md">
                                Perbarui
                            </button>
                        </div>
                    </div>
                </form>

                <hr class="my-6">
                
                <h4 class="text-lg font-semibold text-red-800 mb-4">Hapus Pengajuan</h4>
                <form action="{{ route('admin.praklap.destroy', $praktikLapang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                    @csrf
                    @method('DELETE')
                    <div class="text-right">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md">
                            Hapus Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
