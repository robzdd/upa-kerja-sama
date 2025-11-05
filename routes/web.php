<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Mitra\MitraDashboardController;
use App\Http\Controllers\Mitra\Auth\MitraLoginController;
use App\Http\Controllers\Alumni\Auth\AlumniAuthController;
use App\Http\Controllers\Alumni\ProfileController;
use App\Http\Controllers\Alumni\CvController;
use App\Http\Controllers\Alumni\DocumentController;
use App\Http\Controllers\Alumni\AlumniAkademikController;
use App\Http\Controllers\Alumni\LamaranController;
use App\Http\Controllers\Alumni\ApplicationController;
use App\Http\Controllers\Mitra\PelamarController;

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

        // Riwayat Pendidikan Routes
        Route::post('/pendidikan', [ProfileController::class, 'storePendidikan'])->name('pendidikan.store');
        Route::get('/pendidikan/{id}/edit', [ProfileController::class, 'editPendidikan'])->name('pendidikan.edit');
        Route::delete('/pendidikan/{id}', [ProfileController::class, 'destroyPendidikan'])->name('pendidikan.destroy');

        // Pengalaman Kerja/Organisasi Routes
        Route::post('/pengalaman', [ProfileController::class, 'storePengalaman'])->name('pengalaman.store');
        Route::get('/pengalaman/{id}/edit', [ProfileController::class, 'editPengalaman'])->name('pengalaman.edit');
        Route::delete('/pengalaman/{id}', [ProfileController::class, 'destroyPengalaman'])->name('pengalaman.destroy');
        
        // Sertifikasi Routes
        Route::post('/sertifikasi', [ProfileController::class, 'storeSertifikasi'])->name('sertifikasi.store');
        Route::get('/sertifikasi/{id}/edit', [ProfileController::class, 'editSertifikasi'])->name('sertifikasi.edit');
        Route::delete('/sertifikasi/{id}', [ProfileController::class, 'destroySertifikasi'])->name('sertifikasi.destroy');

        // Lowongan Routes
        Route::get('/lowongan', [LamaranController::class, 'index'])->name('lowongan.index');
        Route::get('/lowongan/{id}/details', [LamaranController::class, 'details'])->name('lowongan.details');
        Route::get('/lowongan/{id}/apply', [LamaranController::class, 'showApplyForm'])->name('lowongan.apply');
        Route::post('/lowongan/{id}/apply', [LamaranController::class, 'apply'])->name('lowongan.apply.submit');
        
        // Applications Routes
        // Route::get('/applications', [LamaranController::class, 'myApplications'])->name('applications');
        // Route::delete('/applications/{id}/cancel', [LamaranController::class, 'cancelApplication'])->name('applications.cancel');
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications');
        Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');
        Route::delete('/applications/{id}/cancel', [ApplicationController::class, 'cancel'])->name('applications.cancel');
            
            
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

        Route::get('/debug-pelamar', [PelamarController::class, 'debug'])->name('mitra.pelamar.debug');

        // Lowongan
        Route::resource('lowongan', \App\Http\Controllers\Mitra\LowonganController::class);

        // ✅ Pelamar (pindahkan ke sini)
        Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
        Route::get('/pelamar/{id}', [PelamarController::class, 'show'])->name('pelamar.show');
        Route::post('/pelamar/{id}/status', [PelamarController::class, 'updateStatus'])->name('pelamar.update-status');
        Route::post('/pelamar/bulk-update', [PelamarController::class, 'bulkUpdateStatus'])->name('pelamar.bulkUpdateStatus');
        Route::post('/pelamar/bulk-update-status', [PelamarController::class, 'bulkUpdateStatus'])->name('pelamar.bulk-update-status');
    });
    
});
