<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use App\Models\MitraPerusahaan;
use App\Models\LowonganPekerjaan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getReportData($request);
        return view('admin.reports.index', $data);
    }

    public function download(Request $request)
    {
        $data = $this->getReportData($request);
        
        $pdf = app('dompdf.wrapper')->loadView('admin.reports.pdf', $data);
        return $pdf->download('Laporan-UPA-Polindra-' . $data['startDate'] . '-to-' . $data['endDate'] . '.pdf');
    }

    private function getReportData(Request $request)
    {
        // 1. Validation & Sanitization
        try {
            $startDate = Carbon::parse($request->input('start_date', Carbon::now()->subYear()->startOfMonth()->format('Y-m-d')));
            $endDate = Carbon::parse($request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d')));
        } catch (\Exception $e) {
            $startDate = Carbon::now()->subYear()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }

        // 2. Logic Mitigation: Ensure Start <= End
        if ($startDate->gt($endDate)) {
            $temp = $startDate;
            $startDate = $endDate;
            $endDate = $temp;
            
            if (!$request->routeIs('admin.reports.download')) {
                session()->flash('warning', 'Tanggal awal ditemukan lebih besar dari tanggal akhir. Rentang waktu telah disesuaikan otomatis.');
            }
        }

        // Format for query
        $startStr = $startDate->format('Y-m-d');
        $endStr = $endDate->format('Y-m-d');

        // 3. Summary Statistics
        $totalAlumni = User::role('alumni')->whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])->count();
        $totalMitra = MitraPerusahaan::whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])->count();
        $totalLowongan = LowonganPekerjaan::whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])->count();
        $totalLamaran = Pelamar::whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])->count();

        // 4. User Growth
        $userGrowth = User::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("COUNT(*) as count")
        )
        ->whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // 5. Lowongan Growth
        $lowonganGrowth = LowonganPekerjaan::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("COUNT(*) as count")
        )
        ->whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // 6. Lamaran Status
        $lamaranStatus = Pelamar::select('status', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Prepare Data for Charts
        $months = [];
        $userCounts = [];
        $lowonganCounts = [];

        $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);
        foreach ($period as $date) {
            $monthKey = $date->format('Y-m');
            $months[] = $date->format('M Y');
            
            $userCounts[] = $userGrowth->where('month', $monthKey)->first()->count ?? 0;
            $lowonganCounts[] = $lowonganGrowth->where('month', $monthKey)->first()->count ?? 0;
        }

        // 7. Top Companies
        $topCompanies = MitraPerusahaan::withCount('lowongan')
            ->orderBy('lowongan_count', 'desc')
            ->take(5)
            ->get();

        // 8. Alumni Distribution by Program Studi
        $alumniByProdi = \App\Models\ProgramStudi::withCount(['alumni' => function($query) use ($startStr, $endStr) {
            $query->whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59']);
        }])->get();

        // 9. Recent Vacancies (Activity)
        $recentLowongan = LowonganPekerjaan::with('mitra')
            ->whereBetween('created_at', [$startStr . ' 00:00:00', $endStr . ' 23:59:59'])
            ->latest()
            ->take(10)
            ->get();

        return [
            'totalAlumni' => $totalAlumni,
            'totalMitra' => $totalMitra,
            'totalLowongan' => $totalLowongan,
            'totalLamaran' => $totalLamaran,
            'months' => $months,
            'userCounts' => $userCounts,
            'lowonganCounts' => $lowonganCounts,
            'lamaranStatus' => $lamaranStatus,
            'startDate' => $startStr,
            'endDate' => $endStr,
            'topCompanies' => $topCompanies,
            'alumniByProdi' => $alumniByProdi,
            'recentLowongan' => $recentLowongan
        ];
    }
}
