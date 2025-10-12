<!-- Sidebar Component -->
<aside class="fixed left-0 top-0 h-screen w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white shadow-lg z-50 flex flex-col">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-blue-500">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <span class="text-blue-600 font-bold text-lg">MP</span>
            </div>
            <div>
                <h2 class="font-bold text-lg">Mitra Pro</h2>
                <p class="text-xs text-blue-200">Partner Portal</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 space-y-2 flex-1">
        <!-- Dashboard Section -->
        <div class="mb-6">
            <p class="px-4 py-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Menu</p>

            <!-- Dashboard -->
            <a href="{{ route('mitra.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-500 hover:bg-blue-400 transition-colors group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m0 0H9m3 0h3"></path>
                </svg>
                <div class="flex-1">
                    <span class="font-medium">Dashboard</span>

                </div>
            </a>


        </div>

        <!-- Lowongan Section -->
        <div class="mb-6">
            <p class="px-4 py-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Lowongan</p>

            <!-- Create Lowongan -->
            <a href="{{ route('mitra.lowongan.create') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-medium">Buat Lowongan</span>
            </a>

            <!-- Daftar Lowongan -->
            <a href="{{ route('mitra.lowongan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">Daftar Lowongan</span>
            </a>


            <!-- Pelamar -->
            <a href="#pelamar" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                </svg>
                <span class="font-medium">Pelamar</span>
                <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">5</span>
            </a>

            <!-- Riwayat Lamaran -->
            <a href="#riwayat" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">Riwayat Lamaran</span>
            </a>
        </div>

        <!-- Settings Section -->
        <div class="mb-6">
            <p class="px-4 py-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Pengaturan</p>

            <!-- Profil Perusahaan -->
            <a href="#profil-perusahaan" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">Profil Perusahaan</span>
            </a>

            <!-- Pengaturan Akun -->
            <a href="#pengaturan-akun" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">Pengaturan Akun</span>
            </a>

            <!-- Bantuan -->
            <a href="#bantuan" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Bantuan & Dukungan</span>
            </a>
        </div>
    </nav>

</aside>
