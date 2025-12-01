@extends('admin.layouts.app')

@section('title', 'Laporan & Statistik')

@section('content')
<div class="space-y-6">

    <h2 class="text-xl md:text-2xl font-bold text-gray-900">Laporan & Statistik</h2>

    <!-- Filter -->
    <div class="flex items-center justify-between">
        <div class="flex space-x-3">
            <input type="date" class="border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="date" class="border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            <button class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg hover:bg-gradient-to-r from-blue-600 to-purple-600 flex items-center space-x-2">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-3">Total Pengguna per Bulan</h3>
            <canvas id="userChart"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-3">Artikel Terbit per Bulan</h3>
            <canvas id="artikelChart"></canvas>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('userChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt'],
        datasets: [{
            label: 'Users',
            data: [20, 40, 30, 60, 80, 75, 100, 120, 110, 150],
            borderColor: '#3b82f6',
            fill: false,
            tension: 0.3
        }]
    }
});

new Chart(document.getElementById('artikelChart'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt'],
        datasets: [{
            label: 'Artikel',
            data: [5, 10, 15, 20, 10, 25, 18, 22, 17, 30],
            backgroundColor: '#3b82f6'
        }]
    }
});
</script>
@endpush
@endsection
