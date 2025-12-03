<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alumni\CvController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\DokumenPublikController;
use App\Http\Controllers\Mitra\PelamarController;
use App\Http\Controllers\Alumni\CompanyController;
use App\Http\Controllers\Alumni\LamaranController;
use App\Http\Controllers\Alumni\ProfileController;
use App\Http\Controllers\Alumni\DocumentController;
use App\Http\Controllers\Alumni\JobSearchController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Alumni\ApplicationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Mitra\MitraDashboardController;
use App\Http\Controllers\Alumni\AlumniAkademikController;
use App\Http\Controllers\Mitra\Auth\MitraLoginController;
use App\Http\Controllers\Alumni\Auth\AlumniAuthController;

// ====================
//  HALAMAN UMUM
// ====================
Route::get('/', [\App\Http\Controllers\GuestController::class, 'index'])->name('home');

// CV Public Route
Route::get('/cv/{uri}', [CvController::class, 'publicCv'])->name('cv.public');

Route::get('/artikel', [\App\Http\Controllers\Alumni\AlumniArtikelController::class, 'index'])->name('artikel.page');
Route::get('/artikel/{slug}', [\App\Http\Controllers\Alumni\AlumniArtikelController::class, 'show'])->name('artikel.detail');
Route::get('/alumni/tentang_kami', [\App\Http\Controllers\GuestController::class, 'about'])->name('alumni.tentang_kami');

// Public Dokumen Routes
Route::get('/dokumen', [DokumenPublikController::class, 'index'])->name('dokumen.index');
Route::get('/dokumen/kategori/{id}', [DokumenPublikController::class, 'category'])->name('dokumen.category');
Route::get('/dokumen/{id}/download', [DokumenPublikController::class, 'download'])->name('dokumen.download');

// Public Access for Job Search & Companies
Route::get('/cari_lowongan', [JobSearchController::class, 'index'])->name('alumni.cari_lowongan');
Route::get('/lowongan/{id}/details', [JobSearchController::class, 'getJobDetails'])->name('lowongan.details');
Route::get('/list_perusahaan', [CompanyController::class, 'index'])->name('alumni.list_perusahaan');
Route::get('/perusahaan/{id}', [CompanyController::class, 'show'])->name('alumni.detail_perusahaan');

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
        Route::get('/register', 'showRegisterForm')->name('register'); // New Register Route
        Route::post('/register', 'register')->name('register.submit'); // Submit Register
        Route::post('/logout', 'logout')->name('logout');
        
        // Password Reset Routes
        Route::get('/password/reset', 'showForgotPasswordForm')->name('password.request');
        Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}', 'showResetPasswordForm')->name('password.reset');
        Route::post('/password/reset', 'resetPassword')->name('password.update');
    });

    // ---------- HALAMAN PUBLIK (Moved to Global) ----------
    Route::get('/beranda', function() {
        $mitra = \App\Models\MitraPerusahaan::whereNotNull('logo')->get();
        return view('alumni.dashboard_alumni', compact('mitra'));
    })->name('beranda');
    // Route::get('/cari_lowongan', [\App\Http\Controllers\Alumni\JobSearchController::class, 'index'])->name('cari_lowongan');
    // Route::get('/lowongan/{id}/details', [\App\Http\Controllers\Alumni\JobSearchController::class, 'getJobDetails'])->name('lowongan.details');
    // Route::get('/list_perusahaan', [\App\Http\Controllers\Alumni\CompanyController::class, 'index'])->name('list_perusahaan');
    // Route::get('/perusahaan/{id}', [\App\Http\Controllers\Alumni\CompanyController::class, 'show'])->name('detail_perusahaan');

    // ---------- HALAMAN LOGIN PROTECTED ----------
    Route::middleware(['auth', 'role:alumni'])->group(function () {
        Route::get('/dashboard', function() {
            $mitra = \App\Models\MitraPerusahaan::whereNotNull('logo')->get();
            return view('alumni.dashboard_alumni', compact('mitra'));
        })->name('dashboard');
        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/upload-photo', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.upload-photo');
        Route::delete('/profile/delete-photo', [ProfileController::class, 'deleteProfilePhoto'])->name('profile.delete-photo');
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
        Route::get('/lowongan/recommendations', [\App\Http\Controllers\Alumni\JobSearchController::class, 'getRecommendations'])->name('lowongan.recommendations');
        Route::get('/lowongan/tersimpan', [JobSearchController::class, 'savedJobs'])->name('lowongan.tersimpan');
        Route::get('/lowongan/{id}/details', [LamaranController::class, 'details'])->name('lowongan.details');
        Route::get('/lowongan/{id}', [LamaranController::class, 'show'])->name('lowongan.show');
        Route::get('/lowongan/{id}/apply', [LamaranController::class, 'showApplyForm'])->name('lowongan.apply');
        Route::post('/lowongan/{id}/apply', [LamaranController::class, 'apply'])->name('lowongan.apply.submit');
        Route::post('/job-recommendations', [JobSearchController::class, 'getRecommendations'])->name('job.recommendations');
        Route::post('/lowongan/{id}/save', [JobSearchController::class, 'toggleSave'])->name('lowongan.save');
        
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
            Route::get('/cv/download', 'downloadCv')->name('cv.download');
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
            Route::get('/settings', [\App\Http\Controllers\Alumni\AlumniSecurityController::class, 'settings'])->name('settings');
            Route::post('/update-password', [\App\Http\Controllers\Alumni\AlumniSecurityController::class, 'updatePassword'])->name('update-password');
            Route::post('/deactivate-account', [\App\Http\Controllers\Alumni\AlumniSecurityController::class, 'deactivateAccount'])->name('deactivate-account');
            Route::post('/delete-account', [\App\Http\Controllers\Alumni\AlumniSecurityController::class, 'deleteAccount'])->name('delete-account');
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
        
        // Password Reset Routes
        Route::get('/password/reset', 'showForgotPasswordForm')->name('password.request');
        Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}', 'showResetPasswordForm')->name('password.reset');
        Route::post('/password/reset', 'resetPassword')->name('password.update');
    });

    // ---------- REGISTRATION ----------
    Route::get('/register', [\App\Http\Controllers\Mitra\Auth\MitraRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Mitra\Auth\MitraRegisterController::class, 'register'])->name('register.submit');

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

        // Profile & Settings
        Route::controller(\App\Http\Controllers\Mitra\MitraProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('profile.index');
            Route::put('/profile', 'update')->name('profile.update');
            Route::put('/profile/account', 'updateAccount')->name('profile.update-account');
            Route::put('/profile/password', 'updatePassword')->name('profile.update-password');
            Route::get('/settings', 'settings')->name('settings.index');
            Route::put('/settings/password', 'updatePassword')->name('settings.password');
        });

        // Notifications
        Route::post('/notifications/mark-as-read', [\App\Http\Controllers\Mitra\MitraNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    });
    
});

// ====================
//  ADMIN ROUTES
// ====================
Route::prefix('admin')->name('admin.')->group(function () {

    // ---------- AUTH ----------
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
        Route::post('/logout', 'logout')->name('logout');
    });

    // ---------- DASHBOARD ----------
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/search', [AdminDashboardController::class, 'search'])->name('search');

        // Profile Routes
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');

        // User Management Routes
        Route::resource('users', UserManagementController::class);

        // Program Studi Routes
        Route::resource('program-studi', ProgramStudiController::class);

        // Artikel Routes
        Route::resource('artikel', ArtikelController::class);

        // Kategori Dokumen Routes
        Route::resource('kategori-dokumen', \App\Http\Controllers\Admin\KategoriDokumenController::class);

        // Dokumen Publik Routes
        Route::resource('dokumen-publik', \App\Http\Controllers\Admin\DokumenPublikController::class);
        Route::get('dokumen-publik/{id}/download', [\App\Http\Controllers\Admin\DokumenPublikController::class, 'download'])->name('dokumen-publik.download');

        // Mitra Registration Requests Routes
        Route::get('mitra-requests', [\App\Http\Controllers\Admin\MitraRequestController::class, 'index'])->name('mitra-requests.index');
        Route::get('mitra-requests/{id}', [\App\Http\Controllers\Admin\MitraRequestController::class, 'show'])->name('mitra-requests.show');
        Route::post('mitra-requests/{id}/approve', [\App\Http\Controllers\Admin\MitraRequestController::class, 'approve'])->name('mitra-requests.approve');
        Route::post('mitra-requests/{id}/reject', [\App\Http\Controllers\Admin\MitraRequestController::class, 'reject'])->name('mitra-requests.reject');

        // Reports Routes
        Route::resource('reports', ReportController::class);
    });
});
