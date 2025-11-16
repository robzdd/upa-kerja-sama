<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MitraPerusahaan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Get list of companies
     */
    public function index(Request $request)
    {
        $query = MitraPerusahaan::with(['user', 'lowongan' => function($query) {
            $query->where('status_aktif', true);
        }])
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

        // Add logo URL to each company
        $companies = $companies->map(function ($company) {
            $companyData = $company->toArray();
            if ($company->logo) {
                $companyData['logo_url'] = url('storage/' . $company->logo);
            }
            return $companyData;
        });

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

        // Add logo URL if exists
        $companyData = $company->toArray();
        if ($company->logo) {
            $companyData['logo_url'] = url('storage/' . $company->logo);
        }

        return response()->json([
            'success' => true,
            'data' => $companyData,
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

        // Handle keunggulan before validation - decode JSON string if needed (for multipart)
        // In multipart form-data, arrays are sent as JSON strings
        // In JSON request, arrays are sent directly
        $keunggulanInput = $request->input('keunggulan');
        if ($keunggulanInput !== null) {
            if (!is_array($keunggulanInput)) {
                // Try to decode if it's a JSON string
                if (is_string($keunggulanInput)) {
                    $decoded = json_decode($keunggulanInput, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        // Replace the string with array for validation (even if empty)
                        $request->merge(['keunggulan' => $decoded]);
                    } else {
                        // If not valid JSON, try to convert comma/newline separated string to array
                        $items = array_filter(array_map('trim', preg_split('/[\n,]+/', $keunggulanInput)));
                        if (!empty($items)) {
                            $request->merge(['keunggulan' => array_values($items)]);
                        } else {
                            // Empty or invalid, set to null
                            $request->merge(['keunggulan' => null]);
                        }
                    }
                } else {
                    // Not string and not array, set to null
                    $request->merge(['keunggulan' => null]);
                }
            }
            // If already array, leave it as is (for JSON requests)
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
            'keunggulan' => 'nullable|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Handle logo upload if provided
        $logoPath = null;
        if ($request->hasFile('logo')) {
            // Get or create company to check existing logo
            $existingCompany = MitraPerusahaan::where('user_id', $user->id)->first();
            
            // Delete old logo if exists
            if ($existingCompany && $existingCompany->logo && Storage::disk('public')->exists($existingCompany->logo)) {
                Storage::disk('public')->delete($existingCompany->logo);
            }
            
            // Store new logo
            $logoPath = $request->file('logo')->store('logo-perusahaan', 'public');
        }

        // Get keunggulan from validated data
        $keunggulan = $validated['keunggulan'] ?? null;
        
        // Convert empty array to null for consistency
        if (is_array($keunggulan) && empty($keunggulan)) {
            $keunggulan = null;
        }

        // Prepare data for update/create
        $data = [
            'nama_perusahaan' => $validated['nama_perusahaan'],
            'sektor' => $validated['sektor'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
            'tautan' => $validated['tautan'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'tentang' => $validated['tentang'] ?? null,
            'visi' => $validated['visi'] ?? null,
            'misi' => $validated['misi'] ?? null,
            'keunggulan' => $keunggulan,
        ];

        // Add logo path if uploaded
        if ($logoPath) {
            $data['logo'] = $logoPath;
        }

        // Upsert company profile for this user
        $company = MitraPerusahaan::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        // Attach optional non-table fields to response for mobile rendering
        $responseData = $company->toArray();
        if (isset($validated['alamat'])) $responseData['alamat'] = $validated['alamat'];
        if (isset($validated['tentang'])) $responseData['tentang'] = $validated['tentang'];
        if (isset($validated['visi'])) $responseData['visi'] = $validated['visi'];
        if (isset($validated['misi'])) $responseData['misi'] = $validated['misi'];
        if (isset($validated['keunggulan'])) $responseData['keunggulan'] = $validated['keunggulan'];

        // Add logo URL if exists
        if ($company->logo) {
            $responseData['logo_url'] = url('storage/' . $company->logo);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil perusahaan berhasil diperbarui',
            'data' => $responseData,
        ]);
    }
}
