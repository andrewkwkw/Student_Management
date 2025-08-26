<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Tugas Akhir FMIPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-700 min-h-screen flex flex-col items-center justify-center px-4">

    <!-- Judul di atas -->
    <div class="text-center text-white mb-8">
        <h1 class="text-2xl md:text-3xl font-bold uppercase leading-relaxed">
            Sistem Registrasi Tugas Akhir Mahasiswa <br>
            Ilmu Komputer FMIPA Universitas Pakuan
        </h1>
    </div>

    <!-- Box Login & Register -->
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md flex flex-col items-center">
        
        <!-- Logo kampus -->
        <div class="flex space-x-4 mb-6">
            <img src="{{ asset('assets/img/fmipa.png') }}" class="w-24 h-24 object-contain" alt="FMIPA Logo">
            <img src="{{ asset('assets/img/ilkom.png') }}" class="w-24 h-24 object-contain rounded-lg" alt="Ilkom Logo">
        </div>

        <!-- Tombol -->
        <div class="flex flex-col w-full space-y-4">
            <a href="{{ route('register') }}" class="text-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Daftar</a>
            <a href="{{ route('login') }}" class="text-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Login</a>
        </div>
    </div>

</body>
</html>
