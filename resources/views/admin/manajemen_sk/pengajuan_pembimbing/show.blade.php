<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengajuan Pembimbing</h3>

            {{-- 🔍 Form Pencarian --}}
            <div class="mb-4 flex justify-between items-center">
                <form action="{{ route('admin.manajemen_sk.pengajuan_pembimbing.show') }}" method="GET" class="w-full md:w-1/2">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari mahasiswa atau judul SK..."
                               value="{{ request('search') }}"
                               class="w-full pr-10 rounded-md border-gray-300 shadow-sm 
                                      focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 border">Mahasiswa</th>
                                <th class="py-3 px-6 border">Judul SK</th>
                                <th class="py-3 px-6 border">Bidang Minat</th>
                                <th class="py-3 px-6 border">Dosen 1</th>
                                <th class="py-3 px-6 border">Dosen 2</th>
                                <th class="py-3 px-6 border">Status</th>
                                <th class="py-3 px-6 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($pengajuans as $pengajuan)
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
                                            @if ($pengajuan->status_pengajuan === 'Diterima') bg-green-200 text-green-700
                                            @elseif ($pengajuan->status_pengajuan === 'Ditolak') bg-red-200 text-red-700
                                            @else bg-yellow-200 text-yellow-700 @endif">
                                            {{ $pengajuan->status_pengajuan }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 border text-center">
                                        <a href="{{ route('admin.manajemen_sk.pengajuan_pembimbing.edit', $pengajuan->id) }}" 
                                           class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">
                                           Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada pengajuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
