<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\DataAkademik;

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
                        'id' => (string)$user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $role ? [$role] : [],
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
            // Load alumni with all relations
            $alumni = $user->alumni()->with('dataAkademik', 'dataKeluarga', 'dokumenPendukung')->first();
            
            // Create alumni profile if it doesn't exist
            if (!$alumni) {
                $alumni = $user->alumni()->create([]);
                // Reload with relations
                $alumni = $user->alumni()->with('dataAkademik', 'dataKeluarga', 'dokumenPendukung')->first();
            }
            
            // Build profile array manually to ensure all fields are included
            $profileArray = null;
            $cvUrl = null;
            
            if ($alumni) {
                $profileArray = [
                    'id' => $alumni->id,
                    'user_id' => $alumni->user_id,
                    'nim' => $alumni->nim,
                    'nik' => $alumni->nik,
                    'no_hp' => $alumni->no_hp,
                    'tempat_lahir' => $alumni->tempat_lahir,
                    'tanggal_lahir' => $alumni->tanggal_lahir ? $alumni->tanggal_lahir->format('Y-m-d') : null,
                    'jenis_kelamin' => $alumni->jenis_kelamin,
                    'alamat' => $alumni->alamat,
                    'kota' => $alumni->kota,
                    'provinsi' => $alumni->provinsi,
                    'kode_pos' => $alumni->kode_pos,
                    'tentang_saya' => $alumni->tentang_saya,
                    'nama_bank' => $alumni->nama_bank,
                    'no_rekening' => $alumni->no_rekening,
                    'file_cv' => $alumni->file_cv,
                    'foto_profil' => $alumni->foto_profil,
                    'created_at' => $alumni->created_at,
                    'updated_at' => $alumni->updated_at,
                ];
                
                // Add CV URL if exists
                if ($alumni->file_cv) {
                    $cvUrl = url('storage/' . $alumni->file_cv);
                    $profileArray['cv_url'] = $cvUrl;
                }
                
                // Add foto profil URL if exists
                if ($alumni->foto_profil) {
                    $profileArray['foto_profil_url'] = url('storage/' . $alumni->foto_profil);
                }
            }
            
            // Get supporting documents - always return array, even if empty
            $dokumenPendukung = [];
            if ($alumni && $alumni->dokumenPendukung && $alumni->dokumenPendukung->count() > 0) {
                $dokumenPendukung = $alumni->dokumenPendukung->map(function($doc) {
                    $docArray = $doc->toArray();
                    if ($doc->file_path) {
                        $docArray['file_url'] = url('storage/' . $doc->file_path);
                    }
                    return $docArray;
                })->toArray();
            }
            
            // Ensure data_akademik and data_keluarga are arrays, not null
            $dataAkademik = null;
            if ($alumni && $alumni->dataAkademik) {
                $dataAkademik = $alumni->dataAkademik->toArray();
            }
            
            $dataKeluarga = null;
            if ($alumni && $alumni->dataKeluarga) {
                $dataKeluarga = $alumni->dataKeluarga->toArray();
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => (string)$user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => ['alumni'],
                    ],
                    'profile' => $profileArray,
                    'alumni' => $profileArray, // Also include as 'alumni' for backward compatibility
                    'cv_url' => $cvUrl,
                    'data_akademik' => $dataAkademik,
                    'data_keluarga' => $dataKeluarga,
                    'dokumen_pendukung' => $dokumenPendukung, // Always array, never null
                ],
            ]);
        } elseif ($user->hasRole('mitra')) {
            $profileData = $user->mitraPerusahaan;
            $role = 'mitra';
            
            // Add logo_url to profile if logo exists
            $profileArray = null;
            if ($profileData) {
                $profileArray = $profileData->toArray();
                if ($profileData->logo) {
                    $profileArray['logo_url'] = url('storage/' . $profileData->logo);
                }
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => (string)$user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $role ? [$role] : [],
                    ],
                    'profile' => $profileArray,
                ],
            ]);
        } elseif ($user->hasRole('admin')) {
            $profileData = $user->admin;
            $role = 'admin';
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => (string)$user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $role ? [$role] : [],
                    ],
                    'profile' => $profileData,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Role tidak dikenali',
        ], 400);
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
        $alumni->save();

        // Save academic fields
        DataAkademik::updateOrCreate(
            ['alumni_id' => $alumni->id],
            [
                'nim' => $validated['nim'] ?? $alumni->nim,
                'program_studi' => $validated['program_studi'] ?? null,
                'tahun_masuk' => $validated['angkatan'] ?? null,
            ]
        );

        // Refresh with academic data
        $alumni = $user->alumni()->with('dataAkademik')->first();
        
        // Build profile array manually to ensure all fields are included
        $profileArray = null;
        if ($alumni) {
            $profileArray = [
                'id' => $alumni->id,
                'user_id' => $alumni->user_id,
                'nim' => $alumni->nim,
                'nik' => $alumni->nik,
                'no_hp' => $alumni->no_hp,
                'tempat_lahir' => $alumni->tempat_lahir,
                'tanggal_lahir' => $alumni->tanggal_lahir ? $alumni->tanggal_lahir->format('Y-m-d') : null,
                'jenis_kelamin' => $alumni->jenis_kelamin,
                'alamat' => $alumni->alamat,
                'kota' => $alumni->kota,
                'provinsi' => $alumni->provinsi,
                'kode_pos' => $alumni->kode_pos,
                'tentang_saya' => $alumni->tentang_saya,
                'nama_bank' => $alumni->nama_bank,
                'no_rekening' => $alumni->no_rekening,
                'file_cv' => $alumni->file_cv,
                'created_at' => $alumni->created_at,
                'updated_at' => $alumni->updated_at,
            ];
            
            if ($alumni->dataAkademik) {
                $profileArray['program_studi'] = $alumni->dataAkademik->program_studi;
                $profileArray['angkatan'] = $alumni->dataAkademik->tahun_masuk;
            }
            if ($alumni->file_cv) {
                $profileArray['cv_url'] = url('storage/' . $alumni->file_cv);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil alumni berhasil diperbarui',
            'data' => [
                'user' => $user,
                'profile' => $profileArray,
            ],
        ]);
    }

    /**
     * Update alumni detail profile (comprehensive fields)
     */
    public function updateAlumniDetail(Request $request)
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
            'nik' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'nama_bank' => 'nullable|string|max:255',
            'no_rekening' => 'nullable|string|max:20',
            'tentang_saya' => 'nullable|string|max:1000',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Update user
        if (isset($validated['name'])) $user->name = $validated['name'];
        if (isset($validated['email'])) $user->email = $validated['email'];
        $user->save();

        // Ensure alumni relation exists
        $alumni = $user->alumni;
        if (!$alumni) {
            $alumni = $user->alumni()->create([]);
        }

        // Handle foto profil upload if provided
        if ($request->hasFile('foto_profil')) {
            // Delete old foto if exists
            if ($alumni->foto_profil && Storage::disk('public')->exists($alumni->foto_profil)) {
                Storage::disk('public')->delete($alumni->foto_profil);
            }
            
            // Store new foto profil
            $fotoPath = $request->file('foto_profil')->store('foto-profil-alumni', 'public');
            $alumni->foto_profil = $fotoPath;
            $alumni->save(); // Save immediately if foto uploaded
        }

        // Update alumni fields
        foreach (['nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'no_hp', 'alamat', 'nama_bank', 'no_rekening', 'tentang_saya'] as $field) {
            if (isset($validated[$field])) {
                $alumni->$field = $validated[$field];
            }
        }
        $alumni->save();

        // Refresh alumni with relations
        $alumni = $user->alumni()->with('dataAkademik')->first();
        
        // Build profile array manually to ensure all fields are included
        $profileArray = null;
        if ($alumni) {
            $profileArray = [
                'id' => $alumni->id,
                'user_id' => $alumni->user_id,
                'nim' => $alumni->nim,
                'nik' => $alumni->nik,
                'no_hp' => $alumni->no_hp,
                'tempat_lahir' => $alumni->tempat_lahir,
                'tanggal_lahir' => $alumni->tanggal_lahir ? $alumni->tanggal_lahir->format('Y-m-d') : null,
                'jenis_kelamin' => $alumni->jenis_kelamin,
                'alamat' => $alumni->alamat,
                'kota' => $alumni->kota,
                'provinsi' => $alumni->provinsi,
                'kode_pos' => $alumni->kode_pos,
                'tentang_saya' => $alumni->tentang_saya,
                'nama_bank' => $alumni->nama_bank,
                'no_rekening' => $alumni->no_rekening,
                'file_cv' => $alumni->file_cv,
                'foto_profil' => $alumni->foto_profil,
                'created_at' => $alumni->created_at,
                'updated_at' => $alumni->updated_at,
            ];
            
            if ($alumni->dataAkademik) {
                $profileArray['program_studi'] = $alumni->dataAkademik->program_studi;
                $profileArray['angkatan'] = $alumni->dataAkademik->tahun_masuk;
            }
            if ($alumni->file_cv) {
                $profileArray['cv_url'] = url('storage/' . $alumni->file_cv);
            }
            if ($alumni->foto_profil) {
                $profileArray['foto_profil_url'] = url('storage/' . $alumni->foto_profil);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil detail alumni berhasil diperbarui',
            'data' => [
                'user' => $user,
                'profile' => $profileArray,
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
