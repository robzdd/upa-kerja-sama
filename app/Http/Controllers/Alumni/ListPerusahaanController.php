<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\MitraPerusahaan;

class ListPerusahaanController extends Controller
{
    public function index()
    {
        $perusahaans = MitraPerusahaan::all();
        return view('alumni.list_perusahaan', compact('perusahaans'));
    }
}
