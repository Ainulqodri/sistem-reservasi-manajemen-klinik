<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function kirimPesan($target, $message)
    {
        $token = config('services.fonnte.token'); // Ambil token dari config/services.php
        $apiUrl = 'https://api.fonnte.com/send';

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post($apiUrl, [
            'target'      => $target,
            'message'     => $message,
            'countryCode' => '62', // kode negara Indonesia
        ]);

        return $response->successful();
    }
}
