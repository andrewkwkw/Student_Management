<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanPembimbing extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel default sudah pakai jamak)
    protected $table = 'pengajuan_pembimbings';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'judul_sk',
        'bidang_minat',
        'dosen_1',
        'dosen_2',
        'status_pengajuan',
    ];

    /**
     * Relasi ke User (mahasiswa yang mengajukan).
     * Satu pengajuan pembimbing dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
