<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Praktik_lapang\PraktikLapangController as PraktikLapangController;
use App\Http\Controllers\Admin\PraktikLapangController as AdminPraktikLapangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pendaftaran_Sk\PengajuanPembimbingController;
use App\Http\Controllers\Admin\Manajemen_Sk\PengajuanPembimbingController as AdminPengajuanPembimbingController;
use App\Http\Controllers\Pendaftaran_Sk\PengajuanSkPembimbingController;
use App\Http\Controllers\Admin\Manajemen_Sk\PengajuanSkPembimbingController as AdminPengajuanSkPembimbingController;
use App\Http\Controllers\Pendaftaran_Sk\PengajuanProposalController;
use App\Http\Controllers\Admin\Manajemen_Sk\PengajuanProposalController as AdminPengajuanProposalController;
use App\Http\Controllers\Pendaftaran_Sk\SidangHasilController;
use App\Http\Controllers\Admin\Manajemen_Sk\SidangHasilController as AdminSidangHasilController;
use App\Http\Controllers\Pendaftaran_Sk\DaftarSkController;

// ========================
// Halaman Awal
// ========================
Route::get('/', fn() => view('welcome'));

// ========================
// Redirect setelah login sesuai role
// ========================
Route::get('/redirect', function () {
    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
})->middleware('auth')->name('redirect');

// ========================
// Dashboard Mahasiswa
// ========================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role.redirect', 'verified'])
    ->name('dashboard');

// ========================
// ROUTE ADMIN
// ========================
Route::middleware(['auth', 'auth.with.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Manajemen Mahasiswa
        Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('{mahasiswa}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::patch('{mahasiswa}', [AdminController::class, 'update'])->name('update'); 
            Route::delete('{mahasiswa}', [AdminController::class, 'destroy'])->name('destroy');
        });

        // Praktik Lapang (Admin)
        Route::prefix('praklap')->name('praklap.')->group(function () {
            Route::get('/', [AdminPraktikLapangController::class, 'index'])->name('index');
            Route::get('{praklap}', [AdminPraktikLapangController::class, 'show'])->name('show');
            Route::get('{praklap}/edit', [AdminPraktikLapangController::class, 'edit'])->name('edit');
            Route::patch('{praklap}', [AdminPraktikLapangController::class, 'update'])->name('update');
            Route::delete('{praklap}', [AdminPraktikLapangController::class, 'destroy'])->name('destroy');
        });

        // Manajemen SK
        Route::prefix('manajemen-sk')->name('manajemen_sk.')->group(function () {
            // Pengajuan Pembimbing
            Route::get('/pengajuan-pembimbing', [AdminPengajuanPembimbingController::class, 'show'])->name('pengajuan_pembimbing.show');
            Route::get('/pengajuan-pembimbing/{pengajuan}/edit', [AdminPengajuanPembimbingController::class, 'edit'])->name('pengajuan_pembimbing.edit');
            Route::put('/pengajuan-pembimbing/{pengajuan}', [AdminPengajuanPembimbingController::class, 'update'])->name('pengajuan_pembimbing.update');
            Route::delete('/pengajuan-pembimbing/{pengajuan}', [AdminPengajuanPembimbingController::class, 'destroy'])->name('pengajuan_pembimbing.destroy');

            // Pengajuan SK Pembimbing
            Route::get('/pengajuan-sk-pembimbing', [AdminPengajuanSkPembimbingController::class, 'show'])->name('pengajuan_sk_pembimbing.show');
            Route::get('/pengajuan-sk-pembimbing/{pengajuan}/edit', [AdminPengajuanSkPembimbingController::class, 'edit'])->name('pengajuan_sk_pembimbing.edit');
            Route::put('/pengajuan-sk-pembimbing/{pengajuan}', [AdminPengajuanSkPembimbingController::class, 'update'])->name('pengajuan_sk_pembimbing.update');
            Route::delete('/pengajuan-sk-pembimbing/{pengajuan}', [AdminPengajuanSkPembimbingController::class, 'destroy'])->name('pengajuan_sk_pembimbing.destroy');

            // Pengajuan Proposal
            Route::get('/pengajuan-proposal', [AdminPengajuanProposalController::class, 'show'])->name('pengajuan_proposal.show');
            Route::get('/pengajuan-proposal/{id}/edit', [AdminPengajuanProposalController::class, 'edit'])->name('pengajuan_proposal.edit');
            Route::put('/pengajuan-proposal/{id}', [AdminPengajuanProposalController::class, 'update'])->name('pengajuan_proposal.update');
            Route::delete('/pengajuan-proposal/{id}', [AdminPengajuanProposalController::class, 'destroy'])->name('pengajuan_proposal.destroy');

            // Sidang Hasil
            Route::get('/sidang-hasil', [AdminSidangHasilController::class, 'show'])->name('sidang_hasil.show');
            Route::get('/sidang-hasil/{id}/edit', [AdminSidangHasilController::class, 'edit'])->name('sidang_hasil.edit');
            Route::put('/sidang-hasil/{id}', [AdminSidangHasilController::class, 'update'])->name('sidang_hasil.update');
            Route::delete('/sidang-hasil/{id}', [AdminSidangHasilController::class, 'destroy'])->name('sidang_hasil.destroy');
        });
    });


// ========================
// ROUTE UMUM (LOGIN REQUIRED)
// ========================
Route::middleware(['auth'])->group(function () {
    // Profil
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Praktik Lapang (Mahasiswa)
    Route::prefix('mahasiswa/praklap')
        ->name('mahasiswa.praklap.')
        ->middleware('mahasiswa.syarat')
        ->group(function () {
            Route::get('/create', [PraktikLapangController::class, 'create'])->name('create');
            Route::post('/', [PraktikLapangController::class, 'store'])->name('store');
            Route::get('/show', [PraktikLapangController::class, 'show'])->name('show');
            Route::post('/upload-institution-approval',[PraktikLapangController::class, 'uploadInstitutionApproval'])->name('upload-institution-approval');
    });

    // Pengajuan Pembimbing (Mahasiswa)
    Route::prefix('mahasiswa')
        ->name('mahasiswa.')
        ->middleware('syarat.pengajuanpbb')
        ->group(function () {
            Route::resource('pengajuan_pembimbing', PengajuanPembimbingController::class)
                ->only(['create', 'store', 'show']);
    });
     
    // Rute untuk Pengajuan SK Pembimbing   
    Route::middleware(['auth', 'verified', 'syarat.pengajuan.sk.pbb'])->group(function () {
    Route::get('/pengajuan-sk-pembimbing', [PengajuanSkPembimbingController::class, 'create'])->name('mahasiswa.pengajuan_sk_pembimbing.create');
    Route::post('/pengajuan-sk-pembimbing', [PengajuanSkPembimbingController::class, 'store'])->name('mahasiswa.pengajuan_sk_pembimbing.store');
    Route::get('/pengajuan-sk-pembimbing/{id}', [PengajuanSkPembimbingController::class, 'show'])->name('mahasiswa.pengajuan_sk_pembimbing.show');
    });

    // Rute untuk Pengajuan Proposal
    Route::middleware(['auth', 'verified', /* tambahkan middleware jika ada */])->group(function () {
    Route::get('/pengajuan-proposal', [PengajuanProposalController::class, 'create'])->name('mahasiswa.pengajuan_proposal.create');
    Route::post('/pengajuan-proposal', [PengajuanProposalController::class, 'store'])->name('mahasiswa.pengajuan_proposal.store');
    Route::get('/pengajuan-proposal/{id}', [PengajuanProposalController::class, 'show'])->name('mahasiswa.pengajuan_proposal.show');
    });
    // Rute untuk Sidang Hasil
    Route::middleware(['auth', 'verified', /* tambahkan middleware jika ada */])->group(function () {
    Route::get('/sidang_hasil', [SidangHasilController::class, 'create'])->name('mahasiswa.sidang_hasil.create');
    Route::post('/sidang_hasil', [SidangHasilController::class, 'store'])->name('mahasiswa.sidang_hasil.store');
    Route::get('/sidang_hasil/{id}', [SidangHasilController::class, 'show'])->name('mahasiswa.sidang_hasil.show');
    });
    // Rute untuk Pendaftaran SK
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/pendaftaran_sk', [DaftarSkController::class, 'create'])->name('mahasiswa.pendaftaran_sk.create');
        Route::post('/pendaftaran_sk', [DaftarSkController::class, 'store'])->name('mahasiswa.pendaftaran_sk.store');
        Route::get('/pendaftaran_sk/{daftarSk}', [DaftarSkController::class, 'show'])->name('mahasiswa.pendaftaran_sk.show');
    });

});

require __DIR__ . '/auth.php';