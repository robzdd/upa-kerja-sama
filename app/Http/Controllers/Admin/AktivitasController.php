<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    /**
     * Display a listing of activities
     */
    public function index()
    {
        $aktivitas = Aktivitas::latest()->paginate(15);
        return view('admin.aktivitas.index', compact('aktivitas'));
    }

    /**
     * Show the form for creating a new activity
     */
    public function create()
    {
        return view('admin.aktivitas.create');
    }

    /**
     * Store a newly created activity
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,completed',
        ]);

        Aktivitas::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    /**
     * Display the specified activity
     */
    public function show($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        return view('admin.aktivitas.show', compact('aktivitas'));
    }

    /**
     * Show the form for editing the specified activity
     */
    public function edit($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        return view('admin.aktivitas.edit', compact('aktivitas'));
    }

    /**
     * Update the specified activity
     */
    public function update(Request $request, $id)
    {
        $aktivitas = Aktivitas::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,completed',
        ]);

        $aktivitas->update($request->all());

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /**
     * Remove the specified activity
     */
    public function destroy($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->delete();

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}

