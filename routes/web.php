<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alumni/login', function () {
    return view('alumni.alumni_login_page');
})->name('alumni.login');

Route::get('/alumni/dashboard', function () {
    return view('alumni.dasboard_alumni');
})->name('alumni.dashboard');

Route::get('/alumni/cari_lowongan', function () {
    return view('alumni.cari_lowongan');
})->name('alumni.cari_lowongan');

Route::get('/alumni/list_perusahaan', function () {
    return view('alumni.list_perusahaan');
})->name('alumni.list_perusahaan');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/artikel', function () {
    return view('alumni.artikel_page');
})->name('artikel.page');

Route::get('alumni/beranda', function () {
    return view('alumni.beranda_alumni');
})->name('alumni.beranda');

Route::get('/alumni/tentang_kami', function () {
    return view('alumni.tentang_kami');
})->name('alumni.tentang_kami');