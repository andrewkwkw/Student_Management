<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pendaftaran Praktik Lapang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan sukses atau info --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif
            @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Info!</strong>
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
            @endif
            {{-- Tambahan: Pesan Error Validasi --}}
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Informasi Pengajuan Praktik Lapang Anda</h3>

                @if($praktikLapang)
                {{-- Bagian detail pengajuan dengan cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    {{-- Card Nama Instansi --}}
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-500">Nama Instansi</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $praktikLapang->nama_instansi }}</p>
                    </div>

                    {{-- Card Alamat Instansi --}}
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-500">Alamat Instansi</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $praktikLapang->alamat_instansi }}</p>
                    </div>

                    {{-- Card Skema --}}
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-500">Skema</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $praktikLapang->skema }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm font-medium text-gray-500">Tanggal Pelaksanaan</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $praktikLapang->status_pelaksanaan === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $praktikLapang->status_pelaksanaan }}
                            </span>
                        </div>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($praktikLapang->tanggal_pelaksanaan)->format('d F Y') }}</p>
                    </div>

                    {{-- Card Status --}}
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full 
                                    @if($praktikLapang->status_pl === 'Diajukan') bg-yellow-100 text-yellow-800
                                    @elseif($praktikLapang->status_pl === 'Diterima') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                {{ $praktikLapang->status_pl }}
                            </span>
                        </p>
                    </div>

                    {{-- Card Dosen Pembimbing --}}
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-500">Dosen Pembimbing</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $praktikLapang->dosen_pembimbing ?? 'Belum ditugaskan' }}</p>
                    </div>

                    @if($praktikLapang->sipu_path)
                    {{-- Card SIPU --}}
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-500">Surat Izin Praktik UMKM (SIPU)</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            <a href="{{ Storage::url($praktikLapang->sipu_path) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Dokumen</a>
                        </p>
                    </div>
                    @endif
                </div>

                <h4 class="text-xl font-semibold text-gray-800 mb-4 border-t pt-4 mt-4">Anggota Kelompok</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow">
                        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-4 text-left">No</th>
                                <th class="py-3 px-4 text-left">Nama</th>
                                <th class="py-3 px-4 text-left">NPM</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b">
                                <td class="px-4 py-3">1</td>
                                <td class="px-4 py-3">{{ $praktikLapang->mahasiswa1->name }}</td>
                                <td class="px-4 py-3">{{ $praktikLapang->mahasiswa1->npm }}</td>
                            </tr>
                            @if($praktikLapang->mahasiswa2)
                            <tr class="border-b">
                                <td class="px-4 py-3">2</td>
                                <td class="px-4 py-3">{{ $praktikLapang->mahasiswa2->name }}</td>
                                <td class="px-4 py-3">{{ $praktikLapang->mahasiswa2->npm }}</td>
                            </tr>
                            @endif
                            @if($praktikLapang->mahasiswa3)
                            <tr class="border-b">
                                <td class="px-4 py-3">3</td>
                                <td class="px-4 py-3">{{ $praktikLapang->mahasiswa3->name }}</td>
                                <td class="px-4 py-3">{{ $praktikLapang->mahasiswa3->npm }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Kontrol Unggah dan Unduh Dokumen --}}
                <div class="mt-6 flex justify-between items-center">
                    {{-- Tombol Unduh Absensi (terpisah) --}}
                    <div>
                        <a href="{{ asset('assets/img/absenpl/DAFTAR_KEHADIRAN_PL.pdf') }}" target="_blank" rel="noopener"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Download Absensi
                        </a>
                    </div>

                    {{-- Kelompok tombol dokumen --}}
                    <div class="flex space-x-4">
                        {{-- Tombol Unduh Surat Kampus --}}
                        @if($praktikLapang->campus_approval_path)
                        <a href="{{ Storage::url($praktikLapang->campus_approval_path) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Download Surat Kampus
                        </a>
                        @endif

                        {{-- Tombol Unggah atau Unduh Surat Instansi --}}
                        @if($praktikLapang->institution_approval_path)
                        {{-- Jika file sudah ada, tampilkan tombol unduh --}}
                        <a href="{{ Storage::url($praktikLapang->institution_approval_path) }}" target="_blank" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Download Surat Instansi
                        </a>
                        @else
                        {{-- Jika file belum ada, tampilkan tombol untuk membuka form unggah --}}
                        <button type="button" onclick="document.getElementById('uploadForm').classList.toggle('hidden')" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Unggah Surat Instansi
                        </button>
                        @endif
                    </div>
                </div>

                {{-- Form Unggah Surat Persetujuan Instansi --}}
                {{-- Form ini hanya akan terlihat saat tombol "Unggah Surat Instansi" diklik --}}
                @if(!$praktikLapang->institution_approval_path)
                <div id="uploadForm" class="hidden mt-4 p-4 border rounded-md shadow-sm">
                    <h4 class="text-lg font-semibold mb-2">Unggah Surat Persetujuan dari Instansi</h4>
                    <form action="{{ route('mahasiswa.praklap.upload-institution-approval') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <input type="file" name="institution_approval_file" required class="flex-grow">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Unggah
                            </button>
                        </div>
                    </form>
                </div>
                @endif
                @else
                <p class="text-gray-600">Anda belum mengajukan pendaftaran Praktik Lapang. Silakan <a href="{{ route('mahasiswa.praklap.create') }}" class="text-blue-500 hover:underline">ajukan sekarang</a>.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>