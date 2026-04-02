<?php

use Carbon\Carbon;
use App\Models\JadwalKontrol;
use App\Models\RekamMedis;
use App\Services\FonnteService; // Pastikan service Fonnte sudah dibuat

if (!function_exists('kirimNotifikasiKontrol')) {
    function kirimNotifikasiKontrol()
    {
        $hariIni = Carbon::today();

        // Ambil jadwal kontrol yang jatuh pada hari ini & belum dikirimi notifikasi
        $jadwalKontrol = JadwalKontrol::where('tanggal_kontrol', $hariIni)
            ->where('notifikasi_terkirim', false)
            ->get();

        foreach ($jadwalKontrol as $kontrol) {
            // Ambil nomor HP pasien dari relasi rekam medis
            $pasien = $kontrol->rekamMedis->pasien;

            if (!$pasien || !$pasien->no_hp) continue; // Jika tidak ada pasien atau nomor HP, skip

            $pesan = "Halo {$pasien->nama}, jadwal kontrol Anda sudah tiba. 
Silakan lakukan reservasi di website kami: https://webklinik.com/reservasi";

            // Kirim notifikasi ke WhatsApp pasien
            // FonnteService::kirimPesan($pasien->no_hp, $pesan);

            // Tandai bahwa notifikasi sudah terkirim
            $kontrol->update(['notifikasi_terkirim' => true]);
        }
    }
}
