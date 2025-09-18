@extends('layouts.auth')

@section('title','Beranda - UPA Kerjasama POLINDRA')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Beranda</h1>
            <span class="inline-flex items-center rounded-full bg-indigo-50 text-indigo-700 px-3 py-1 text-sm font-semibold">Role: {{ ucfirst($role) }}</span>
        </div>

        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold">Status</h2>
                <p class="mt-2 text-gray-600">Anda berhasil masuk sebagai {{ $role }}.</p>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="text-lg font-semibold">Selanjutnya</h2>
                <ul class="mt-2 list-disc pl-5 text-gray-600">
                    <li>Ini halaman placeholder tanpa backend.</li>
                    <li>Nantinya arahkan sesuai dashboard tiap role.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection


