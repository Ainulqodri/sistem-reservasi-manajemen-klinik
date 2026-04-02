<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    protected $fillable = [
        'id_pasien',
        'tanggal_reservasi',
        'waktu_reservasi',
        'keluhan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'id_reservasi', 'id_reservasi');
    }
}
