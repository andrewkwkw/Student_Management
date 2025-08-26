<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthWithRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Jika sudah login dan ke root atau /login, arahkan ke dashboard sesuai role
            if ($request->is('login') || $request->is('/')) {
                if ($role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($role === 'mahasiswa') {
                    return redirect()->route('dashboard');
                }
            }

            // Cegah akses halaman yang tidak sesuai role
            if ($role === 'admin' && !$request->is('admin/*')) {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'mahasiswa' && $request->is('admin/*')) {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
