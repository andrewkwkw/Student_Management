<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                {{-- FORM SEARCH BAR --}}
                <div class="mb-6">
                    <form action="{{ route('admin.dashboard') }}" method="GET">
                        <div class="flex items-center">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-input w-full rounded-md shadow-sm border-gray-300" 
                                placeholder="Cari nama, email, atau NPM..."
                                value="{{ request('search') }}"
                            >
                            <button type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>

                {{-- TABEL DATA MAHASISWA --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200 text-left">
                                <th class="border px-4 py-2 font-semibold text-gray-600">Nama</th>
                                <th class="border px-4 py-2 font-semibold text-gray-600">Email</th>
                                <th class="border px-4 py-2 font-semibold text-gray-600">NPM</th>
                                <th class="border px-4 py-2 font-semibold text-gray-600">Status</th>
                                <th class="border px-4 py-2 font-semibold text-gray-600">Jumlah SKS</th>
                                <th class="border px-4 py-2 font-semibold text-gray-600">Tahun Masuk</th>
                                <th class="border px-4 py-2 font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $mhs)
                            <tr class="border-b">
                                <td class="border px-4 py-2">{{ $mhs->name }}</td>
                                <td class="border px-4 py-2">{{ $mhs->email }}</td>
                                <td class="border px-4 py-2">{{ $mhs->npm }}</td>
                                <td class="border px-4 py-2">
                                    @if($mhs->status_aktif === 'aktif')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $mhs->jumlah_sks ?? '-'}}</td>
                                <td class="border px-4 py-2">{{ $mhs->tahun_masuk ?? '-'}}</td>
                                <td class="border px-4 py-2 whitespace-nowrap">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data mahasiswa ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>