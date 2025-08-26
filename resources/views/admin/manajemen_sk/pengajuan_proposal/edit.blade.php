<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Nilai Proposal</h1>
            <p class="text-center text-gray-600 mb-8">Ubah nilai proposal untuk mahasiswa **{{ $proposal->user->name }}**.</p>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.manajemen_sk.pengajuan_proposal.update', $proposal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <tbody class="divide-y divide-gray-200">
                            {{-- Baris untuk Nilai Proposal --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700 w-1/3">Nilai Proposal</td>
                                <td class="px-6 py-4">
                                    <input type="text" name="nilai_proposal" id="nilai_proposal" value="{{ old('nilai_proposal', $proposal->nilai_proposal) }}" class="form-input w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('nilai_proposal') border-red-500 @enderror" placeholder="Masukkan nilai proposal">
                                    @error('nilai_proposal')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Tautan untuk melihat dokumen yang diunggah --}}
                <div class="mt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Dokumen yang Diunggah</h2>
                    <ul class="space-y-2 text-gray-600">
                        <li>
                            <span class="font-semibold">Bukti ACC 1:</span>
                            @if($proposal->bukti_acc_1)
                                <a href="{{ asset('storage/' . $proposal->bukti_acc_1) }}" target="_blank" class="text-blue-600 hover:underline ml-2">Lihat Berkas</a>
                            @else
                                <span class="ml-2">Belum ada</span>
                            @endif
                        </li>
                        <li>
                            <span class="font-semibold">Bukti ACC 2:</span>
                            @if($proposal->bukti_acc_2)
                                <a href="{{ asset('storage/' . $proposal->bukti_acc_2) }}" target="_blank" class="text-blue-600 hover:underline ml-2">Lihat Berkas</a>
                            @else
                                <span class="ml-2">Belum ada</span>
                            @endif
                        </li>
                        <li>
                            <span class="font-semibold">Bukti Bimbingan 1:</span>
                            @if($proposal->bukti_bimbingan_1)
                                <a href="{{ asset('storage/' . $proposal->bukti_bimbingan_1) }}" target="_blank" class="text-blue-600 hover:underline ml-2">Lihat Berkas</a>
                            @else
                                <span class="ml-2">Belum ada</span>
                            @endif
                        </li>
                        <li>
                            <span class="font-semibold">Bukti Bimbingan 2:</span>
                            @if($proposal->bukti_bimbingan_2)
                                <a href="{{ asset('storage/' . $proposal->bukti_bimbingan_2) }}" target="_blank" class="text-blue-600 hover:underline ml-2">Lihat Berkas</a>
                            @else
                                <span class="ml-2">Belum ada</span>
                            @endif
                        </li>
                    </ul>
                </div>

                {{-- Tombol Submit --}}
                <div class="mt-8 flex justify-center">
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
            {{-- FORM UNTUK MENGHAPUS PROPOSAL --}}
            <div class="flex justify-between items-center mt-2 pt-5 border-t-4 border-red-600">
                <h4 class="text-lg font-semibold text-red-800">Hapus</h4>
                <form id="delete-form" action="{{ route('admin.manajemen_sk.pengajuan_proposal.destroy', $proposal->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md">
                        Hapus Proposal
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
