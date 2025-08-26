<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Detail Pendaftaran SK</h1>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                    {{ session('info') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-md">
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700 w-1/3">
                                Nama Mahasiswa
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $daftarSk->user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                Jadwal Yudisium
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $daftarSk->jadwal_yudisium ?? 'Belum ditentukan' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                Nilai Sidang Hasil
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $nilaiSidangHasil ?? 'Belum ada nilai' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                Tanggal Pendaftaran
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $daftarSk->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
