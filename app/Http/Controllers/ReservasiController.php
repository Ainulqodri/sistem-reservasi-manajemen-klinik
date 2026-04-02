<?php

namespace App\Http\Controllers;

use App\Models\jadwalpraktik;
use App\Models\Reservasi;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Reservasi::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('tanggal_reservasi', 'like', "%{$search}%");
        }

        $reservasiHariIni = $query->whereDate('tanggal_reservasi', now()->toDateString('Y-m-d'))->paginate(8);

        return view('reservasi.index', compact('reservasiHariIni', 'search'));
    }


    public function create()
    {
        $pasien = Pasien::all();
        return view('reservasi.create', compact('pasien'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_reservasi' => 'required|date|after_or_equal:today',
            'waktu_reservasi' => 'required',
            'keluhan' => 'required',
        ]);

        $user = Auth::user();

        // Cari pasien berdasarkan user_id
        $pasien = Pasien::where('id_pasien', $user->id_pasien)->first();

        // Simpan data reservasi dengan id_pasien yang valid
        Reservasi::create([
            'id_pasien' => $pasien->id_pasien,  // ID pasien harus ada
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'waktu_reservasi' => $request->waktu_reservasi,
            'keluhan' => $request->keluhan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil!',
            'redirect' => url('/') . '#reservasi'
        ]);
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $pasien = Pasien::all();
        return view('reservasi.edit', compact('reservasi', 'pasien'));
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->all());
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }

    public function showSlots(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today('Asia/Jakarta')->toDateString());

        // Pastikan nama hari sesuai format di database
        $dayOfWeek = strtolower(Carbon::parse($tanggal)->locale('id')->translatedFormat('l'));

        // Ambil jadwal dokter berdasarkan hari
        $jadwal = jadwalpraktik::whereRaw('LOWER(hari) = ?', [$dayOfWeek])->first();

        if (!$jadwal) {
            return response()->json([]);
        }

        $slots = [];
        $startTime = Carbon::today('Asia/Jakarta')->setTimeFromTimeString($jadwal->jam_buka);
        $endTime = Carbon::today('Asia/Jakarta')->setTimeFromTimeString($jadwal->jam_tutup);
        $durasi = $jadwal->durasi_slot;

        $currentTime = Carbon::now('Asia/Jakarta');

        while ($startTime->lte($endTime)) {
            $slotTime = $startTime->format('H:i');
            $isPast = ($tanggal == Carbon::today('Asia/Jakarta')->toDateString() && $startTime->lte($currentTime));

            $slots[] = [
                'time' => $slotTime,
                'past' => $isPast
            ];
            $startTime->addMinutes($durasi);
        }

        // Ambil slot yang sudah dipesan di database
        $reservedSlots = Reservasi::where('tanggal_reservasi', $tanggal)
            ->pluck('waktu_reservasi')
            ->toArray();

        // Perbaiki loop data untuk menghindari slot yang sudah lewat tetap muncul
        $data = [];
        foreach ($slots as $slot) {
            $slotDB = $slot['time'] . ':00';
            $isReserved = $slot['past'] || in_array($slotDB, $reservedSlots);

            $data[] = [
                'time' => $slot['time'],
                'reserved' => $isReserved
            ];
        }

        return response()->json($data);
    }

    public function riwayat()
    {
        // Ambil semua reservasi, bisa ditambahkan filter nanti
        $reservasiSemua = Reservasi::orderBy('tanggal_reservasi', 'desc')->paginate(7);

        return view('reservasi.riwayat', compact('reservasiSemua'));
    }
}
