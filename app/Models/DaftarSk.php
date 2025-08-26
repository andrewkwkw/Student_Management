<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarSk extends Model
{
    use HasFactory;

    protected $table = 'sk_daftars';

    protected $fillable = [
        'user_id',
        'jadwal_yudisium',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sidangHasil()
    {
        return $this->hasOne(SidangHasil::class, 'user_id', 'user_id');
    }
}