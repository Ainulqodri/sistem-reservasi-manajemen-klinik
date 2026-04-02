<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalpraktik extends Model
{
    use HasFactory;

    protected $table = 'jadwal_praktik';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_buka',
        'jam_tutup',
        'durasi_slot'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
