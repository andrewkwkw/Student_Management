<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanProposal extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_proposals';

    protected $fillable = [
        'user_id',
        'bukti_acc_1',
        'bukti_acc_2',
        'bukti_bimbingan_1',
        'bukti_bimbingan_2',
        'nilai_proposal',
    ];

    /**
     * Relasi ke User (many-to-one)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
