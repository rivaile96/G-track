<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'unique_id',
        'type',
        'status',
        'latitude',      // <-- [PENTING] Ditambahkan
        'longitude',     // <-- [PENTING] Ditambahkan
        'driver_id',     // <-- [PENTING] Ditambahkan
    ];

    /**
     * [BARU] Relasi: Satu Aset dimiliki oleh (belongs to) satu Driver.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
