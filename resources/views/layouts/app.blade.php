<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Registrasi Tugas Akhir FMIPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
            <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Navigation (optional) -->
            
            <!-- Top Bar Mobile -->
            <header class="flex items-center justify-between bg-green-700 shadow-md p-4 md:hidden">
                {{-- Tombol Hamburger --}}
                <button @click="sidebarOpen = true" 
                        class="p-2 text-white bg-green-700 rounded-md focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <span class="font-semibold text-white">Student Management</span>

                <div></div> {{-- kosong, biar space kanan seimbang --}}
            </header>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-semibold text-gray-800">
                                {{ $header }}
                            </h1>
                            <div class="text-base font-medium text-black">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
