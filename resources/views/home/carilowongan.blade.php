@extends('layouts.auth')

@section('title','Cari Lowongan - UPA Kerjasama POLINDRA')

@section('content')
<div class="min-h-screen bg-gray-50">
    <header class="relative text-white">
        @php
            $banner = null;
            if (file_exists(public_path('images/hiring-banner.jpg'))) {
                $banner = asset('images/hiring-banner.jpg');
            } elseif (file_exists(public_path('images/hiring-banner.png'))) {
                $banner = asset('images/hiring-banner.png');
            }
        @endphp
        <div class="absolute inset-0 pointer-events-none" style="background-image: linear-gradient(90deg, rgba(34,66,87,0.85), rgba(51,83,118,0.85), rgba(70,72,118,0.80), rgba(78,67,118,0.85));"></div>
        @if($banner)
            <div class="absolute inset-0 z-0">
                <div class="h-full w-full bg-center bg-cover" style="background-image:url('{{ $banner }}');"></div>
            </div>
        @endif
        <div class="absolute inset-0 z-10 pointer-events-none" style="background-image: linear-gradient(90deg, rgba(34,66,87,0.85), rgba(51,83,118,0.85), rgba(70,72,118,0.80), rgba(78,67,118,0.85));"></div>
        <div class="relative w-full px-6 py-4 z-20">
            @php
                $polindraLogo = null;
                if (file_exists(public_path('images/polindra-logo.svg'))) {
                    $polindraLogo = asset('images/polindra-logo.svg');
                } elseif (file_exists(public_path('images/polindra-logo.png'))) {
                    $polindraLogo = asset('images/polindra-logo.png');
                }
            @endphp
            <div class="grid grid-cols-[auto_1fr_auto] items-center">
                <div class="flex items-center gap-6">
                    @if($polindraLogo)
                        <img src="{{ $polindraLogo }}" class="h-8 w-8 object-contain" alt="POLINDRA"/>
                    @else
                        <div class="h-8 w-8 rounded-full bg-white/30"></div>
                    @endif
                    <nav class="flex items-center justify-center text-sm font-semibold mx-auto">
                        <a class="hover:text-white/90 opacity-90 mx-5" href="#">Beranda</a>
                        <a class="hover:text-white/90 opacity-90 mx-5" href="#">Artikel</a>
                        <a class="text-white relative mx-5" href="#">
                            Pekerjaan
                            <span class="absolute -bottom-1 left-0 right-0 mx-auto h-0.5 bg-white rounded"></span>
                        </a>
                        <a class="hover:text-white/90 opacity-90 mx-5" href="#">Tentang Kami</a>
                    </nav>
                </div>
                <div class="flex items-center gap-3 justify-end">
                    <button class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/20 hover:bg-white/25 transition">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a6 6 0 00-6 6v3.28l-.95 1.9A1 1 0 006 15h12a1 1 0 00.9-1.45l-.9-1.8V8a6 6 0 00-6-6zm0 20a3 3 0 003-3H9a3 3 0 003 3z"/></svg>
                    </button>
                    <button class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/80 text-gray-900 font-semibold">A</button>
                </div>
            </div>

            <h1 class="mt-6 text-2xl md:text-3xl font-extrabold">Temukan pekerjaan impianmu</h1>

            <div class="mt-5 rounded-2xl bg-white/95 backdrop-blur p-4 shadow-md">
                <div class="flex flex-nowrap items-stretch gap-3 overflow-x-auto">
                    <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-48 md:w-auto flex-1 min-w-[11rem]">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12A6 6 0 0110 4z"/></svg>
                        <input class="w-full outline-none text-sm" placeholder="Posisi"/>
                    </div>
                    <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-48 md:w-auto flex-1 min-w-[11rem]">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M3 7a2 2 0 012-2h14a2 2 0 012 2v12H3V7zm2-4h14v2H5V3z"/></svg>
                        <input class="w-full outline-none text-sm" placeholder="Perusahaan"/>
                    </div>
                    <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-48 md:w-auto flex-1 min-w-[11rem]">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 7 7 13 7 13s7-6 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
                        <input class="w-full outline-none text-sm" placeholder="Lokasi"/>
                    </div>
                    <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-48 md:w-auto flex-1 min-w-[11rem]">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16v2H4V4zm0 6h16v2H4v-2zm0 6h10v2H4v-2z"/></svg>
                        <input class="w-full outline-none text-sm" placeholder="Jurusan"/>
                    </div>
                    <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-56 md:w-auto flex-1 min-w-[12rem]">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l9 4.5v3c0 5-3.8 9.7-9 11-5.2-1.3-9-6-9-11v-3L12 2z"/></svg>
                        <input class="w-full outline-none text-sm" placeholder="Jenjang Pendidikan"/>
                    </div>
                    <div class="flex items-center justify-end gap-2 shrink-0">
                        <button class="rounded-xl px-4 py-2 text-sm font-semibold text-gray-700 border border-gray-300 bg-white">Clear</button>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2z"/></svg>
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="mt-6 grid md:grid-cols-3 gap-6">
            <div class="md:col-span-1 space-y-4">
                @php
                    $companies = [
                        ['name' => 'PT. Mencari Cinta Sejati tbk', 'logo' => 'images/company-1.png'],
                        ['name' => 'PT. Hatiku Tertambat', 'logo' => 'images/company-2.png'],
                        ['name' => 'PT. Koding Bersama', 'logo' => 'images/company-3.png'],
                        ['name' => 'PT. Nusantara Tech', 'logo' => 'images/company-4.png'],
                        ['name' => 'PT. Bumi Inovasi', 'logo' => 'images/company-5.png'],
                    ];
                @endphp
                @foreach ($companies as $company)
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm cursor-pointer hover:border-indigo-300">
                    <div class="flex items-start gap-3">
                        @php $logoPath = public_path($company['logo']); @endphp
                        @if (file_exists($logoPath))
                            <img src="{{ asset($company['logo']) }}" alt="{{ $company['name'] }}" class="h-12 w-12 rounded-full object-cover"/>
                        @else
                            @php
                                $parts = preg_split('/\s+/', $company['name']);
                                $first = isset($parts[0]) ? substr($parts[0], 0, 1) : '';
                                $second = isset($parts[1]) ? substr($parts[1], 0, 1) : '';
                                $initials = strtoupper($first.$second);
                            @endphp
                            <div class="h-12 w-12 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center font-semibold uppercase">
                                {{ $initials }}
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold">UI/UX DESIGNER</p>
                            <p class="text-sm text-gray-600 truncate">{{ $company['name'] }}</p>
                            <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                <span class="inline-flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-gray-400"></span>Penutupan: 20 September 2025</span>
                                <span class="inline-flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-indigo-400"></span>Diupdate 3 hari yang lalu</span>
                            </div>
                        </div>
                        <div class="text-xs text-gray-400">Save job</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="md:col-span-2">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4">
                            <div class="h-16 w-16 rounded-full bg-gray-200"></div>
                            <div>
                                <h2 class="text-xl font-bold">UI/UX DESIGNER</h2>
                                <p class="text-gray-600">PT. Mencari Cinta Sejati</p>
                            </div>
                        </div>
                        <div>
                            <span class="rounded-full bg-indigo-50 text-indigo-700 px-3 py-1 text-sm font-semibold">Part-Time</span>
                            <p class="mt-1 text-xs text-gray-500 text-right">1 Posisi - 300 Pelamar</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-semibold">Daftar Sekarang</button>
                    </div>

                    <div class="mt-6">
                        <button class="rounded-full border border-gray-300 px-3 py-1 text-sm">Deskripsi Lowongan</button>
                    </div>

                    <div class="mt-6 space-y-6">
                        <section>
                            <h3 class="font-semibold">Pendidikan</h3>
                            <p class="text-sm text-gray-600 mt-1">Jenjang Pendidikan: S1, D4</p>
                            <p class="text-sm text-gray-600">Jurusan: Teknik Informatika, Teknik Rekayasa Agama</p>
                        </section>

                        <section class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold">Persyaratan Dokumen</h3>
                                <ul class="mt-1 text-sm text-gray-600 list-disc pl-5">
                                    <li>Portfolio</li>
                                    <li>Sertifikat</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold invisible">.</h3>
                                <ul class="mt-1 text-sm text-gray-600 list-disc pl-5">
                                    <li>Portfolio</li>
                                    <li>Sertifikat</li>
                                </ul>
                            </div>
                        </section>

                        <section>
                            <h3 class="font-semibold">Tanggal Penting</h3>
                            <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <span>Penutupan lamaran</span>
                                    <span class="font-medium">20 Januari 2025</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <span>Pengumuman seleksi</span>
                                    <span class="font-medium">20 Oktober 2025</span>
                                </div>
                            </div>
                        </section>

                        <section>
                            <h3 class="font-semibold">Rincian Lowongan</h3>
                            <p class="mt-2 text-sm text-gray-600 leading-6">Lorem ipsum dolor sit amet consectetur. Leo massa vestibulum neque placerat rhoncus et ut tincidunt vitae. Euismod tempus scelerisque nisi congue enim. A pretium odio nulla sit neque sed nulla elementum. Morbi eu cursus netus vel ullamcorper iaculis. Lectus non id eget neque dolor egestas.</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


