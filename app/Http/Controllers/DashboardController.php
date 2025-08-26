<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard mahasiswa dengan data user yang sedang login.
     */
    public function index(): View
    {
        $user = Auth::user();

        return view('dashboard', [
            'user' => $user
        ]);
    }
}