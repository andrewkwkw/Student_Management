<div class="flex">
    {{-- Sidebar --}}
    <div class="fixed inset-y-0 left-0 z-30 w-64 bg-green-700 text-white transform md:translate-x-0 transition-transform duration-200 ease-in-out"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

        {{-- Header Sidebar --}}
        <div class="flex items-center justify-between p-4 border-b border-green-600">
            <span class="font-bold text-xl">Tugas Akhir</span>
            <button @click="sidebarOpen = false" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- User Info --}}
        <div class="px-4 py-3 border-b border-green-600">
            <div class="font-medium text-base">{{ Auth::user()->name }}</div>
            <div class="text-sm text-green-200">{{ Auth::user()->email }}</div>
        </div>

        {{-- Navigation --}}
        <nav class="p-4 space-y-2">
            {{-- Dashboard --}}
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded hover:bg-green-800">Dashboard</a>
            @else
            <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-green-800">Dashboard</a>
            @endif

            {{-- Admin Menu --}}
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.praklap.index') }}"
                class="block p-2 rounded hover:bg-green-800">Praktik Lapang</a>

            <div x-data="{ open: false }" class="space-y-2">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between p-2 rounded hover:bg-green-800">
                    <span>Manajemen SK</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-4 space-y-1">
                    <a href="{{ route('admin.manajemen_sk.pengajuan_pembimbing.show') }}" class="block p-2 rounded hover:bg-green-800"> Pengajuan Pembimbing </a>
                    <a href="{{ route('admin.manajemen_sk.pengajuan_sk_pembimbing.show') }}" class="block p-2 rounded hover:bg-green-800">Pengajuan SK Pembimbing</a>
                    <a href="{{ route('admin.manajemen_sk.pengajuan_proposal.show') }}" class="block p-2 rounded hover:bg-green-800">Pengajuan Proposal</a>
                    <a href="{{ route('admin.manajemen_sk.sidang_hasil.show') }}" class="block p-2 rounded hover:bg-green-800">Pendaftaran Sidang Hasil</a>
                    <a href="#" class="block p-2 rounded hover:bg-green-800">Pendaftaran SK</a>
                </div>
            </div>
            @else
            <a href="{{ route('mahasiswa.praklap.create') }}"
                class="block p-2 rounded hover:bg-green-800">Praktik Lapang</a>

            <div x-data="{ open: false }" class="space-y-2">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between p-2 rounded hover:bg-green-800">
                    <span>Pendaftaran SK</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-4 space-y-1">
                    <a href="{{ route('mahasiswa.pengajuan_pembimbing.create') }}" class="block p-2 rounded hover:bg-green-800">Pengajuan Pembimbing</a>
                    <a href="{{ route('mahasiswa.pengajuan_sk_pembimbing.create') }}" class="block p-2 rounded hover:bg-green-800">Pengajuan SK Pembimbing</a>
                    <a href="{{ route('mahasiswa.pengajuan_proposal.create') }}" class="block p-2 rounded hover:bg-green-800">Pengajuan Proposal</a>
                    <a href="{{ route('mahasiswa.sidang_hasil.create') }}" class="block p-2 rounded hover:bg-green-800">Pendaftaran Sidang Hasil</a>
                    <a href="{{ route('mahasiswa.pendaftaran_sk.create') }}" class="block p-2 rounded hover:bg-green-800">Pendaftaran Sidang Skripsi</a>
                </div>
            </div>
            @endif
        </nav>

        {{-- Footer --}}
        <div class="px-4 mt-4 border-t border-green-600 pt-4 space-y-2">
            @unless(Auth::user()->role === 'admin')
            <a href="{{ route('profile.edit') }}" class="block p-2 rounded hover:bg-green-800">
                {{ __('Profile') }}
            </a>
            @endunless
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left p-2 rounded hover:bg-green-800">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</div>