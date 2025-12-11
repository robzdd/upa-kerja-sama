@extends('admin.layouts.app')

@section('title', 'Laporan & Statistik')

@section('content')
<div class="space-y-6">

    @if(session('warning'))
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    {{ session('warning') }}
                </p>
            </div>
        </div>
    </div>
    @endif

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Laporan & Statistik</h2>
        <a href="{{ route('admin.reports.download', request()->only(['start_date', 'end_date'])) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center space-x-2 shadow-sm transition">
            <i class="fas fa-file-pdf"></i>
            <span>Export PDF</span>
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Alumni -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Alumni</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalAlumni) }}</h3>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Mitra -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Mitra</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalMitra) }}</h3>
                </div>
                <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Lowongan Aktif -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Lowongan</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalLowongan) }}</h3>
                </div>
                <div class="p-2 bg-green-50 rounded-lg text-green-600">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Lamaran -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Lamaran</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalLamaran) }}</h3>
                </div>
                <div class="p-2 bg-yellow-50 rounded-lg text-yellow-600">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Charts -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="mb-6" id="filterForm">
            <div class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center space-x-2">
                    <i class="fas fa-filter"></i>
                    <span>Terapkan Filter</span>
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Growth Chart -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pertumbuhan User & Lowongan</h3>
                <div class="relative h-72">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>

            <!-- Application Status Chart -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Lamaran</h3>
                <div class="relative h-72 flex justify-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Companies -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 5 Mitra dengan Lowongan Terbanyak</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sektor</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Lowongan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung Sejak</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($topCompanies as $company)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($company->logo)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->nama_perusahaan }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $company->nama_perusahaan }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $company->sektor }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-blue-600">
                            {{ $company->lowongan_count }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            {{ $company->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data perusahaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Client-side Date Validation
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const filterForm = document.getElementById('filterForm');

        if (!startDateInput || !endDateInput || !filterForm) {
            console.error('Date validation elements not found');
            return;
        }

        // Function to check dates
        function validateDates(showError = true) {
            const startValue = startDateInput.value;
            const endValue = endDateInput.value;

            if (!startValue || !endValue) return true;

            if (startValue > endValue) {
                if (showError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tanggal Tidak Valid',
                        text: 'Tanggal Awal tidak boleh lebih besar dari Tanggal Akhir!',
                        confirmButtonColor: '#3b82f6'
                    });
                }
                return false;
            }
            return true;
        }

        // Check on Input Change
        startDateInput.addEventListener('change', function() {
            if (endDateInput.value && this.value > endDateInput.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Tanggal Awal tidak boleh melebihi Tanggal Akhir.',
                    confirmButtonColor: '#f59e0b'
                });
                this.value = endDateInput.value; // Reset to max valid
            }
        });

        endDateInput.addEventListener('change', function() {
            if (startDateInput.value && this.value < startDateInput.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Tanggal Akhir tidak boleh kurang dari Tanggal Awal.',
                    confirmButtonColor: '#f59e0b'
                });
                this.value = startDateInput.value; // Reset to min valid
            }
        });

        // Check on Submit
        filterForm.addEventListener('submit', function(e) {
            if (!validateDates(true)) {
                e.preventDefault();
            }
        });
    });

    // Growth Chart
    const ctxGrowth = document.getElementById('growthChart').getContext('2d');
    new Chart(ctxGrowth, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [
                {
                    label: 'User Baru',
                    data: {!! json_encode($userCounts) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Lowongan Baru',
                    data: {!! json_encode($lowonganCounts) !!},
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2, 4]
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

    // Status Chart
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    const statusData = {!! json_encode($lamaranStatus) !!};
    
    // Default values if empty
    const labels = Object.keys(statusData).length > 0 ? Object.keys(statusData) : ['Belum ada data'];
    const data = Object.keys(statusData).length > 0 ? Object.values(statusData) : [1];
    const colors = Object.keys(statusData).length > 0 ? ['#f59e0b', '#10b981', '#ef4444'] : ['#e5e7eb']; // Yellow, Green, Red

    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: labels.map(l => l.charAt(0).toUpperCase() + l.slice(1)), // Capitalize
            datasets: [{
                data: data,
                backgroundColor: [
                    '#f59e0b', // Pending - Yellow
                    '#10b981', // Diterima - Green
                    '#ef4444', // Ditolak - Red
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '70%'
        }
    });
</script>
@endpush
@endsection
