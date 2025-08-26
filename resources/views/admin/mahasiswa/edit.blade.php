<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan sukses atau error --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Form Edit Mahasiswa</h3>

                {{-- Form untuk mengedit data mahasiswa --}}
                <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PATCH') {{-- Menggunakan PATCH untuk update data --}}

                    {{-- Input Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $mahasiswa->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    {{-- Input Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $mahasiswa->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    
                    {{-- Input NPM --}}
                    <div class="mb-4">
                        <label for="npm" class="block text-gray-700 font-bold mb-2">NPM</label>
                        <input type="text" name="npm" id="npm" value="{{ old('npm', $mahasiswa->npm) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    {{-- Input Jumlah SKS --}}
                    <div class="mb-4">
                        <label for="jumlah_sks" class="block text-gray-700 font-bold mb-2">Jumlah SKS</label>
                        <input type="number" name="jumlah_sks" id="jumlah_sks" value="{{ old('jumlah_sks', $mahasiswa->jumlah_sks) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    {{-- Input Tahun Masuk --}}
                    <div class="mb-4">
                        <label for="tahun_masuk" class="block text-gray-700 font-bold mb-2">Tahun Masuk</label>
                        <input type="text" name="tahun_masuk" id="tahun_masuk" value="{{ old('tahun_masuk', $mahasiswa->tahun_masuk) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    {{-- Input Status Aktif --}}
                    <div class="mb-4">
                        <label for="status_aktif" class="block text-gray-700 font-bold mb-2">Status Aktif</label>
                        <select name="status_aktif" id="status_aktif" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="aktif" {{ old('status_aktif', $mahasiswa->status_aktif) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status_aktif', $mahasiswa->status_aktif) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="admin_note" class="block text-gray-700 text-sm font-bold mb-2">Catatan Admin</label>
                        <textarea name="admin_note" id="admin_note" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $mahasiswa->admin_note }}</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
