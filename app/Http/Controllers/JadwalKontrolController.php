<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwalkontrol;
use App\Models\Pasien;

class JadwalKontrolController extends Controller
{
    /**
     * Menampilkan daftar jadwal kontrol pasien.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = jadwalkontrol::with('pasien');

        if ($search) {
            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")->orWhere('tanggal_kontrol', 'like', "%{$search}%");
            });
        }
        $jadwalkontrol = $query->paginate(8);
        return view('jadwalkontrol.index', compact('jadwalkontrol'));
    }

    /**
     * Menampilkan form untuk mengedit jadwal kontrol.
     */
    public function edit($id)
    {
        $jadwalkontrol = jadwalkontrol::findOrFail($id);
        return view('jadwalkontrol.edit', compact('jadwalkontrol'));
    }

    /**
     * Memperbarui data jadwal kontrol yang telah diedit.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_rekam_medis' => 'required|exists:rekam_medis,id_perawatan',
            'tanggal_kontrol' => 'required|date',
        ]);

        $jadwalkontrol = jadwalkontrol::findOrFail($id);
        $jadwalkontrol->update($request->all());

        return redirect()->route('jadwalkontrol.index')->with('success', 'Jadwal kontrol berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal kontrol dari database.
     */
    public function destroy($id)
    {
        $jadwalkontrol = jadwalkontrol::findOrFail($id);
        $jadwalkontrol->delete();

        return redirect()->route('jadwalkontrol.index')->with('success', 'Jadwal kontrol berhasil dihapus.');
    }
}
