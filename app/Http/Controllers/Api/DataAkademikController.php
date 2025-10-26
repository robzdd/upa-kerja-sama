<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataAkademik;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataAkademikController extends Controller
{
    /**
     * Display the authenticated user's academic data.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $alumni = $user->alumni;
            
            if (!$alumni) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alumni profile not found'
                ], 404);
            }

            $dataAkademik = $alumni->dataAkademik;

            return response()->json([
                'success' => true,
                'data' => $dataAkademik,
                'message' => 'Academic data retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve academic data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created academic data.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nim' => 'nullable|string|max:20',
                'program_studi' => 'nullable|string|max:100',
                'tahun_masuk' => 'nullable|integer|min:1950|max:' . date('Y'),
                'tahun_lulus' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
                'ipk' => 'nullable|numeric|min:0|max:4.00',
                'universitas' => 'nullable|string|max:200',
                'hard_skill' => 'nullable|string',
                'soft_skill' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();
            $alumni = $user->alumni;
            
            if (!$alumni) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alumni profile not found'
                ], 404);
            }
            
            // Check if academic data already exists
            if ($alumni->dataAkademik) {
                return response()->json([
                    'success' => false,
                    'message' => 'Academic data already exists. Use update method instead.'
                ], 400);
            }

            $dataAkademik = $alumni->dataAkademik()->create($request->all());

            return response()->json([
                'success' => true,
                'data' => $dataAkademik,
                'message' => 'Academic data created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create academic data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified academic data.
     */
    public function show(string $id)
    {
        try {
            $dataAkademik = DataAkademik::findOrFail($id);
            
            // Check if user owns this academic data
            if ($dataAkademik->alumni->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $dataAkademik,
                'message' => 'Academic data retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve academic data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified academic data.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nim' => 'nullable|string|max:20',
                'program_studi' => 'nullable|string|max:100',
                'tahun_masuk' => 'nullable|integer|min:1950|max:' . date('Y'),
                'tahun_lulus' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
                'ipk' => 'nullable|numeric|min:0|max:4.00',
                'universitas' => 'nullable|string|max:200',
                'hard_skill' => 'nullable|string',
                'soft_skill' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $dataAkademik = DataAkademik::findOrFail($id);
            
            // Check if user owns this academic data
            if ($dataAkademik->alumni->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            $dataAkademik->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $dataAkademik,
                'message' => 'Academic data updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update academic data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update or create academic data for authenticated user.
     */
    public function updateOrCreate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nim' => 'nullable|string|max:20',
                'program_studi' => 'nullable|string|max:100',
                'tahun_masuk' => 'nullable|integer|min:1950|max:' . date('Y'),
                'tahun_lulus' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
                'ipk' => 'nullable|numeric|min:0|max:4.00',
                'universitas' => 'nullable|string|max:200',
                'hard_skill' => 'nullable|string',
                'soft_skill' => 'nullable|string',
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
            $decoded = base64_decode($token);
            $parts = explode('|', $decoded);
            $userId = $parts[0] ?? null;
            $user = $userId ? \App\Models\User::find($userId) : null;
            if (!$user || !$user->hasRole('alumni')) {
                return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);
            }

            $alumni = $user->alumni;
            
            // Create alumni profile if not exists
            if (!$alumni) {
                $alumni = Alumni::create([
                    'user_id' => $user->id,
                ]);
            }

            $dataAkademik = $alumni->dataAkademik()->updateOrCreate(
                ['alumni_id' => $alumni->id],
                $request->all()
            );

            return response()->json([
                'success' => true,
                'data' => $dataAkademik,
                'message' => 'Academic data updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update academic data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified academic data.
     */
    public function destroy(string $id)
    {
        try {
            $dataAkademik = DataAkademik::findOrFail($id);
            
            // Check if user owns this academic data
            if ($dataAkademik->alumni->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            $dataAkademik->delete();

            return response()->json([
                'success' => true,
                'message' => 'Academic data deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete academic data: ' . $e->getMessage()
            ], 500);
        }
    }
}
