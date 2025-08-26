<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Detail Pengajuan Proposal</h1>
    
            {{-- Menampilkan pesan info dari session --}}
            @if (session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif
    
            {{-- Menampilkan data proposal jika ada --}}
            @if ($proposal)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <tbody class="divide-y divide-gray-200">
                            {{-- Baris untuk Nilai Proposal --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700 w-1/3">Nilai Proposal</td>
                                <td class="px-6 py-4 text-gray-600">{{ $proposal->nilai_proposal ?? 'Belum ada nilai' }}</td>
                            </tr>
    
                            {{-- Baris untuk Bukti ACC 1 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti ACC 1</td>
                                <td class="px-6 py-4">
                                    @if ($proposal->bukti_acc_1)
                                        <a href="{{ asset('storage/' . $proposal->bukti_acc_1) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Lihat Berkas</a>
                                    @else
                                        <p class="text-gray-600">Berkas belum diunggah.</p>
                                    @endif
                                </td>
                            </tr>
    
                            {{-- Baris untuk Bukti ACC 2 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti ACC 2</td>
                                <td class="px-6 py-4">
                                    @if ($proposal->bukti_acc_2)
                                        <a href="{{ asset('storage/' . $proposal->bukti_acc_2) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Lihat Berkas</a>
                                    @else
                                        <p class="text-gray-600">Berkas belum diunggah.</p>
                                    @endif
                                </td>
                            </tr>
    
                            {{-- Baris untuk Bukti Bimbingan 1 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti Bimbingan 1</td>
                                <td class="px-6 py-4">
                                    @if ($proposal->bukti_bimbingan_1)
                                        <a href="{{ asset('storage/' . $proposal->bukti_bimbingan_1) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Lihat Berkas</a>
                                    @else
                                        <p class="text-gray-600">Berkas belum diunggah.</p>
                                    @endif
                                </td>
                            </tr>
    
                            {{-- Baris untuk Bukti Bimbingan 2 --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Bukti Bimbingan 2</td>
                                <td class="px-6 py-4">
                                    @if ($proposal->bukti_bimbingan_2)
                                        <a href="{{ asset('storage/' . $proposal->bukti_bimbingan_2) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Lihat Berkas</a>
                                    @else
                                        <p class="text-gray-600">Berkas belum diunggah.</p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Menampilkan pesan jika tidak ada proposal --}}
                <div class="text-center text-gray-600">
                    <p>Anda belum mengajukan proposal.</p>
                    <a href="{{ route('proposal.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-700">
                        Ajukan Proposal Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
