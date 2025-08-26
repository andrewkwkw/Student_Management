<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan SK Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-md border">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Dokumen Pengajuan</h2>

                <div class="w-full overflow-hidden rounded-lg shadow-sm border mb-6">
                    <div class="w-full overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dokumen
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Bukti ACC Dosen Pembimbing 1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($pengajuan->bukti_acc_1)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Terkirim
                                            </span>
                                            <a href="{{ Storage::url($pengajuan->bukti_acc_1) }}" target="_blank" class="ml-4 text-blue-600 hover:underline">Lihat Dokumen</a>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Belum Diunggah
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Bukti ACC Dosen Pembimbing 2
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($pengajuan->bukti_acc_2)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Terkirim
                                            </span>
                                            <a href="{{ Storage::url($pengajuan->bukti_acc_2) }}" target="_blank" class="ml-4 text-blue-600 hover:underline">Lihat Dokumen</a>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Belum Diunggah
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Bukti Bimbingan Dosen Pembimbing 1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($pengajuan->bukti_bimbingan_1)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Terkirim
                                            </span>
                                            <a href="{{ Storage::url($pengajuan->bukti_bimbingan_1) }}" target="_blank" class="ml-4 text-blue-600 hover:underline">Lihat Dokumen</a>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Belum Diunggah
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Bukti Bimbingan Dosen Pembimbing 2
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($pengajuan->bukti_bimbingan_2)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Terkirim
                                            </span>
                                            <a href="{{ Storage::url($pengajuan->bukti_bimbingan_2) }}" target="_blank" class="ml-4 text-blue-600 hover:underline">Lihat Dokumen</a>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Belum Diunggah
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pesan Status --}}
                <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-800 p-4 mb-6" role="alert">
                    <p class="font-bold">Informasi</p>
                    <p>Bukti telah terkirim. Mohon tunggu kabar selanjutnya dari admin.</p>
                </div>

                {{-- Tombol Download SK (contoh kondisional) --}}
                <div class="text-center mt-8">
                    @if ($pengajuan->sk_pembimbing) {{-- Asumsi ada kolom 'sk_pembimbing' di tabel Anda --}}
                        <a href="{{ Storage::url($pengajuan->sk_pembimbing) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md">
                            Unduh SK Pembimbing
                        </a>
                    @else
                        <p class="text-gray-500">SK Pembimbing belum tersedia.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
