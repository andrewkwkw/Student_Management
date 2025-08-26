<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan sukses/error --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Info!</strong>
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Informasi Pengajuan Pembimbing</h3>

                {{-- 🔽 Tabel Detail --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left border border-gray-200">Mahasiswa</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Judul SK</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Bidang Minat</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Dosen 1</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Dosen 2</th>
                                <th class="py-3 px-6 text-left border border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6 border">
                                    {{ $pengajuan->user->name ?? '-' }}
                                    <div class="text-xs text-gray-500">{{ $pengajuan->user->npm ?? '' }}</div>
                                </td>
                                <td class="py-3 px-6 border">{{ $pengajuan->judul_sk }}</td>
                                <td class="py-3 px-6 border">{{ $pengajuan->bidang_minat }}</td>
                                <td class="py-3 px-6 border">{{ $pengajuan->dosen_1 ?? '-' }}</td>
                                <td class="py-3 px-6 border">{{ $pengajuan->dosen_2 ?? '-' }}</td>
                                <td class="py-3 px-6 border">
                                    <span class="px-3 py-1 rounded-full text-xs
                                        @if($pengajuan->status_pengajuan == 'Diterima') bg-green-200 text-green-700
                                        @elseif($pengajuan->status_pengajuan == 'Ditolak') bg-red-200 text-red-700
                                        @else bg-yellow-200 text-yellow-700 @endif">
                                        {{ $pengajuan->status_pengajuan }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end mt-6">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
