<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Mitra\MitraDashboardController;
use App\Http\Controllers\Mitra\Auth\MitraLoginController;
use App\Http\Controllers\Alumni\Auth\AlumniAuthController;
use App\Http\Controllers\Alumni\ProfileController;
use App\Http\Controllers\Alumni\CvController;
use App\Http\Controllers\Alumni\DocumentController;

// ====================
//  HALAMAN UMUM
// ====================
Route::get('/', fn() => view('welcome'))->name('home');

// CV Public Route
Route::get('/cv/{uri}', [CvController::class, 'publicCv'])->name('cv.public');

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

        // CV Routes
        Route::controller(CvController::class)->group(function () {
            Route::get('/cv', 'index')->name('cv.index');
            Route::post('/cv/generate', 'generateCv')->name('cv.generate');
            Route::get('/cv/preview', 'previewCv')->name('cv.preview');
            Route::post('/cv/toggle-public', 'togglePublic')->name('cv.toggle-public');
            Route::post('/cv/data', 'storeCvData')->name('cv.data.store');
            Route::put('/cv/data/{id}', 'updateCvData')->name('cv.data.update');
            Route::delete('/cv/data/{id}', 'destroyCvData')->name('cv.data.destroy');
        });

        // Document Routes
        Route::controller(DocumentController::class)->group(function () {
            Route::get('/documents', 'index')->name('documents.index');
            Route::post('/documents/upload', 'upload')->name('documents.upload');
            Route::get('/documents/{id}/download', 'download')->name('documents.download');
            Route::get('/documents/{id}/view', 'view')->name('documents.view');
            Route::delete('/documents/{id}', 'delete')->name('documents.delete');
        });

        // Security Routes
        Route::prefix('security')->name('security.')->group(function () {
            Route::get('/settings', function() {
                $user = auth()->user();
                return view('alumni.pengaturan_keamanan', compact('user'));
            })->name('settings');
            Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
            Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
            Route::delete('/delete-account', [ProfileController::class, 'deleteAccount'])->name('delete-account');
            Route::post('/deactivate-account', [ProfileController::class, 'deactivateAccount'])->name('deactivate-account');
        });

        // Application Status Routes
        Route::get('/applications', fn() => view('alumni.status_lamaran'))->name('applications');

        // Certificate Routes
        Route::get('/certificates', fn() => view('alumni.sertifikat_magang'))->name('certificates');
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
