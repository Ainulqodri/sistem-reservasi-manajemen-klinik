<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_perawatan';
    protected $fillable = [
        'id_pasien',
        'gol_darah',
        'penyakit_jantung',
        'diabetes',
        'alergi_obat',
        'alergi_makanan',
        'hepatitis',
        'hemofili',
        'tekanan_darah_mm',
        'tekanan_darah_hg',
        'jenis_gigi',
        'keluhan',
        'tindakan',
        'keterangan',
        'tanggal_perawatan',
    ];

    protected $casts = [
        'tanggal_perawatan' => 'date:Y-m-d',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    /**
     * Get the jadwalKontrol associated with the RekamMedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jadwalKontrol(): HasOne
    {
        return $this->hasOne(jadwalkontrol::class, 'id_rekam_medis', 'id_perawatan');
    }

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
