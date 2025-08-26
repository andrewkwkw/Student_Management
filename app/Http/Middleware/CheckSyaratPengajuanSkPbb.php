<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanPembimbing;
use App\Models\PrakLap;
use Symfony\Component\HttpFoundation\Response;

class CheckSyaratPengajuanSkPbb
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($user->status_aktif !== 'aktif') {
            return redirect()->route('dashboard')->with(
                'error',
                'Status kuliah Anda tidak aktif. Silakan hubungi admin.'
            );
        }

        $pengajuan = PengajuanPembimbing::where('user_id', $user->id)->first();
        if (!$pengajuan || $pengajuan->status_pengajuan !== 'Diterima') {
            return redirect()->route('dashboard')->with(
                'error',
                'Anda belum menyelesaikan tahapan Pengajuan Pembimbing. Status Anda: ' . ($pengajuan->status_pengajuan ?? 'Belum Mengajukan')
            );
        }

        $praktikLapang = PrakLap::where('user_id_mhs_1', $user->id)
                                ->orWhere('user_id_mhs_2', $user->id)
                                ->orWhere('user_id_mhs_3', $user->id)
                                ->first();
        if (!$praktikLapang || $praktikLapang->status_pelaksanaan !== 'Selesai') {
            return redirect()->route('dashboard')->with(
                'error',
                'Anda belum menyelesaikan Praktik Lapang. Status PL Anda: ' . ($praktikLapang->status_pelaksanaan ?? 'Tidak Ditemukan')
            );
        }

        return $next($request);
    }
}
