<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jadwalkontrol extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kontrol';
    protected $primaryKey = 'id_kontrol';
    public $timestamps = true; // Pastikan timestamps diaktifkan

    protected $fillable = [
        'id_rekam_medis',
        'id_pasien',
        'tanggal_kontrol',
        'status_notifikasi'
    ];

    /**
     * Get the pasien that owns the jadwalkontrol
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    /**
     * Get the rekamMedis that owns the jadwalkontrol
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rekamMedis(): BelongsTo
    {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis', 'id_perawatan');
    }
}
