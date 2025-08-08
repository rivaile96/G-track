<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'phone_number',
        'ktp_number',
        'sim_type',
        'sim_number',
        'sim_expiry_date',
        'photo_path',
        'address',
        'status',
    ];

    /**
     * Relasi: Satu driver hanya bisa membawa (has one) satu aset pada satu waktu.
     */
    public function asset()
    {
        return $this->hasOne(Asset::class);
    }
}
