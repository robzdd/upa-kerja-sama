<header class="bg-white shadow-sm border-b border-gray-200 flex-shrink-0">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = true" class="lg:hidden mr-4 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Search Bar -->
        <div class="flex items-center flex-1 max-w-xl" x-data="{ 
            searchQuery: '', 
            searchResults: [], 
            showResults: false,
            isLoading: false,
            performSearch() {
                if (this.searchQuery.length < 2) {
                    this.searchResults = [];
                    this.showResults = false;
                    return;
                }
                this.isLoading = true;
                this.showResults = true;
                fetch(`/admin/search?q=${encodeURIComponent(this.searchQuery)}`)
                    .then(res => res.json())
                    .then(data => {
                        this.searchResults = data;
                        this.isLoading = false;
                    })
                    .catch(() => {
                        this.isLoading = false;
                    });
            }
        }">
            <div class="relative w-full" @click.away="showResults = false">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" 
                       x-model="searchQuery"
                       @input.debounce.300ms="performSearch()"
                       @focus="if(searchQuery.length >= 2) showResults = true"
                       placeholder="Cari user, artikel, atau lowongan..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                
                <!-- Loading Indicator -->
                <div x-show="isLoading" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <!-- Search Results Dropdown -->
                <div x-show="showResults && searchQuery.length >= 2" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="absolute top-full left-0 w-full mt-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50"
                     style="display: none;">
                    
                    <template x-if="searchResults.length > 0">
                        <div class="max-h-96 overflow-y-auto">
                            <template x-for="result in searchResults" :key="result.url">
                                <a :href="result.url" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 mr-3">
                                            <i class="fas" :class="{
                                                'fa-user': result.icon === 'user',
                                                'fa-file-alt': result.icon === 'document-text',
                                                'fa-briefcase': result.icon === 'briefcase'
                                            }"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate" x-text="result.title"></p>
                                            <div class="flex items-center mt-0.5">
                                                <span class="text-xs font-medium px-1.5 py-0.5 rounded bg-gray-100 text-gray-600 mr-2" x-text="result.type"></span>
                                                <p class="text-xs text-gray-500 truncate" x-text="result.subtitle"></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </template>

                    <template x-if="searchResults.length === 0 && !isLoading">
                        <div class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-search text-gray-300 text-2xl mb-2 block"></i>
                            <p class="text-sm">Tidak ada hasil ditemukan</p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Right Section: Notifications & Profile -->
        <div class="flex items-center space-x-3 ml-6">
            <!-- Mitra Request Notifications -->
            @php
                $pendingRequests = \App\Models\MitraRegistrationRequest::pending()->latest()->take(5)->get();
                $pendingCount = \App\Models\MitraRegistrationRequest::pending()->count();
            @endphp
            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-bell text-xl"></i>
                    @if($pendingCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center animate-pulse">
                            {{ $pendingCount > 9 ? '9+' : $pendingCount }}
                        </span>
                    @endif
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                     class="absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-2xl border border-gray-200 z-50"
                     style="display: none;">
                    
                    <!-- Header -->
                    <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-gray-900">Request Mitra Baru</h3>
                            @if($pendingCount > 0)
                                <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                                    {{ $pendingCount }} Pending
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Notification List -->
                    <div class="max-h-96 overflow-y-auto">
                        @forelse($pendingRequests as $request)
                            <a href="{{ route('admin.mitra-requests.show', $request->id) }}" 
                               class="block px-4 py-3 hover:bg-blue-50 transition border-b border-gray-100 last:border-0">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">
                                            {{ $request->nama_perusahaan }}
                                        </p>
                                        <p class="text-xs text-gray-600 truncate">
                                            {{ $request->email }}
                                        </p>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span class="text-xs text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $request->created_at->diffForHumans() }}
                                            </span>
                                            <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                                {{ $request->bidang_usaha }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-4 py-8 text-center">
                                <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Tidak ada request pending</p>
                                <p class="text-xs text-gray-500 mt-1">Semua request sudah diproses</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Footer -->
                    @if($pendingCount > 0)
                        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                            <a href="{{ route('admin.mitra-requests.index') }}" 
                               class="block text-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                                Lihat Semua Request ({{ $pendingCount }})
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Help Button -->
            <div x-data="{ helpOpen: false }">
                <button @click="helpOpen = true" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition relative group">
                    <i class="fas fa-question-circle text-xl"></i>
                    <span class="absolute top-full right-0 mt-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none">
                        Bantuan
                    </span>
                </button>

                <!-- Help Modal Backdrop -->
                <div x-show="helpOpen" 
                     @click="helpOpen = false"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900/50 z-[60]"
                     style="display: none;">
                </div>

                <!-- Help Modal Content -->
                <div x-show="helpOpen" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="fixed inset-0 z-[70] flex items-center justify-center p-4 pointer-events-none">
                     
                    <div @click.stop class="bg-white rounded-2xl shadow-2xl w-full max-w-lg pointer-events-auto flex flex-col max-h-[90vh]">
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Pusat Bantuan</h3>
                            <button @click="helpOpen = false" class="text-gray-400 hover:text-gray-600 transition">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Content - Scrollable -->
                        <div class="p-6 overflow-y-auto">
                            <div class="space-y-6">
                                <!-- Quick Actions -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Aksi Cepat</h4>
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="{{ route('admin.users.create', ['type' => 'alumni']) }}" class="flex items-center p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition text-blue-700">
                                            <div class="w-8 h-8 bg-blue-200 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-user-plus text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium">Tambah Alumni</span>
                                        </a>
                                        <a href="{{ route('admin.artikel.create') }}" class="flex items-center p-3 bg-purple-50 rounded-xl hover:bg-purple-100 transition text-purple-700">
                                            <div class="w-8 h-8 bg-purple-200 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-newspaper text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium">Tulis Artikel</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Keyboard Shortcuts -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Panduan Singkat</h4>
                                    <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                        <div class="flex items-start">
                                            <div class="text-blue-500 mt-1 mr-3">
                                                <i class="fas fa-info-circle"></i>
                                            </div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold text-gray-900">Manajemen User:</span> 
                                                Kelola data Alumni dan Mitra. Anda bisa memverifikasi, mengedit, atau menghapus pengguna.
                                            </p>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="text-blue-500 mt-1 mr-3">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold text-gray-900">Dashboard:</span> 
                                                Pantau statistik pendaftaran dan aktivitas lowongan secara real-time.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Support Contacts -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Butuh Bantuan Teknis?</h4>
                                    <a href="mailto:support@polindra.ac.id" class="flex items-center p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-sm transition group">
                                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 group-hover:bg-blue-50 group-hover:text-blue-600 transition mr-4">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600">Hubungi Tim IT</p>
                                            <p class="text-xs text-gray-500">support@polindra.ac.id</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl border-t border-gray-100">
                            <p class="text-xs text-center text-gray-500">
                                Unit Penunjang Akademik - Politeknik Negeri Indramayu &copy; {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-3 hover:bg-gray-50 rounded-xl p-2 transition">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 1)) }}</span>
                    </div>
                    <div class="text-left hidden md:block">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform" :class="{ 'rotate-180': open }"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50"
                     style="display: none;">
                    
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                            <i class="fas fa-user w-5 mr-3"></i>
                            Edit Profile
                        </a>
                    </div>

                    <!-- Logout -->
                    <div class="border-t border-gray-100 pt-2">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>