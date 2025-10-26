<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataKeluarga;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DataKeluargaController extends Controller
{
    /**
     * Display the authenticated user's family data.
     */
    public function index(Request $request)
    {
        try {
            // Get user from token (same as AuthController)
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
            }
            
            try {
                $decoded = base64_decode($token);
                $parts = explode('|', $decoded);
                $userId = $parts[0] ?? null;
            } catch (\Exception $e) {
                Log::error('Token decode error: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Token tidak valid'], 401);
            }
            
            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'User ID tidak ditemukan dalam token'], 401);
            }
            
            $user = \App\Models\User::find($userId);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 401);
            }
            
            $alumni = $user->alumni;
            
            if (!$alumni) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Alumni profile not found'
                ], 404);
            }

            $dataKeluarga = $alumni->dataKeluarga;

            return response()->json([
                'success' => true,
                'data' => $dataKeluarga,
                'message' => 'Family data retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Family data retrieve error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve family data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update or create family data for authenticated user.
     */
    public function updateOrCreate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_ayah' => 'nullable|string|max:100',
                'pekerjaan_ayah' => 'nullable|string|max:100',
                'nama_ibu' => 'nullable|string|max:100',
                'pekerjaan_ibu' => 'nullable|string|max:100',
                'nama_wali' => 'nullable|string|max:100',
                'pekerjaan_wali' => 'nullable|string|max:100',
                'alamat_keluarga' => 'nullable|string',
                'jumlah_saudara' => 'nullable|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get user from token (same as AuthController)
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
            }
            
            try {
                $decoded = base64_decode($token);
                $parts = explode('|', $decoded);
                $userId = $parts[0] ?? null;
            } catch (\Exception $e) {
                Log::error('Token decode error: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Token tidak valid'], 401);
            }
            
            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'User ID tidak ditemukan dalam token'], 401);
            }
            
            $user = \App\Models\User::find($userId);
            if (!$user) {
                Log::error("User not found for ID: " . $userId);
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 401);
            }
            
            if (!$user->hasRole('alumni')) {
                return response()->json(['success' => false, 'message' => 'User tidak memiliki akses alumni'], 401);
            }

            // Get or create alumni profile
            $alumni = $user->alumni;
            
            if (!$alumni) {
                Log::info("Creating alumni record for user: " . $userId);
                try {
                    $alumni = Alumni::create([
                        'user_id' => $user->id,
                    ]);
                    Log::info("Alumni created with ID: " . $alumni->id);
                    
                    // Verify it was actually saved to the database
                    $savedAlumni = Alumni::find($alumni->id);
                    if (!$savedAlumni) {
                        Log::error("Alumni record was not saved to database. ID: " . $alumni->id);
                        return response()->json(['success' => false, 'message' => 'Gagal menyimpan profil alumni ke database'], 500);
                    }
                } catch (\Exception $e) {
                    Log::error("Error creating alumni: " . $e->getMessage());
                    Log::error($e->getTraceAsString());
                    return response()->json(['success' => false, 'message' => 'Gagal membuat profil alumni: ' . $e->getMessage()], 500);
                }
            }
            
            // Refresh alumni to ensure we have the latest data
            $alumni->refresh();
            
            // Verify alumni exists in database
            $dbAlumni = Alumni::find($alumni->id);
            if (!$dbAlumni) {
                Log::error("Alumni with ID {$alumni->id} does not exist in database");
                return response()->json(['success' => false, 'message' => 'Profil alumni tidak ditemukan di database'], 404);
            }
            
            Log::info("Updating family data for alumni: " . $alumni->id);

            // Clean the request data to remove null and empty values
            $cleanData = array_filter($request->all(), function($value) {
                return $value !== null && $value !== '';
            });

            // Remove alumni_id from cleanData to avoid conflicts
            unset($cleanData['alumni_id']);

            // Temporarily disable foreign key checks if MyISAM table issue
            try {
                $dataKeluarga = $alumni->dataKeluarga()->updateOrCreate(
                    ['alumni_id' => $alumni->id],
                    $cleanData
                );
            } catch (\Exception $e) {
                // If foreign key fails due to MyISAM, try with FK checks off
                if (str_contains($e->getMessage(), 'foreign key constraint')) {
                    Log::warning("FK constraint failed, retrying with FK checks disabled");
                    DB::statement("SET FOREIGN_KEY_CHECKS = 0");
                    $dataKeluarga = $alumni->dataKeluarga()->updateOrCreate(
                        ['alumni_id' => $alumni->id],
                        $cleanData
                    );
                    DB::statement("SET FOREIGN_KEY_CHECKS = 1");
                } else {
                    Log::error("Error during updateOrCreate: " . $e->getMessage());
                    Log::error("Alumni ID being used: " . $alumni->id);
                    throw $e;
                }
            }

            return response()->json([
                'success' => true,
                'data' => $dataKeluarga,
                'message' => 'Family data updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Family data update error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update family data: ' . $e->getMessage()
            ], 500);
        }
    }
}

