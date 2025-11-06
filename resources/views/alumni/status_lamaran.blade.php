@extends('alumni.layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mt-6">
    
    <!-- Sidebar -->
    <div class="lg:col-span-1">
        @php $user = Auth::user(); @endphp
        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <!-- Profile Avatar -->
            <div class="text-center mb-6">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 
                        0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $user->email }}</p>
            </div>

            <!-- Edit Profile Button -->
            <a href="{{ route('alumni.profile.edit') }}" 
               class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all mb-4 inline-block text-center">
                Edit Profil
            </a>

            <hr class="my-4">

            <!-- Menu Items -->
            <nav class="space-y-2">
                <a href="{{ route('alumni.cv.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 
                              0 01.707.293l5.414 5.414a1 1 0 
                              01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm font-medium">Curriculum Vitae</span>
                </a>

                <a href="{{ route('alumni.applications') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-50 text-blue-600 font-semibold">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v10a2 2 0 
                              002 2h8a2 2 0 002-2V7a2 2 0 
                              00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 
                              002-2M9 5a2 2 0 012-2h2a2 2 0 
                              012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span class="text-sm font-medium">Status Lamaran</span>
                </a>

                <a href="{{ route('alumni.certificates') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12l2 2 4-4M7.835 4.697a3.42 
                              3.42 0 001.946-.806 3.42 3.42 0 
                              014.438 0 3.42 3.42 0 
                              001.946.806 3.42 3.42 0 
                              013.138 3.138 3.42 3.42 0 
                              00.806 1.946 3.42 3.42 0 
                              010 4.438 3.42 3.42 0 
                              00-.806 1.946 3.42 3.42 0 
                              01-3.138 3.138 3.42 3.42 0 
                              00-1.946.806 3.42 3.42 0 
                              01-4.438 0 3.42 3.42 0 
                              00-1.946-.806 3.42 3.42 0 
                              01-3.138-3.138 3.42 3.42 0 
                              00-.806-1.946 3.42 3.42 0 
                              010-4.438 3.42 3.42 0 
                              00.806-1.946 3.42 3.42 0 
                              013.138-3.138z"/>
                    </svg>
                    <span class="text-sm font-medium">Sertifikat Magang</span>
                </a>

                <a href="{{ route('alumni.security.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 
                              11.955 0 0112 2.944a11.955 11.955 0 
                              01-8.618 3.04A12.02 12.02 0 
                              003 9c0 5.591 3.824 10.29 9 
                              11.622 5.176-1.332 9-6.03 
                              9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span class="text-sm font-medium">Pengaturan Keamanan</span>
                </a>

                <form method="POST" action="{{ route('alumni.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-600 w-full text-left">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 
                                  4v1a3 3 0 01-3 3H6a3 3 0 
                                  01-3-3V7a3 3 0 013-3h4a3 3 
                                  0 013 3v1"/>
                        </svg>
                        <span class="text-sm font-medium">Keluar</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:col-span-3">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Status Lamaran</h2>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            @foreach ([
                'total' => 'Total Lamaran', 
                'pending' => 'Pending', 
                'interview' => 'Interview', 
                'diterima' => 'Diterima', 
                'ditolak' => 'Ditolak'
            ] as $key => $label)
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <h4 class="text-sm text-gray-500">{{ $label }}</h4>
                    <p class="text-2xl font-bold text-blue-600">{{ $stats[$key] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Daftar Lamaran -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-blue-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Posisi</th>
                        <th class="px-4 py-3 text-left">Perusahaan</th>
                        <th class="px-4 py-3 text-left">Tanggal Lamar</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($applications as $app)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $app->lowongan->judul }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $app->lowongan->mitra->nama_perusahaan }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $app->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColor = match($app->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'interview' => 'bg-blue-100 text-blue-800',
                                        'diterima' => 'bg-green-100 text-green-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('alumni.applications.show', $app->id) }}" 
                                   class="text-blue-600 hover:underline">Detail</a>
                                @if ($app->status === 'pending')
                                    <form action="{{ route('alumni.applications.cancel', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Batalkan lamaran ini?')" 
                                                class="text-red-600 hover:underline">
                                            Batalkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">Belum ada lamaran yang dikirim.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
