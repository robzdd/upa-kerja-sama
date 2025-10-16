<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MitraPerusahaan;

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
}
