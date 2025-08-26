<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SidangHasil extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bukti_acc_1',
        'bukti_acc_2',
        'bukti_bimbingan_1',
        'bukti_bimbingan_2',
        'nilai_sidang_hasil',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daftarSk()
    {
        return $this->hasOne(DaftarSk::class, 'user_id', 'user_id');
    }
}

