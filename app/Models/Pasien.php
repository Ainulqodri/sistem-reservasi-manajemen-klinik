<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    public $timestamps = true; // Pastikan timestamps diaktifkan
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'alamat',
        'nomor_telepon',
    ];

    public function jadwalKontrol()
    {
        return $this->hasMany(JadwalKontrol::class, 'id_pasien', 'id_pasien');
    }

    // Relasi ke RekamMedis (One-to-Many)
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_pasien', 'id_pasien');
    }

    // Relasi ke Reservasi (One-to-Many)
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_pasien', 'id_pasien');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id_pasien');
    }
}
