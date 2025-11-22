<header class="bg-white shadow-sm z-10">
    <div class="flex items-center justify-between px-8 py-4">
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
                fetch(`/admin/search?q=${this.searchQuery}`)
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
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                
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

        <div class="flex items-center space-x-4 ml-8">
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                <i class="fas fa-bell"></i>
            </button>
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                <i class="fas fa-question-circle"></i>
            </button>
            
            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 rounded-xl p-2 transition">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-semibold">{{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 1)) }}</span>
                    </div>
                    <div class="text-left">
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
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
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
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Edit Profile
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan
                        </a>
                    </div>

                    <!-- Logout -->
                    <div class="border-t border-gray-100 pt-2">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Alpine.js for dropdown functionality -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
