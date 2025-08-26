<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Pendaftaran SK</h1>

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    {{ session('warning') }}
                </div>
            @endif

            <form action="{{ route('mahasiswa.pendaftaran_sk.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Yudisium</label>
                        <input type="text" name="jadwal_yudisium" value="{{ old('jadwal_yudisium') }}"
                               class="w-full border rounded-md px-3 py-2">
                        @error('jadwal_yudisium')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit"
                                class="px-6 py-3 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                            Daftar SK
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
