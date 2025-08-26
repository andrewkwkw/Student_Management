<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSkPembimbing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bukti_acc_1',
        'bukti_acc_2',
        'bukti_bimbingan_1',
        'bukti_bimbingan_2',
        'sk_pembimbing',
    ];

    /**
     * Get the user that owns the PengajuanSkPembimbing.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
