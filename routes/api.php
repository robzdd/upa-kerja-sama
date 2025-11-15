<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SavedJobController;
use App\Http\Controllers\Api\DataAkademikController;
use App\Http\Controllers\Api\DataKeluargaController;
use App\Http\Controllers\Api\DokumenPendukungController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes (tidak perlu authentication)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Job routes (public - bisa diakses tanpa login)
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{id}', [JobController::class, 'show']);
// Mitra-only jobs (by token user mapping)
Route::get('/mitra/jobs', [JobController::class, 'my']);
Route::post('/mitra/jobs', [JobController::class, 'store']);
Route::put('/mitra/jobs/{id}', [JobController::class, 'update']);
Route::delete('/mitra/jobs/{id}', [JobController::class, 'destroy']);
Route::put('/mitra/jobs/{id}/activate', [JobController::class, 'activate']);
Route::put('/mitra/jobs/{id}/status', [JobController::class, 'setStatus']);
Route::post('/mitra/jobs/{id}/archive', [JobController::class, 'archive']);
Route::post('/mitra/jobs/{id}/unarchive', [JobController::class, 'unarchive']);
// Applications
Route::post('/jobs/{id}/apply', [JobController::class, 'apply']);
Route::get('/applications/my', [JobController::class, 'myApplications']);
Route::put('/applications/{id}/status', [JobController::class, 'updateApplicationStatus']);
// Applicants per job (mitra)
Route::get('/mitra/jobs/{id}/applicants', [JobController::class, 'applicantsForJob']);
Route::get('/mitra/jobs/{id}/download-applicants', [JobController::class, 'downloadApplicants']);
Route::post('/mitra/applications/{id}/archive', [JobController::class, 'archiveApplication']);
Route::post('/mitra/applications/{id}/unarchive', [JobController::class, 'unarchiveApplication']);

// Saved jobs (alumni)
Route::get('/saved-jobs', [SavedJobController::class, 'index']);
Route::post('/jobs/{id}/save', [SavedJobController::class, 'store']);
Route::delete('/jobs/{id}/save', [SavedJobController::class, 'destroy']);

// Company routes (public - bisa diakses tanpa login)
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);

// Alumni profile (for mitra to view applicant details)
Route::get('/alumni/{userId}', [JobController::class, 'alumniProfile']);

// Protected routes (perlu authentication dengan token sederhana)
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);
// Upload CV PDF for alumni
Route::post('/alumni/cv', [AuthController::class, 'uploadAlumniCv']);
// Update company profile (mitra)
Route::put('/mitra/company', [CompanyController::class, 'updateMine']);
// Update alumni profile (basic)
Route::put('/alumni/profile', [AuthController::class, 'updateAlumni']);
// Update alumni detail profile (comprehensive)
Route::put('/alumni/profile/detail', [AuthController::class, 'updateAlumniDetail']);

// Academic Data routes
Route::get('/academic-data', [DataAkademikController::class, 'index']);
Route::post('/academic-data', [DataAkademikController::class, 'store']);
Route::get('/academic-data/{id}', [DataAkademikController::class, 'show']);
Route::put('/academic-data/{id}', [DataAkademikController::class, 'update']);
Route::put('/academic-data', [DataAkademikController::class, 'updateOrCreate']);
Route::delete('/academic-data/{id}', [DataAkademikController::class, 'destroy']);

// Family Data routes
Route::get('/family-data', [DataKeluargaController::class, 'index']);
Route::put('/family-data', [DataKeluargaController::class, 'updateOrCreate']);

// Supporting Documents routes
Route::get('/documents', [DokumenPendukungController::class, 'index']);
Route::post('/documents/upload', [DokumenPendukungController::class, 'upload']);
Route::delete('/documents/{id}', [DokumenPendukungController::class, 'destroy']);

