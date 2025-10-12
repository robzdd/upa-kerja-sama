<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Mitra\MitraDashboardController;
use App\Http\Controllers\Mitra\Auth\MitraLoginController;
use App\Http\Controllers\Alumni\Auth\AlumniAuthController;
use App\Http\Controllers\Alumni\ProfileController;

// ====================
//  HALAMAN UMUM
// ====================
Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/artikel', fn() => view('alumni.artikel_page'))->name('artikel.page');
Route::get('/alumni/tentang_kami', fn() => view('alumni.tentang_kami'))->name('alumni.tentang_kami');

// ====================
//  LOGIN GOOGLE (UMUM)
// ====================
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// ====================
//  ALUMNI ROUTES
// ====================
Route::prefix('alumni')->name('alumni.')->group(function () {

    // ---------- AUTH ----------
    Route::controller(AlumniAuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
        Route::post('/logout', 'logout')->name('logout');
    });

    // ---------- HALAMAN PUBLIK ----------
    Route::get('/beranda', fn() => view('alumni.dashboard_alumni'))->name('beranda');
    Route::get('/cari_lowongan', [\App\Http\Controllers\Alumni\JobSearchController::class, 'index'])->name('cari_lowongan');
    Route::get('/lowongan/{id}/details', [\App\Http\Controllers\Alumni\JobSearchController::class, 'getJobDetails'])->name('lowongan.details');
    Route::get('/list_perusahaan', fn() => view('alumni.list_perusahaan'))->name('list_perusahaan');

    // ---------- HALAMAN LOGIN PROTECTED ----------
    Route::middleware(['auth', 'role:alumni'])->group(function () {
        Route::get('/dashboard', fn() => view('alumni.dashboard_alumni'))->name('dashboard');
        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/cv/download', [ProfileController::class, 'downloadCv'])->name('profile.cv.download');
        Route::get('/profile/cv/view', [ProfileController::class, 'viewCv'])->name('profile.cv.view');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// ====================
//  MITRA ROUTES
// ====================
Route::prefix('mitra')->name('mitra.')->group(function () {

    // ---------- AUTH ----------
    Route::controller(MitraLoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
        Route::post('/logout', 'logout')->name('logout');
    });

    // ---------- DASHBOARD ----------
    Route::middleware(['auth:mitra', 'role:mitra'])->group(function () {
        Route::get('/dashboard', [MitraDashboardController::class, 'index'])->name('dashboard');

        // Job Posting Routes
        Route::resource('lowongan', \App\Http\Controllers\Mitra\LowonganController::class);
    });
});
