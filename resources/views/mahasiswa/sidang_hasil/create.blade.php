{{-- resources/views/mahasiswa/sidang_hasil/create.blade.php --}}
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Form Unggah Hasil Sidang</h1>
            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('mahasiswa.sidang_hasil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    <!-- Bukti ACC 1 -->
                    <div>
                        <label for="bukti_acc_1" class="block text-sm font-medium text-gray-700 mb-2">Bukti ACC 1 (Opsional)</label>
                        <input type="file" name="bukti_acc_1" id="bukti_acc_1" class="w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        ">
                        @error('bukti_acc_1')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bukti ACC 2 -->
                    <div>
                        <label for="bukti_acc_2" class="block text-sm font-medium text-gray-700 mb-2">Bukti ACC 2 (Opsional)</label>
                        <input type="file" name="bukti_acc_2" id="bukti_acc_2" class="w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        ">
                        @error('bukti_acc_2')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bukti Bimbingan 1 -->
                    <div>
                        <label for="bukti_bimbingan_1" class="block text-sm font-medium text-gray-700 mb-2">Bukti Bimbingan 1 (Opsional)</label>
                        <input type="file" name="bukti_bimbingan_1" id="bukti_bimbingan_1" class="w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        ">
                        @error('bukti_bimbingan_1')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bukti Bimbingan 2 -->
                    <div>
                        <label for="bukti_bimbingan_2" class="block text-sm font-medium text-gray-700 mb-2">Bukti Bimbingan 2 (Opsional)</label>
                        <input type="file" name="bukti_bimbingan_2" id="bukti_bimbingan_2" class="w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        ">
                        @error('bukti_bimbingan_2')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>  

                    <!-- Tombol Submit -->
                    <div class="mt-8 text-center">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
