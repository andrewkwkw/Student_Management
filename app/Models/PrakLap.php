<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PrakLap extends Model
{
    use HasFactory;

    protected $table = 'praktik_lapangs';

    protected $fillable = [
        'user_id_mhs_1',
        'skema',
        'sipu_path',
        'nama_instansi',
        'alamat_instansi',
        'dosen_pembimbing',
        'status_pl',
        'tanggal_pelaksanaan',
        'institution_approval_path',
        'user_id_mhs_2',
        'user_id_mhs_3',
    ];

    protected function statusPelaksanaan(): Attribute
    {
        return Attribute::make(
            get: function () {
                $tanggalPelaksanaan = Carbon::parse($this->tanggal_pelaksanaan);
                $sejakPelaksanaan = $tanggalPelaksanaan->diffInDays(Carbon::now());
                
                if ($sejakPelaksanaan >= 30) {
                    return 'Selesai';
                }
                return 'Dalam Proses';
            }
        );
    }

    /**
     * Dapatkan mahasiswa pendaftar utama.
     */
    public function mahasiswa1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_mhs_1');
    }

    /**
     * Dapatkan anggota kelompok kedua.
     */
    public function mahasiswa2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_mhs_2');
    }

    /**
     * Dapatkan anggota kelompok ketiga.
     */
    public function mahasiswa3(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_mhs_3');
    }

    /**
     * Dapatkan dosen pembimbing dari pengajuan ini.
     */
    public function dosenPembimbing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing');
    }
}
