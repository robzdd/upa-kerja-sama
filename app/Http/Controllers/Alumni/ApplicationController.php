<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil semua lamaran user dengan relasi lowongan
        $applications = Pelamar::with(['lowongan', 'lowongan.mitra'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Hitung statistik
        $stats = [
            'total' => $applications->count(),
            'pending' => $applications->where('status', 'pending')->count(),
            'interview' => $applications->where('status', 'interview')->count(),
            'diterima' => $applications->where('status', 'diterima')->count(),
            'ditolak' => $applications->where('status', 'ditolak')->count(),
        ];
        
        return view('alumni.status_lamaran', compact('applications', 'stats'));
    }
    
    public function show($id)
    {
        $user = Auth::user();
        
        $application = Pelamar::with(['lowongan', 'lowongan.mitra'])
            ->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        
        return view('alumni.application_detail', compact('application'));
    }
    
    public function cancel($id)
    {
        $user = Auth::user();
        
        $application = Pelamar::where('user_id', $user->id)
            ->where('id', $id)
            ->where('status', 'pending')
            ->firstOrFail();
        
        $application->delete(); // Soft delete
        
        return redirect()->route('alumni.applications')
            ->with('success', 'Lamaran berhasil dibatalkan');
    }
}