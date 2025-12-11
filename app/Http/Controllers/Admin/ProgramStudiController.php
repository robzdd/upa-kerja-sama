<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProgramStudi::query();

        if ($request->has('search')) {
            $query->where('program_studi', 'like', '%' . $request->search . '%');
        }

        $programStudis = $query->orderBy('program_studi', 'asc')->paginate(10);

        return view('admin.program-studi.index', compact('programStudis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-studi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required|string|max:255|unique:program_studis,program_studi',
        ], [
            'program_studi.required' => 'Nama Program Studi wajib diisi.',
            'program_studi.unique' => 'Program Studi sudah ada.',
        ]);

        ProgramStudi::create([
            'program_studi' => $request->program_studi
        ]);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programStudi = ProgramStudi::findOrFail($id);

        $request->validate([
            'program_studi' => 'required|string|max:255|unique:program_studis,program_studi,' . $id,
        ], [
            'program_studi.required' => 'Nama Program Studi wajib diisi.',
            'program_studi.unique' => 'Program Studi sudah ada.',
        ]);

        $programStudi->update([
            'program_studi' => $request->program_studi
        ]);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);

        // Check if there are any alumni associated with this program studi
        if ($programStudi->alumni()->count() > 0) {
            return redirect()->route('admin.program-studi.index')
                ->with('error', 'Tidak dapat menghapus Program Studi karena masih digunakan oleh data Alumni.');
        }

        $programStudi->delete();

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil dihapus.');
    }
}
