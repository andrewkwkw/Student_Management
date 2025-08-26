<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PrakLap;
use Symfony\Component\HttpFoundation\Response;

class CheckSyaratPengajuanPbb
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        // Pastikan pengguna sudah login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data Praktik Lapang mahasiswa yang sedang login
        $praktikLapang = PrakLap::where('user_id_mhs_1', $user->id)
                                ->orWhere('user_id_mhs_2', $user->id)
                                ->orWhere('user_id_mhs_3', $user->id)
                                ->first();

        // Periksa setiap syarat satu per satu untuk pesan yang spesifik
        if (!$praktikLapang || $praktikLapang->status_pelaksanaan !== 'Selesai') {
            return redirect()->route('dashboard')->with('error', 'Anda belum menyelesaikan Praktik Lapang. Status PL Anda: ' . ($praktikLapang->status_pelaksanaan ?? 'Tidak Ditemukan') . '.');
        }

        if ($user->status_aktif !== 'aktif') {
            return redirect()->route('dashboard')->with('error', 'Status kuliah Anda tidak aktif. Silakan hubungi admin.');
        }

        if ($user->jumlah_sks < 128) {
            return redirect()->route('dashboard')->with('error', 'SKS Anda belum mencapai 128. Silakan penuhi syarat SKS.');
        }

        return $next($request);
    }
}