<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSyaratPl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && ($user->status_aktif !== 'aktif' || $user->jumlah_sks < 128)) {
            return redirect('/dashboard')->with('error', 'Anda belum bisa mengambil PL karena status tidak aktif atau SKS belum mencukupi (min. 128).');
        }

        return $next($request);
    }
}
