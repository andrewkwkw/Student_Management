<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan Sidang Hasil') }}
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
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengajuan Sidang Hasil</h3>

                {{-- 🔍 Form Pencarian --}}
                <div class="mb-4 flex justify-between items-center">
                    <form action="{{ route('admin.manajemen_sk.sidang_hasil.show') }}" method="GET" class="w-full md:w-1/2">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari mahasiswa atau nilai..."
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
                                <th class="py-3 px-6 border">Nilai Sidang Hasil</th>
                                <th class="py-3 px-6 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($sidangHasils as $sidangHasil)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-6 border">
                                        {{ $sidangHasil->user->name ?? '-' }}
                                        <div class="text-xs text-gray-500">{{ $sidangHasil->user->npm ?? '' }}</div>
                                    </td>
                                    <td class="py-3 px-6 border">
                                        {{ $sidangHasil->nilai_sidang_hasil ?? 'Belum Ada Nilai' }}
                                    </td>
                                    <td class="py-3 px-6 border text-center">
                                        <a href="{{ route('admin.manajemen_sk.sidang_hasil.edit', $sidangHasil->id) }}" 
                                           class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.manajemen_sk.sidang_hasil.destroy', $sidangHasil->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm ml-2">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada pengajuan sidang hasil.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
