<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalPasien = Pasien::count();
        $totalReservasiHariIni = Reservasi::whereDate('tanggal_reservasi', Carbon::today())->count();
        $mode = $request->query('mode', 'bulan'); // Default ke "bulan"

        if ($mode === 'bulan') {
            // Data Per Bulan
            $labels = [];
            $values = [];
            for ($i = 1; $i <= 12; $i++) {
                $bulan = Carbon::create(null, $i, 1);
                $labels[] = $bulan->translatedFormat('F'); // Nama bulan
                $values[] = Reservasi::whereMonth('tanggal_reservasi', $i)->count();
            }
        } else {
            // Data Per Hari dalam Bulan Sekarang
            $currentMonth = Carbon::now()->month;
            $totalDays = Carbon::now()->daysInMonth;

            $labels = [];
            $values = [];

            for ($day = 1; $day <= $totalDays; $day++) {
                $labels[] = 'Hari ' . $day;
                $values[] = Reservasi::whereDay('tanggal_reservasi', $day)
                    ->whereMonth('tanggal_reservasi', $currentMonth)
                    ->count();
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'labels' => $labels,
                'values' => $values
            ]);
        }

        return view('home', compact('labels', 'values', 'mode', 'totalPasien', 'totalReservasiHariIni'));
    }
}
