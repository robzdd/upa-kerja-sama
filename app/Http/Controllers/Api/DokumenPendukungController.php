<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendukung;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenPendukungController extends Controller
{
    /**
     * Display the authenticated user's supporting documents.
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
                    'data' => [],
                    'message' => 'Alumni profile not found'
                ], 404);
            }

            $dokumenPendukung = $alumni->dokumenPendukung;

            // Format URLs for frontend
            $formattedData = $dokumenPendukung->map(function ($dokumen) {
                $dokumenArray = $dokumen->toArray();
                if ($dokumen->file_path) {
                    $dokumenArray['file_url'] = Storage::url($dokumen->file_path);
                }
                return $dokumenArray;
            });

            return response()->json([
                'success' => true,
                'data' => $formattedData,
                'message' => 'Supporting documents retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Documents retrieve error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve documents: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload a supporting document.
     */
    public function upload(Request $request)
    {
        try {
            Log::info('Document upload request received', [
                'has_file' => $request->hasFile('file'),
                'jenis_dokumen' => $request->input('jenis_dokumen'),
                'all_input' => $request->all()
            ]);

            $validator = Validator::make($request->all(), [
                'jenis_dokumen' => 'required|string|max:100',
                'file' => 'required|mimes:pdf|max:5120', // Max 5MB
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get user from token
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
            
            if (!$user->hasRole('alumni')) {
                return response()->json(['success' => false, 'message' => 'User tidak memiliki akses alumni'], 401);
            }

            // Get or create alumni profile
            $alumni = $user->alumni;
            
            Log::info('User alumni check', [
                'user_id' => $user->id,
                'has_alumni' => $alumni ? true : false,
                'alumni_id' => $alumni ? $alumni->id : null
            ]);
            
            if (!$alumni) {
                Log::info('Creating new alumni for user', ['user_id' => $user->id]);
                $alumni = Alumni::create([
                    'user_id' => $user->id,
                ]);
                Log::info('Alumni created', [
                    'alumni_id' => $alumni->id,
                    'user_id' => $alumni->user_id
                ]);
            }
            
            $alumni->refresh();

            // Upload file
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('dokumen_pendukung', $filename, 'public');

            Log::info('File uploaded successfully', [
                'filename' => $filename,
                'path' => $path,
                'size' => $file->getSize()
            ]);

            // Create or update document record
            $dokumenPendukung = DokumenPendukung::updateOrCreate(
                [
                    'alumni_id' => $alumni->id,
                    'jenis_dokumen' => $request->jenis_dokumen,
                ],
                [
                    // New columns
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'jenis_dokumen' => $request->jenis_dokumen,
                    
                    // Old columns (required)
                    'tipe_dokumen' => $request->jenis_dokumen,
                    'nama_dokumen' => $file->getClientOriginalName(),
                    'path_file' => $path,
                    'ukuran_file' => $file->getSize(),
                ]
            );

            Log::info('Document record created/updated', [
                'document_id' => $dokumenPendukung->id,
                'alumni_id' => $alumni->id,
                'jenis_dokumen' => $request->jenis_dokumen
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $dokumenPendukung->id,
                    'jenis_dokumen' => $dokumenPendukung->jenis_dokumen,
                    'file_name' => $dokumenPendukung->file_name,
                    'file_url' => Storage::url($path),
                ],
                'message' => 'Document uploaded successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Document upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload document: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a supporting document.
     */
    public function destroy(string $id)
    {
        try {
            $token = request()->bearerToken();
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
            if (!$user || !$user->hasRole('alumni')) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $dokumenPendukung = DokumenPendukung::find($id);
            
            if (!$dokumenPendukung || $dokumenPendukung->alumni->user_id !== $user->id) {
                return response()->json(['success' => false, 'message' => 'Document not found or unauthorized'], 404);
            }

            // Delete file
            if ($dokumenPendukung->file_path) {
                Storage::disk('public')->delete($dokumenPendukung->file_path);
            }

            $dokumenPendukung->delete();

            return response()->json([
                'success' => true,
                'message' => 'Document deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Document delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete document: ' . $e->getMessage()
            ], 500);
        }
    }
}

