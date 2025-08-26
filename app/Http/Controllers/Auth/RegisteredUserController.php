<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman form register.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Simpan data registrasi.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'npm'           => ['required', 'digits_between:8,20', 'unique:users'],
            'tahun_masuk'   => ['required', 'string', 'max:10'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'npm'           => $validated['npm'],
            'tahun_masuk'   => $validated['tahun_masuk'],
            'status_aktif'  => 1,
            'jumlah_sks'    => 0,
            'role'          => 'mahasiswa',
            'password'      => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user); 
        

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
