<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    protected $fillable = [
        'nama_dokter',
        'alamat',
        'no_telepon',
        'foto',
    ];

    public function jadwalpraktik()
    {
        return $this->hasMany(jadwalpraktik::class, 'id_dokter', 'id_dokter');
    }
}
