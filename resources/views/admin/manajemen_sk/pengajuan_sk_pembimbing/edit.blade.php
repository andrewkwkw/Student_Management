    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Unggah SK Pembimbing') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                {{-- Pesan error validasi --}}
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <strong>Gagal!</strong>
                        <ul class="list-disc pl-6">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="bg-white p-8 rounded-xl shadow-md border">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Form Unggah SK Pembimbing</h2>
                    {{-- FORM UNTUK MENGUNGGAH/UPDATE SK --}}
                    <form action="{{ route('admin.manajemen_sk.pengajuan_sk_pembimbing.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="sk_pembimbing" class="block text-sm font-medium text-gray-700">Unggah File SK Pembimbing (PDF, maks 2MB)</label>
                            <input id="sk_pembimbing" name="sk_pembimbing" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <p class="mt-2 text-sm text-gray-500">
                                @if($pengajuan->sk_pembimbing)
                                    File yang sudah diunggah: 
                                    <a href="{{ Storage::url($pengajuan->sk_pembimbing) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($pengajuan->sk_pembimbing) }}</a>
                                @else
                                    Belum ada file yang diunggah.
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-8">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-md">
                                Simpan SK
                            </button>
                            <a href="{{ route('admin.manajemen_sk.pengajuan_pembimbing.show', $pengajuan->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-md">
                                Batal
                            </a>
                        </div>
                    </form>

                    <hr class="my-6">
                    
                    {{-- FORM UNTUK MENGHAPUS SK (dengan konfirmasi) --}}
                    <div class="flex justify-between items-center mt-6">
                        <h4 class="text-lg font-semibold text-red-800">Hapus Pengajuan</h4>
                        {{-- Menggunakan konfirmasi bawaan browser --}}
                        <form id="delete-form" action="{{ route('admin.manajemen_sk.pengajuan_sk_pembimbing.destroy', $pengajuan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md">
                                Hapus SK
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
