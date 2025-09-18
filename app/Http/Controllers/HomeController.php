<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $role = $request->query('role', 'alumni');
        return view('home.carilowongan', compact('role'));
    }
}


