<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengajuan Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan sukses / error --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <strong>Sukses!</strong> {{ session('success') }}
                </div>
            @endif
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
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pengajuan Pembimbing</h2>

                <form action="{{ route('mahasiswa.pengajuan_pembimbing.store') }}" method="POST">
                    @csrf
                    
                    {{-- Info Mahasiswa --}}
                    <h3 class="font-semibold text-lg mb-2">Data Mahasiswa</h3>
                    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                    <p class="mb-4"><strong>NPM:</strong> {{ Auth::user()->npm }}</p>

                    {{-- Judul SK --}}
                    <div class="mb-6">
                        <x-input-label for="judul_sk" :value="__('Judul SK')" />
                        <x-text-input id="judul_sk" class="block mt-1 w-full" type="text" name="judul_sk" :value="old('judul_sk')" required />
                        <x-input-error :messages="$errors->get('judul_sk')" class="mt-2" />
                    </div>

                    {{-- Bidang Minat --}}
                    <div class="mb-6">
                        <x-input-label for="bidang_minat" :value="__('Bidang Minat')" />
                        <select id="bidang_minat" name="bidang_minat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">Pilih Bidang Minat</option>
                            <option value="RPL" @selected(old('bidang_minat') == 'RPL')>RPL</option>
                            <option value="Kecerdasan Buatan" @selected(old('bidang_minat') == 'Kecerdasan Buatan')>Kecerdasan Buatan</option>
                            <option value="Jaringan" @selected(old('bidang_minat') == 'Jaringan')>Jaringan</option>
                            <option value="Hardware" @selected(old('bidang_minat') == 'Hardware')>Hardware</option>
                        </select>
                        <x-input-error :messages="$errors->get('bidang_minat')" class="mt-2" />
                    </div>
                    {{-- Submit --}}
                    <div class="text-center">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-md">
                            Ajukan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
