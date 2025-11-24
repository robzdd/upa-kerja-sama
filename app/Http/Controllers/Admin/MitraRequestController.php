<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MitraRegistrationRequest;

class MitraRequestController extends Controller
{
    /**
     * Display a listing of mitra registration requests
     */
    public function index(Request $request)
    {
        $query = MitraRegistrationRequest::with('processedBy')->latest();

        // Statistics for dashboard cards
        $stats = [
            'pending_mitra_requests' => MitraRegistrationRequest::pending()->count(),
        ];

        // Recent pending requests for dropdown/notification
        $recent_mitra_requests = MitraRegistrationRequest::pending()
            ->latest()
            ->take(5)
            ->get();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(15);
        $pendingCount = MitraRegistrationRequest::pending()->count();
        $approvedCount = MitraRegistrationRequest::approved()->count();
        $rejectedCount = MitraRegistrationRequest::rejected()->count();

        return view('admin.mitra-requests.index', compact('requests', 'pendingCount', 'approvedCount', 'rejectedCount', 'stats', 'recent_mitra_requests'));

    }

    /**
     * Display the specified mitra registration request
     */
    public function show($id)
    {
        $request = MitraRegistrationRequest::with('processedBy')->findOrFail($id);
        return view('admin.mitra-requests.show', compact('request'));
    }

    /**
     * Approve mitra registration request
     */
    public function approve($id)
    {
        $registrationRequest = MitraRegistrationRequest::findOrFail($id);

        if (!$registrationRequest->isPending()) {
            return redirect()
                ->route('admin.mitra-requests.show', $id)
                ->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        // TODO: Create mitra account
        // TODO: Send approval email

        $registrationRequest->update([
            'status' => MitraRegistrationRequest::STATUS_APPROVED,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        return redirect()
            ->route('admin.mitra-requests.index')
            ->with('success', 'Request mitra berhasil disetujui. Akun akan dibuat dan email akan dikirim ke mitra.');
    }

    /**
     * Reject mitra registration request
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $registrationRequest = MitraRegistrationRequest::findOrFail($id);

        if (!$registrationRequest->isPending()) {
            return redirect()
                ->route('admin.mitra-requests.show', $id)
                ->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        // TODO: Send rejection email

        $registrationRequest->update([
            'status' => MitraRegistrationRequest::STATUS_REJECTED,
            'admin_notes' => $request->admin_notes,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        return redirect()
            ->route('admin.mitra-requests.index')
            ->with('success', 'Request mitra berhasil ditolak. Email notifikasi akan dikirim ke mitra.');
    }
}
