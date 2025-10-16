<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login untuk mobile app
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Normalisasi email agar tidak sensitif terhadap spasi/kasus huruf
        $normalizedEmail = strtolower(trim($credentials['email']));

        // Cari user lalu verifikasi password manual (hindari ketergantungan session)
        $user = User::whereRaw('LOWER(email) = ?', [$normalizedEmail])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            
            // Generate token sederhana untuk testing (tanpa Sanctum dulu)
            $token = base64_encode($user->id . '|' . time() . '|' . rand(1000, 9999));
            
            // Tentukan role untuk response
            $role = null;
            if ($user->hasRole('alumni')) {
                $role = 'alumni';
            } elseif ($user->hasRole('mitra')) {
                $role = 'mitra';
            } elseif ($user->hasRole('admin')) {
                $role = 'admin';
            }

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $role,
                    ],
                ],
            ]);
        }

        // Jika gagal login, beri pesan yang sedikit lebih informatif untuk debugging
        return response()->json([
            'success' => false,
            'message' => $user ? 'Email atau password salah' : 'Akun tidak ditemukan',
        ], 401);
    }

    /**
     * Logout untuk mobile app
     */
    public function logout(Request $request)
    {
        // Untuk sementara, logout sederhana tanpa Sanctum
        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    /**
     * Get user profile
     */
    public function profile(Request $request)
    {
        // Untuk sementara, ambil user dari token sederhana
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Token tidak ditemukan'], 401);
        }
        
        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        $userId = $parts[0];
        
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }
        
        // Ambil data profil berdasarkan role
        $profileData = null;
        $role = null;
        
        if ($user->hasRole('alumni')) {
            // include academic relation for mobile prefill
            $alumni = $user->alumni()->with('dataAkademik')->first();
            $profileArray = $alumni ? $alumni->toArray() : null;
            if ($alumni && $alumni->dataAkademik) {
                $profileArray['program_studi'] = $alumni->dataAkademik->program_studi;
                $profileArray['angkatan'] = $alumni->dataAkademik->tahun_masuk;
            }
            if ($alumni && $alumni->file_cv) {
                $profileArray['cv_url'] = url('storage/' . $alumni->file_cv);
            }
            $profileData = $profileArray;
            $role = 'alumni';
        } elseif ($user->hasRole('mitra')) {
            $profileData = $user->mitraPerusahaan;
            $role = 'mitra';
        } elseif ($user->hasRole('admin')) {
            $profileData = $user->admin;
            $role = 'admin';
        }

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => [$role],
                ],
                'profile' => $profileData,
            ],
        ]);
    }

    /**
     * Update alumni profile (basic mobile endpoint)
     */
    public function updateAlumni(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        }
        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        $userId = $parts[0] ?? null;
        $user = $userId ? User::find($userId) : null;
        if (!$user || !$user->hasRole('alumni')) {
            return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'nim' => 'nullable|string|max:20',
            'program_studi' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:10',
        ]);

        if (isset($validated['name'])) {
            $user->name = $validated['name'];
            $user->save();
        }

        // Ensure alumni relation exists
        $alumni = $user->alumni;
        if (!$alumni) {
            $alumni = $user->alumni()->create([]);
        }
        $alumni->no_hp = $validated['no_hp'] ?? $alumni->no_hp;
        if (isset($validated['nim'])) {
            $alumni->nim = $validated['nim'];
        }
        $alumni->alamat = $validated['alamat'] ?? $alumni->alamat;
        // Save simple academic fields if exist
        if (method_exists($alumni, 'dataAkademik')) {
            $alumni->dataAkademik()->updateOrCreate(
                ['alumni_id' => $alumni->id],
                [
                    'nim' => $validated['nim'] ?? null,
                    'program_studi' => $validated['program_studi'] ?? null,
                    'tahun_masuk' => $validated['angkatan'] ?? null,
                ]
            );
        }
        $alumni->save();

        // Refresh with academic data
        $alumni = $user->alumni()->with('dataAkademik')->first();
        $profileArray = $alumni ? $alumni->toArray() : null;
        if ($alumni && $alumni->dataAkademik) {
            $profileArray['program_studi'] = $alumni->dataAkademik->program_studi;
            $profileArray['angkatan'] = $alumni->dataAkademik->tahun_masuk;
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil alumni berhasil diperbarui',
            'data' => [
                'user' => $user,
                'alumni' => $profileArray,
            ],
        ]);
    }

    /**
     * Upload CV (PDF only) for alumni
     */
    public function uploadAlumniCv(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        }
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        $user = $userId ? User::find($userId) : null;
        if (!$user || !$user->hasRole('alumni')) {
            return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);
        }

        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        // Ensure alumni row exists
        $alumni = $user->alumni ?: $user->alumni()->create([]);

        // Store file to public storage
        $path = $request->file('cv')->store('cv-alumni', 'public');

        // Update alumni
        $alumni->file_cv = $path;
        $alumni->cv_updated_at = now();
        $alumni->save();

        return response()->json([
            'success' => true,
            'message' => 'CV berhasil diunggah',
            'data' => [
                'cv_path' => $path,
                'cv_url' => url('storage/'.$path),
            ],
        ]);
    }

    /**
     * Register untuk alumni (jika diperlukan)
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nim' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:15',
        ]);

        // Buat user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign role alumni
        $user->assignRole('alumni');

        // Buat profil alumni jika ada data tambahan
        if ($validated['nim'] || $validated['no_hp']) {
            $user->alumni()->create([
                'nim' => $validated['nim'],
                'no_hp' => $validated['no_hp'],
            ]);
        }

        // Generate token
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->getRoleNames(),
                ],
                'profile' => $user->alumni,
                'token' => $token,
            ]
        ], 201);
    }
}
