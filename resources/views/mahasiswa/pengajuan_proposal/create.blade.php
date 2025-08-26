<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Formulir Pengajuan Proposal</h1>
            <p class="text-center text-gray-600 mb-8">Silakan lengkapi formulir di bawah ini untuk mengajukan proposal Anda.</p>
    
            {{-- Menampilkan pesan sukses dari session --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
    
            {{-- Formulir pengajuan proposal --}}
            <form action="{{ route('mahasiswa.pengajuan_proposal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <tbody class="divide-y divide-gray-200">
                            {{-- Baris untuk Bukti ACC 1 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti ACC 1 (Opsional)</td>
                                <td class="px-6 py-4">
                                    <input type="file" name="bukti_acc_1" id="bukti_acc_1" class="form-input w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('bukti_acc_1') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Format: PDF, PNG, JPG (maks. 2MB)</p>
                                    @error('bukti_acc_1')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
    
                            {{-- Baris untuk Bukti ACC 2 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti ACC 2 (Opsional)</td>
                                <td class="px-6 py-4">
                                    <input type="file" name="bukti_acc_2" id="bukti_acc_2" class="form-input w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('bukti_acc_2') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Format: PDF, PNG, JPG (maks. 2MB)</p>
                                    @error('bukti_acc_2')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
    
                            {{-- Baris untuk Bukti Bimbingan 1 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti Bimbingan 1 (Opsional)</td>
                                <td class="px-6 py-4">
                                    <input type="file" name="bukti_bimbingan_1" id="bukti_bimbingan_1" class="form-input w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('bukti_bimbingan_1') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Format: PDF, PNG, JPG (maks. 2MB)</p>
                                    @error('bukti_bimbingan_1')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
    
                            {{-- Baris untuk Bukti Bimbingan 2 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti Bimbingan 2 (Opsional)</td>
                                <td class="px-6 py-4">
                                    <input type="file" name="bukti_bimbingan_2" id="bukti_bimbingan_2" class="form-input w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('bukti_bimbingan_2') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Format: PDF, PNG, JPG (maks. 2MB)</p>
                                    @error('bukti_bimbingan_2')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                {{-- Tombol Submit --}}
                <div class="mt-6 flex justify-center">
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Ajukan Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
