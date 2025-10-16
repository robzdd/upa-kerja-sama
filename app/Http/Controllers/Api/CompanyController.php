<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MitraPerusahaan;
use App\Models\User;

class CompanyController extends Controller
{
    /**
     * Get list of companies
     */
    public function index(Request $request)
    {
        $query = MitraPerusahaan::with(['user', 'lowongan'])
            ->whereHas('user.roles', function($q) {
                $q->where('name', 'mitra');
            })
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan keyword
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('sektor', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%");
            });
        }

        $companies = $query->get();

        return response()->json([
            'success' => true,
            'data' => $companies,
            'message' => 'Data perusahaan berhasil diambil'
        ]);
    }

    /**
     * Get company detail
     */
    public function show($id)
    {
        $company = MitraPerusahaan::with(['user', 'lowongan' => function($query) {
            $query->where('status_aktif', true);
        }])
            ->where('id', $id)
            ->first();

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Perusahaan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $company,
            'message' => 'Detail perusahaan berhasil diambil'
        ]);
    }

    /**
     * Update or create the authenticated mitra's company profile
     */
    public function updateMine(Request $request)
    {
        // Extract user from the simple token used in this demo (base64 id|time|rand)
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        }
        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        $userId = $parts[0] ?? null;
        if (!$userId || !($user = User::find($userId))) {
            return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);
        }

        // Validate incoming fields
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sektor' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'tautan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tentang' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'keunggulan' => 'nullable',
        ]);

        // Upsert company profile for this user
        $company = MitraPerusahaan::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_perusahaan' => $validated['nama_perusahaan'],
                'sektor' => $validated['sektor'] ?? null,
                'kontak' => $validated['kontak'] ?? null,
                'tautan' => $validated['tautan'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'tentang' => $validated['tentang'] ?? null,
            ]
        );

        // Attach optional non-table fields to response for mobile rendering
        $responseData = $company->toArray();
        if (isset($validated['alamat'])) $responseData['alamat'] = $validated['alamat'];
        if (isset($validated['tentang'])) $responseData['tentang'] = $validated['tentang'];
        if (isset($validated['visi'])) $responseData['visi'] = $validated['visi'];
        if (isset($validated['misi'])) $responseData['misi'] = $validated['misi'];
        if (isset($validated['keunggulan'])) $responseData['keunggulan'] = $validated['keunggulan'];

        return response()->json([
            'success' => true,
            'message' => 'Profil perusahaan berhasil diperbarui',
            'data' => $responseData,
        ]);
    }
}
