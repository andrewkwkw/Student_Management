<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pendaftaran Praktik Lapang') }}
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
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Info!</strong>
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pendaftaran Praktik Lapang</h2>

                <form action="{{ route('mahasiswa.praklap.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Pendaftar Utama (otomatis) -->
                    <h3 class="font-semibold text-lg">{{ __('Informasi Pendaftar Utama') }}</h3>
                    <div class="mt-4 mb-6">
                        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>NPM:</strong> {{ Auth::user()->npm }}</p>
                    </div>

                    <!-- Skema Praktik Lapang -->
                    <div class="mb-6 space-y-2">
                        <label class="block text-gray-700 font-medium mb-1">Skema Praktik Lapang <span class="text-red-500">*</span></label>
                        <label class="block text-gray-700">
                            <input type="radio" name="skema" value="Instansi" class="mr-2" id="skemaInstansi" {{ old('skema') == 'Instansi' ? 'checked' : '' }}> Instansi
                        </label>
                        <label class="block text-gray-700">
                            <input type="radio" name="skema" value="Sekolah" class="mr-2" id="skemaSekolah" {{ old('skema') == 'Sekolah' ? 'checked' : '' }}> Sekolah
                        </label>
                        <label class="block text-gray-700">
                            <input type="radio" name="skema" value="UMKM" class="mr-2" id="skemaUMKM" {{ old('skema') == 'UMKM' ? 'checked' : '' }}> UMKM
                        </label>
                        @error('skema')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload jika UMKM -->
                    <div class="mb-6" id="sipuUploadSection" style="display: none;">
                        <label class="block text-gray-700 font-medium mb-1" for="sipu_file">Jika memilih UMKM, upload Bukti Surat Izin Pendirian Usaha (SIPU):</label>
                        <input type="file" name="sipu_file" id="sipu_file" class="block w-full border border-gray-300 rounded-md p-2 text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-gray-100 file:text-gray-700">
                        <p class="text-sm text-gray-500 mt-1">1 file PDF, dokumen, atau gambar. Maks. 10MB.</p>
                        @error('sipu_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Instansi -->
                    <div class="mb-6">
                        <x-input-label for="nama_instansi" :value="__('Nama Instansi / Nama UMKM')" />
                        <x-text-input id="nama_instansi" class="block mt-1 w-full" type="text" name="nama_instansi" :value="old('nama_instansi')" required />
                        <x-input-error :messages="$errors->get('nama_instansi')" class="mt-2" />
                    </div>

                    <!-- Alamat Instansi -->
                    <div class="mb-6">
                        <x-input-label for="alamat_instansi" :value="__('Alamat Instansi')" />
                        <x-text-input id="alamat_instansi" class="block mt-1 w-full" type="text" name="alamat_instansi" :value="old('alamat_instansi')" required />
                        <x-input-error :messages="$errors->get('alamat_instansi')" class="mt-2" />
                    </div>
                    
                    <!-- Waktu Pelaksanaan -->
                    <div class="mb-6">
                        <label class="block font-medium text-gray-700 mb-1" for="tanggal_pelaksanaan">
                            Waktu Pelaksanaan <span class="text-red-500">*</span> <br>
                            <small class="text-gray-500">(Estimasi waktu mahasiswa memulai Praktik Lapang di Instansi)</small>
                        </label>
                        <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" class="w-full border border-gray-300 rounded-md p-2" value="{{ old('tanggal_pelaksanaan') }}">
                        @error('tanggal_pelaksanaan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <h3 class="font-semibold text-lg mt-6">Anggota Kelompok</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">{{ __('Opsional: Masukkan NPM anggota kelompok Anda.') }}</p>

                    <!-- NPM Anggota 2 -->
                    <div class="mb-6">
                        <x-input-label for="npm_mhs_2" :value="__('NPM Anggota 2')" />
                        <x-text-input id="npm_mhs_2" class="block mt-1 w-full" type="text" name="npm_mhs_2" :value="old('npm_mhs_2')" />
                        <x-input-error :messages="$errors->get('npm_mhs_2')" class="mt-2" />
                    </div>

                    <!-- NPM Anggota 3 -->
                    <div class="mb-6">
                        <x-input-label for="npm_mhs_3" :value="__('NPM Anggota 3')" />
                        <x-text-input id="npm_mhs_3" class="block mt-1 w-full" type="text" name="npm_mhs_3" :value="old('npm_mhs_3')" />
                        <x-input-error :messages="$errors->get('npm_mhs_3')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="text-center">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-md">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script JavaScript untuk menampilkan/menyembunyikan SIPU upload --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skemaRadios = document.querySelectorAll('input[name="skema"]');
            const sipuUploadSection = document.getElementById('sipuUploadSection');
            const sipuFileInput = document.getElementById('sipu_file');

            function toggleSipuUpload() {
                if (document.getElementById('skemaUMKM').checked) {
                    sipuUploadSection.style.display = 'block';
                    sipuFileInput.setAttribute('required', 'required');
                } else {
                    sipuUploadSection.style.display = 'none';
                    sipuFileInput.removeAttribute('required');
                    sipuFileInput.value = '';
                }
            }

            skemaRadios.forEach(radio => {
                radio.addEventListener('change', toggleSipuUpload);
            });

            toggleSipuUpload(); // Panggil saat halaman dimuat untuk inisialisasi tampilan awal
        });
    </script>
</x-app-layout>
