@extends('admin.layouts.app')

@section('content')
<div class="space-y-6 animate-fade-in">
    

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-200 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+{{ $stats['total_users'] > 0 ? '12%' : '0%' }}</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_users']) }}</h3>
        </div>

        <!-- Total Alumni -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-200 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+{{ $stats['total_alumni'] > 0 ? '5%' : '0%' }}</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Total Alumni</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_alumni']) }}</h3>
        </div>

        <!-- Total Artikel -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-200 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+{{ $stats['total_artikel'] > 0 ? '8%' : '0%' }}</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Artikel Terbit</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_artikel']) }}</h3>
        </div>

        <!-- Total Lowongan -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-200 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Active</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Lowongan Kerja</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_lowongan']) }}</h3>
        </div>

        <!-- Pending Mitra Requests -->
        
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Growth Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Pertumbuhan Pengguna (6 Bulan Terakhir)</h3>
            <div class="relative h-80">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <!-- Article Categories Chart -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Kategori Artikel</h3>
            <div class="relative h-64 flex items-center justify-center">
                <canvas id="articleCategoryChart"></canvas>
            </div>
            <div class="mt-6 space-y-3">
                @foreach($articleCategories->take(3) as $category)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $category['name'] }}</span>
                        <span class="font-semibold text-gray-900">{{ $category['count'] }} Artikel</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Pengguna Terbaru</h3>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recent_users as $user)
                    <div class="p-4 hover:bg-gray-50 transition flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">Belum ada pengguna baru</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Articles -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Artikel Terbaru</h3>
                <a href="{{ route('admin.artikel.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recent_artikel as $artikel)
                    <div class="p-4 hover:bg-gray-50 transition flex items-center gap-4">
                        @if($artikel->thumbnail)
                            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $artikel->judul }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-medium">
                                    {{ $artikel->kategori->nama ?? 'Uncategorized' }}
                                </span>
                                <span class="text-xs text-gray-400">{{ $artikel->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">Belum ada artikel</div>
                @endforelse
            </div>
        </div>
    </div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Growth Chart
    const userCtx = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(userCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Pengguna Baru',
                data: {!! json_encode($userCounts) !!},
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#4F46E5',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1F2937',
                    padding: 12,
                    titleFont: { size: 13 },
                    bodyFont: { size: 13 },
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [4, 4],
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Article Categories Chart
    const categoryCtx = document.getElementById('articleCategoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($articleCategories->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($articleCategories->pluck('count')) !!},
                backgroundColor: [
                    '#3B82F6', '#8B5CF6', '#EC4899', '#F59E0B', '#10B981', '#6366F1'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection
