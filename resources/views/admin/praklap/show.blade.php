<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan Praktik Lapang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Detail Pengajuan Praktik Lapang</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-left">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Skema Praktik Lapang</td>
                                <td class="px-4 py-3">{{ $praktikLapang->skema }}</td>
                            </tr>
                            @if($praktikLapang->skema === 'UMKM' && $praktikLapang->sipu_path)
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Bukti SIPU</td>
                                <td class="px-4 py-3">
                                    <a href="{{ Storage::url($praktikLapang->sipu_path) }}" target="_blank" class="text-blue-500 hover:underline">Lihat File</a>
                                </td>
                            </tr>
                            @endif
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Nama Instansi / UMKM</td>
                                <td class="px-4 py-3">{{ $praktikLapang->nama_instansi ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Alamat Instansi</td>
                                <td class="px-4 py-3">{{ $praktikLapang->alamat_instansi }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Dosen Pembimbing</td>
                                <td class="px-4 py-3">{{ $praktikLapang->dosen_pembimbing ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Status</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($praktikLapang->status_pl === 'Diterima') bg-green-200 text-green-800
                                        @elseif($praktikLapang->status_pl === 'Diajukan') bg-yellow-200 text-yellow-800
                                        @elseif($praktikLapang->status_pl === 'Ditolak') bg-red-200 text-red-800
                                        @else bg-gray-200 text-gray-800 @endif">
                                        {{ $praktikLapang->status_pl }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Tanggal Pelaksanaan</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($praktikLapang->tanggal_pelaksanaan)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Diajukan Pada</td>
                                <td class="px-4 py-3">{{ $praktikLapang->created_at->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                            @if($praktikLapang->campus_approval_path)
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Surat Persetujuan Kampus</td>
                                <td class="px-4 py-3">
                                    <a href="{{ Storage::url($praktikLapang->campus_approval_path) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Dokumen</a>
                                </td>
                            </tr>
                            @endif

                            @if($praktikLapang->institution_approval_path)
                            <tr class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-700">Surat Persetujuan Instansi</td>
                                <td class="px-4 py-3">
                                    <a href="{{ Storage::url($praktikLapang->institution_approval_path) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Dokumen</a>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <h4 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Anggota Kelompok</h4>
                    <table class="min-w-full table-auto text-left">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-gray-600">No.</th>
                                <th class="px-4 py-2 text-gray-600">Nama Mahasiswa</th>
                                <th class="px-4 py-2 text-gray-600">NPM</th>
                            </tr>
                        </thead>
                        <tbody>
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

                    <div class="mt-6 flex justify-center space-x-4">
                        <a href="{{ route('admin.praklap.edit', $praktikLapang->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Pengajuan
                        </a>
                        <form action="{{ route('admin.praklap.destroy', $praktikLapang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Hapus Pengajuan
                            </button>
                        </form>
                        {{-- PERBAIKAN: Mengganti rute ke admin.praklap.index --}}
                        <a href="{{ route('admin.praklap.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>