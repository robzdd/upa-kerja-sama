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
        // 1. Validation & Sanitization
        try {
            $startDate = Carbon::parse($request->input('start_date', Carbon::now()->subYear()->startOfMonth()->format('Y-m-d')));
            $endDate = Carbon::parse($request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d')));
        } catch (\Exception $e) {
            // Fallback if invalid dates provided
            $startDate = Carbon::now()->subYear()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }

        // 2. Logic Mitigation: Ensure Start <= End
        if ($startDate->gt($endDate)) {
            // Swap dates automatically
            $temp = $startDate;
            $startDate = $endDate;
            $endDate = $temp;
            
            session()->flash('warning', 'Tanggal awal ditemukan lebih besar dari tanggal akhir. Rentang waktu telah disesuaikan otomatis.');
        }

        // Format for query and view
        $startDate = $startDate->format('Y-m-d');
        $endDate = $endDate->format('Y-m-d');

        // 3. Summary Statistics (Filtered by Date)
        $totalAlumni = User::role('alumni')->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->count();
        $totalMitra = MitraPerusahaan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->count();
        $totalLowongan = LowonganPekerjaan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->count();
        $totalLamaran = Pelamar::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->count();

        // 4. User Growth Chart (Alumni & Mitra)
        $userGrowth = User::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("COUNT(*) as count")
        )
        ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // 5. Lowongan Growth Chart
        $lowonganGrowth = LowonganPekerjaan::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("COUNT(*) as count")
        )
        ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // 6. Lamaran Status Distribution (Pie Chart)
        $lamaranStatus = Pelamar::select('status', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Prepare Data for Charts
        $months = [];
        $userCounts = [];
        $lowonganCounts = [];

        // Generate labels for the selected range
        $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);
        foreach ($period as $date) {
            $monthKey = $date->format('Y-m');
            $months[] = $date->format('M Y');
            
            $userCounts[] = $userGrowth->where('month', $monthKey)->first()->count ?? 0;
            $lowonganCounts[] = $lowonganGrowth->where('month', $monthKey)->first()->count ?? 0;
        }

        // 5. Top Companies by Job Postings
        $topCompanies = MitraPerusahaan::withCount('lowongan')
            ->orderBy('lowongan_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.reports.index', compact(
            'totalAlumni',
            'totalMitra',
            'totalLowongan',
            'totalLamaran',
            'months',
            'userCounts',
            'lowonganCounts',
            'lamaranStatus',
            'startDate',
            'endDate',
            'topCompanies'
        ));
    }
}
