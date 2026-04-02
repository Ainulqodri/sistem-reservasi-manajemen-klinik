<?php

namespace App\Http\Controllers;

use App\Models\jadwalpraktik;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $jadwal_dokter = jadwalpraktik::all();
        $hariIni = Carbon::today();

        // Menghitung jumlah antrian yang belum selesai
        $nomor_antrian = Reservasi::where('tanggal_reservasi', $hariIni)->count();

        return view('index', compact('jadwal_dokter', 'nomor_antrian'));
    }
}
