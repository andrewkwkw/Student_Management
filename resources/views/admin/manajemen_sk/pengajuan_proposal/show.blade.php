<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pengajuan Proposal</h1>
            
            {{-- Searchbar --}}
            <div class="mb-6">
                <form action="{{ route('admin.manajemen_sk.pengajuan_proposal.show') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Cari mahasiswa atau nilai proposal..." value="{{ request('search') }}" class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </form>
            </div>
            
            {{-- Tabel Pengajuan --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-md">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">MAHASISWA</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NILAI PROPOSAL</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">BUKTI ACC 1</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">BUKTI BINGBINGAN 1</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($proposals as $proposal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $proposal->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $proposal->user->nim }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $proposal->nilai_proposal ?? 'Belum ada nilai' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($proposal->bukti_acc_1)
                                        <a href="{{ asset('storage/' . $proposal->bukti_acc_1) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Berkas</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($proposal->bukti_bimbingan_1)
                                        <a href="{{ asset('storage/' . $proposal->bukti_bimbingan_1) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Berkas</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.manajemen_sk.pengajuan_proposal.edit', $proposal->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengajuan proposal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
