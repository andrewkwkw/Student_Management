<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan SK Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Pesan sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <strong>Sukses!</strong> {{ session('success') }}
                </div>
            @endif

            {{-- ✅ Card Container --}}
            <div class="bg-white p-8 rounded-xl shadow-md border">

                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengajuan SK Pembimbing</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 border">Nama Mahasiswa</th>
                                <th class="py-3 px-6 border">ACC 1</th>
                                <th class="py-3 px-6 border">ACC 2</th>
                                <th class="py-3 px-6 border">Bimbingan 1</th>
                                <th class="py-3 px-6 border">Bimbingan 2</th>
                                <th class="py-3 px-6 border">SK Pembimbing</th>
                                <th class="py-3 px-6 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($pengajuans as $pengajuan)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-6 border font-medium text-gray-900">
                                        {{ $pengajuan->user->name ?? '-' }}
                                    </td>

                                    {{-- ACC 1 --}}
                                    <td class="py-3 px-6 border">
                                        @if ($pengajuan->bukti_acc_1)
                                            <a href="{{ Storage::url($pengajuan->bukti_acc_1) }}" target="_blank" 
                                               class="text-green-600 hover:underline">Lihat</a>
                                        @else
                                            <span class="text-red-500">Belum</span>
                                        @endif
                                    </td>

                                    {{-- ACC 2 --}}
                                    <td class="py-3 px-6 border">
                                        @if ($pengajuan->bukti_acc_2)
                                            <a href="{{ Storage::url($pengajuan->bukti_acc_2) }}" target="_blank" 
                                               class="text-green-600 hover:underline">Lihat</a>
                                        @else
                                            <span class="text-red-500">Belum</span>
                                        @endif
                                    </td>

                                    {{-- Bimbingan 1 --}}
                                    <td class="py-3 px-6 border">
                                        @if ($pengajuan->bukti_bimbingan_1)
                                            <a href="{{ Storage::url($pengajuan->bukti_bimbingan_1) }}" target="_blank" 
                                               class="text-green-600 hover:underline">Lihat</a>
                                        @else
                                            <span class="text-red-500">Belum</span>
                                        @endif
                                    </td>

                                    {{-- Bimbingan 2 --}}
                                    <td class="py-3 px-6 border">
                                        @if ($pengajuan->bukti_bimbingan_2)
                                            <a href="{{ Storage::url($pengajuan->bukti_bimbingan_2) }}" target="_blank" 
                                               class="text-green-600 hover:underline">Lihat</a>
                                        @else
                                            <span class="text-red-500">Belum</span>
                                        @endif
                                    </td>

                                    {{-- SK Pembimbing --}}
                                    <td class="py-3 px-6 border">
                                        @if ($pengajuan->sk_pembimbing)
                                            <a href="{{ Storage::url($pengajuan->sk_pembimbing) }}" target="_blank" 
                                               class="text-blue-600 hover:underline">Unduh</a>
                                        @else
                                            <span class="text-yellow-600">Menunggu</span>
                                        @endif
                                    </td>
                                    {{-- Aksi --}}
                                    <td class="py-3 px-6 border text-center">
                                        @if ($pengajuan->sk_pembimbing)
                                            {{-- Jika SK sudah ada --}}
                                            <a href="{{ route('admin.manajemen_sk.pengajuan_sk_pembimbing.edit', $pengajuan->id) }}" 
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">
                                                Edit SK
                                            </a>
                                        @else
                                            {{-- Jika SK belum ada --}}
                                            <a href="{{ route('admin.manajemen_sk.pengajuan_sk_pembimbing.edit', $pengajuan->id) }}" 
                                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">
                                                Unggah SK
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data pengajuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
