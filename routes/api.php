<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\CompanyController;

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
Route::delete('/mitra/jobs/{id}', [JobController::class, 'destroy']);
Route::put('/mitra/jobs/{id}/status', [JobController::class, 'setStatus']);

// Company routes (public - bisa diakses tanpa login)
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);

// Protected routes (perlu authentication dengan token sederhana)
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);
// Update company profile (mitra)
Route::put('/mitra/company', [CompanyController::class, 'updateMine']);
// Update alumni profile
Route::put('/alumni/profile', [AuthController::class, 'updateAlumni']);
