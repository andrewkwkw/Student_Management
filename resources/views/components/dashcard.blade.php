@props(['user'])

<div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
    {{-- Sekarang Anda bisa menggunakan $user di sini --}}
    <h3 class="text-2xl font-semibold mb-6">Informasi Mahasiswa</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-3 font-medium text-gray-700">Nama</td>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                </tr>
                {{-- ... dan seterusnya, pastikan semua Auth::user() diganti dengan $user --}}
                <tr class="border-b">
                    <td class="px-4 py-3 font-medium text-gray-700">NPM</td>
                    <td class="px-4 py-3">{{ $user->npm }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-3 font-medium text-gray-700">Email</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-3 font-medium text-gray-700">Tahun Masuk</td>
                    <td class="px-4 py-3">{{ $user->tahun_masuk }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-3 font-medium text-gray-700">Jumlah SKS</td>
                    <td class="px-4 py-3">{{ $user->jumlah_sks }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-3 font-medium text-gray-700">Status Aktif</td>
                    <td class="px-4 py-3">
                        @if($user->status_aktif === 'aktif')
                            <span class="text-green-600">Aktif</span>
                        @else
                            <span class="text-red-600">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>