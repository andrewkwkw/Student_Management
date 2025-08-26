<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengajuan Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Ada kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Form Edit Pengajuan</h3>

                {{-- FORM UPDATE --}}
                <form method="POST" action="{{ route('admin.manajemen_sk.pengajuan_pembimbing.update', $pengajuan->id) }}">
                    @csrf
                    @method('PUT')
                    
                    {{-- Detail Pengajuan --}}
                    <div class="space-y-4 mb-6">
                        <div>
                            <label for="judul_sk" class="block text-sm font-medium text-gray-700">Judul SK</label>
                            <input type="text" id="judul_sk" name="judul_sk" value="{{ old('judul_sk', $pengajuan->judul_sk) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="bidang_minat" class="block text-sm font-medium text-gray-700">Bidang Minat</label>
                            <select id="bidang_minat" name="bidang_minat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Pilih Bidang Minat</option>
                                <option value="RPL" @selected(old('bidang_minat', $pengajuan->bidang_minat) == 'RPL')>RPL</option>
                                <option value="Kecerdasan Buatan" @selected(old('bidang_minat', $pengajuan->bidang_minat) == 'Kecerdasan Buatan')>Kecerdasan Buatan</option>
                                <option value="Jaringan" @selected(old('bidang_minat', $pengajuan->bidang_minat) == 'Jaringan')>Jaringan</option>
                                <option value="Hardware" @selected(old('bidang_minat', $pengajuan->bidang_minat) == 'Hardware')>Hardware</option>
                            </select>
                            <x-input-error :messages="$errors->get('bidang_minat')" class="mt-2" />
                        </div>
                        <div>
                            <label for="dosen_1" class="block text-sm font-medium text-gray-700">Dosen Pembimbing 1</label>
                            <input type="text" id="dosen_1" name="dosen_1" value="{{ old('dosen_1', $pengajuan->dosen_1) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="dosen_2" class="block text-sm font-medium text-gray-700">Dosen Pembimbing 2</label>
                            <input type="text" id="dosen_2" name="dosen_2" value="{{ old('dosen_2', $pengajuan->dosen_2) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="mt-8 pt-8 border-t">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Penugasan & Status</h4>
                        <div class="mb-6">
                            <label for="status_pengajuan" class="block text-sm font-medium text-gray-700">Status Pengajuan:</label>
                            <select id="status_pengajuan" name="status_pengajuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Diajukan" @selected(old('status_pengajuan', $pengajuan->status_pengajuan) == 'Diajukan')>Diajukan</option>
                                <option value="Diterima" @selected(old('status_pengajuan', $pengajuan->status_pengajuan) == 'Diterima')>Diterima</option>
                                <option value="Ditolak" @selected(old('status_pengajuan', $pengajuan->status_pengajuan) == 'Ditolak')>Ditolak</option>
                            </select>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end items-center mt-6">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <hr class="my-6">
                
                <h4 class="text-lg font-semibold text-red-800 mb-4">Hapus Pengajuan</h4>
                <form action="{{ route('admin.manajemen_sk.pengajuan_pembimbing.destroy', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                    @csrf
                    @method('DELETE')
                    <div class="text-right">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md">
                            Hapus Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
