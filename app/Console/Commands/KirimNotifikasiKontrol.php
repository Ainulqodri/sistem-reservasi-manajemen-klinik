<?php

namespace App\Console\Commands;

use App\Models\jadwalkontrol;
use App\Services\FonnteService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class KirimNotifikasiKontrol extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasi:kirim-kontrol';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim notifikasi ke pasien yang memiliki jadwal kontrol hari ini';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hariIni = Carbon::today();
        Log::info("Menjalankan command notifikasi:kirim-kontrol pada {$hariIni}");

        // Ambil jadwal kontrol untuk hari ini yang belum dikirimi notifikasi
        $jadwalKontrol = jadwalkontrol::where('tanggal_kontrol', $hariIni)
            ->where('status_notifikasi', false)
            ->get();

        foreach ($jadwalKontrol as $kontrol) {
            $pasien = $kontrol->rekamMedis->pasien;
            if (!$pasien || !$pasien->nomor_telepon) {
                Log::warning("Data pasien atau nomor HP tidak ditemukan untuk jadwal kontrol ID: {$kontrol->id}");
                continue;
            }

            $nomor = '62' . ltrim($pasien->nomor_telepon, '0');
            $pesan = "Halo {$pasien->nama}, jadwal kontrol Anda telah tiba. Silakan lakukan reservasi ulang melalui website kami: https://webklinik.com/reservasi";

            if (FonnteService::kirimPesan($nomor, $pesan)) {
                $kontrol->update(['status_notifikasi' => true]);
                $this->info("Notifikasi terkirim ke {$pasien->no_hp}");
                Log::info("Notifikasi berhasil dikirim ke {$pasien->nomor_telepon}");
            } else {
                $this->error("Gagal mengirim notifikasi ke {$pasien->nomor_telepon}");
                Log::error("Pengiriman notifikasi gagal ke {$pasien->nomor_telepon}");
            }
        }
    }
}
