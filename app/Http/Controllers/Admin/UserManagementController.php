<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alumni;
use App\Models\MitraPerusahaan;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users based on type
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'all'); // all, alumni, mitra, mahasiswa

        $query = User::with(['alumni', 'mitraPerusahaan', 'mahasiswa']);

        if ($type === 'alumni') {
            $query->whereHas('alumni');
        } elseif ($type === 'mitra') {
            $query->whereHas('mitraPerusahaan');
        } elseif ($type === 'mahasiswa') {
            $query->whereHas('mahasiswa');
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users', 'type'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create(Request $request)
    {
        $programStudi = ProgramStudi::all();
        return view('admin.users.create', compact('programStudi'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {


        // Basic validation for all users
        $baseRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|in:alumni,mitra,mahasiswa',
        ];

        // Additional validation rules based on user type
        $typeRules = [];
        if ($request->type === 'alumni') {
            $typeRules = [
                'nim_alumni' => 'required|string|max:20|unique:alumnis,nim',
                'no_hp' => 'required|string|max:15',
            ];
        } elseif ($request->type === 'mitra') {
            $typeRules = [
                'nama_perusahaan' => 'required|string|max:255',
                'sektor' => 'required|string|max:100',
            ];
        } elseif ($request->type === 'mahasiswa') {
            $typeRules = [
                'program_studi_id' => 'required|exists:program_studis,id',
                'nim' => 'required|string|max:20|unique:mahasiswa,nim',
                'angkatan' => 'required|string|max:4',
            ];
        }

        // Merge base rules with type-specific rules and validate
        $validated = $request->validate(array_merge($baseRules, $typeRules));

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Assign role
            $user->assignRole($request->type);

            // Create specific profile based on type
            if ($request->type === 'alumni') {
                Alumni::create([
                    'user_id' => $user->id,
                    'nim' => $request->nim_alumni,
                    'no_hp' => $request->no_hp,
                ]);
            } elseif ($request->type === 'mitra') {
                MitraPerusahaan::create([
                    'user_id' => $user->id,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'sektor' => $request->sektor,
                ]);
            } elseif ($request->type === 'mahasiswa') {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'program_studi_id' => $request->program_studi_id,
                    'nim' => $request->nim,
                    'angkatan' => $request->angkatan,
                ]);
            }

            DB::commit();

            $successMessage = match($request->type) {
                'alumni' => 'Alumni berhasil ditambahkan: ' . $request->name . ' (NIM: ' . $request->nim_alumni . ')',
                'mitra' => 'Mitra Perusahaan berhasil ditambahkan: ' . $request->nama_perusahaan,
                'mahasiswa' => 'Mahasiswa berhasil ditambahkan: ' . $request->name . ' (NIM: ' . $request->nim . ')',
                default => 'User berhasil ditambahkan'
            };

            return redirect()
                ->route('admin.users.index', ['type' => $request->type])
                ->with('success', $successMessage);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user
     */
    public function show($id)
    {
        $user = User::with(['alumni', 'mitraPerusahaan', 'mahasiswa'])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id)
    {
        $user = User::with(['alumni', 'mitraPerusahaan', 'mahasiswa'])->findOrFail($id);
        $programStudi = ProgramStudi::all();

        // Determine type
        $type = 'user';
        if ($user->alumni) {
            $type = 'alumni';
        } elseif ($user->mitraPerusahaan) {
            $type = 'mitra';
        } elseif ($user->mahasiswa) {
            $type = 'mahasiswa';
        }

        return view('admin.users.edit', compact('user', 'type', 'programStudi'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            // Update specific profile
            if ($user->alumni) {
                $user->alumni->update([
                    'nim' => $request->nim ?? $user->alumni->nim,
                    'no_hp' => $request->no_hp ?? $user->alumni->no_hp,
                ]);
            } elseif ($user->mitraPerusahaan) {
                $user->mitraPerusahaan->update([
                    'nama_perusahaan' => $request->nama_perusahaan ?? $user->mitraPerusahaan->nama_perusahaan,
                    'sektor' => $request->sektor ?? $user->mitraPerusahaan->sektor,
                ]);
            } elseif ($user->mahasiswa) {
                $user->mahasiswa->update([
                    'program_studi_id' => $request->program_studi_id ?? $user->mahasiswa->program_studi_id,
                    'nim' => $request->nim ?? $user->mahasiswa->nim,
                    'angkatan' => $request->angkatan ?? $user->mahasiswa->angkatan,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $user->delete(); // Soft delete

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}

