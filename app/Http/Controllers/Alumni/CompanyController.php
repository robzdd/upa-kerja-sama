<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\MitraPerusahaan;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = MitraPerusahaan::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('nama_perusahaan', 'like', '%' . $request->search . '%');
        }

        // Filter by sector
        if ($request->filled('sektor')) {
            $query->where('sektor', $request->sektor);
        }

        // Get paginated results
        $companies = $query->withCount(['lowongan' => function ($q) {
            $q->where('status_aktif', true);
        }])->orderBy('nama_perusahaan')->paginate(9);

        // Get distinct sectors for dropdown
        $sectors = MitraPerusahaan::whereNotNull('sektor')
            ->distinct()
            ->orderBy('sektor')
            ->pluck('sektor');

        $totalCompanies = MitraPerusahaan::count();

        return view('alumni.list_perusahaan', compact('companies', 'sectors', 'totalCompanies'));
    }

    public function show($id)
    {
        $company = MitraPerusahaan::with(['lowongan' => function ($q) {
            $q->where('status_aktif', true)->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('alumni.detail_perusahaan', compact('company'));
    }
}
