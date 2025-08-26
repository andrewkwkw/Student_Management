<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unggah Dokumen SK Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Pesan sukses/error --}}
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

            <div class="bg-white p-8 rounded-xl shadow-xl border">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Form Unggah Dokumen</h2>

                <form action="{{ route('mahasiswa.pengajuan_sk_pembimbing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Card untuk Bukti ACC Dosen Pembimbing 1 --}}
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md border-2 border-transparent transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px] hover:border-green-600">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4">Bukti ACC Dosen Pembimbing 1</h3>
                            <div class="mb-4">
                                <x-input-label for="bukti_acc_1" :value="__('Unggah File (JPG, PNG, GIF)')" />
                                <input id="bukti_acc_1" name="bukti_acc_1" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                <x-input-error :messages="$errors->get('bukti_acc_1')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Card untuk Bukti ACC Dosen Pembimbing 2 --}}
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md border-2 border-transparent transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px] hover:border-yellow-600">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4">Bukti ACC Dosen Pembimbing 2 (Opsional)</h3>
                            <div class="mb-4">
                                <x-input-label for="bukti_acc_2" :value="__('Unggah File (JPG, PNG, GIF)')" />
                                <input id="bukti_acc_2" name="bukti_acc_2" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                <x-input-error :messages="$errors->get('bukti_acc_2')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Card untuk Bukti Bimbingan Dosen Pembimbing 1 --}}
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md border-2 border-transparent transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px] hover:border-blue-600">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4">Bukti Bimbingan Dosen Pembimbing 1</h3>
                            <div class="mb-4">
                                <x-input-label for="bukti_bimbingan_1" :value="__('Unggah File (JPG, PNG, GIF)')" />
                                <input id="bukti_bimbingan_1" name="bukti_bimbingan_1" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                <x-input-error :messages="$errors->get('bukti_bimbingan_1')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Card untuk Bukti Bimbingan Dosen Pembimbing 2 --}}
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md border-2 border-transparent transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px] hover:border-purple-600">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4">Bukti Bimbingan Dosen Pembimbing 2 (Opsional)</h3>
                            <div class="mb-4">
                                <x-input-label for="bukti_bimbingan_2" :value="__('Unggah File (JPG, PNG, GIF)')" />
                                <input id="bukti_bimbingan_2" name="bukti_bimbingan_2" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                <x-input-error :messages="$errors->get('bukti_bimbingan_2')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    
                    {{-- Tombol Unggah --}}
                    <div class="text-center mt-8">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-md">
                            Unggah Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
