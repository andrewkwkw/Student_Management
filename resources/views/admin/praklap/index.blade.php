<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengajuan Praktik Lapang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menampilkan pesan sukses dari controller --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengajuan Praktik Lapang</h3>

                {{-- Form Pencarian --}}
                <div class="mb-4 flex justify-between items-center">
                    <form action="{{ route('admin.praklap.index') }}" method="GET" class="w-full mr-4">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}" class="w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>
                    {{-- Tombol Tambah bisa ditambahkan di sini jika diperlukan --}}
                </div>
                
                {{-- Tabel Daftar Pengajuan --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left border border-gray-200">ID</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Instansi</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Nama Mahasiswa</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Skema</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Status</th>
                                <th class="py-3 px-6 text-center border border-gray-200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($praktikLapangs as $praktikLapang)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap border border-gray-200">{{ $praktikLapang->id }}</td>
                                <td class="py-3 px-6 text-left border border-gray-200">{{ $praktikLapang->nama_instansi }}</td>
                                <td class="py-3 px-6 text-left border border-gray-200">
                                    {{ $praktikLapang->mahasiswa1->name }}
                                    @if ($praktikLapang->mahasiswa2)
                                        , {{ $praktikLapang->mahasiswa2->name }}
                                    @endif
                                    @if ($praktikLapang->mahasiswa3)
                                        , {{ $praktikLapang->mahasiswa3->name }}
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-left border border-gray-200">{{ $praktikLapang->skema }}</td>
                                <td class="py-3 px-6 text-left border border-gray-200">
                                    <span class="py-1 px-3 rounded-full text-xs
                                        @if ($praktikLapang->status_pl === 'Diterima') bg-green-200 text-green-600
                                        @elseif ($praktikLapang->status_pl === 'Ditolak') bg-red-200 text-red-600
                                        @else bg-yellow-200 text-yellow-600 @endif">
                                        {{ $praktikLapang->status_pl }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center border border-gray-200">
                                    <div class="flex item-center justify-center space-x-2">
                                        <a href="{{ route('admin.praklap.show', $praktikLapang->id) }}" class="transform hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-gray-500 hover:text-blue-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Tidak ada pengajuan praktik lapang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
