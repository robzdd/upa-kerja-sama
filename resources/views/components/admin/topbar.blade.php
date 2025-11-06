<header class="bg-white shadow-sm z-10">
    <div class="flex items-center justify-between px-8 py-4">
        <div class="flex items-center flex-1 max-w-xl">
            <div class="relative w-full">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center space-x-2">
                    <kbd class="px-2 py-1 text-xs bg-gray-100 border border-gray-300 rounded">Ctrl + K</kbd>
                    <i class="fas fa-command text-gray-400"></i>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4 ml-8">
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-bell"></i>
            </button>
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-question-circle"></i>
            </button>
            <div class="flex items-center space-x-3 cursor-pointer">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                    <span class="text-white font-semibold">{{ auth()->user()->name[0] ?? 'AD' }}</span>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email ?? '' }}</p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
            </div>
        </div>
    </div>
</header>
