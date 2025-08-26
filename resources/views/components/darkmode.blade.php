{{-- resources/views/components/darkmode.blade.php --}}

<button id="darkModeToggle" class="p-2 rounded-md focus:outline-none focus:ring">
    <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h1M4 12H3m15.325 3.325l-.707.707M5.378 5.378l-.707-.707m12.745 0l.707-.707M6.025 18.325l-.707.707M12 18a6 6 0 110-12 6 6 0 010 12z"></path>
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const darkModeToggle = document.getElementById('darkModeToggle');
        const htmlElement = document.documentElement; // Ini adalah elemen <html>

        // Inisialisasi mode berdasarkan preferensi yang tersimpan atau sistem
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }

        // Tambahkan event listener hanya jika tombol ditemukan
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                if (htmlElement.classList.contains('dark')) {
                    htmlElement.classList.remove('dark');
                    localStorage.theme = 'light'; // Simpan preferensi light
                } else {
                    htmlElement.classList.add('dark');
                    localStorage.theme = 'dark'; // Simpan preferensi dark
                }
            });
        }
    });
</script>