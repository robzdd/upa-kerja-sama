<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class AlumniArtikelController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua artikel, bisa tambahkan filter/pagination jika perlu
        $artikels = Artikel::with(['kategori', 'user'])->latest()->paginate(9);
        return view('alumni.artikel_page', compact('artikels'));
    }
}
