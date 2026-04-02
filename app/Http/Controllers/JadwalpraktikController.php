<?php

namespace App\Http\Controllers;

use App\Models\Jadwalpraktik;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalpraktikController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Jadwalpraktik::query();

        if ($search) {
            $query->where('hari', 'like', "%{$search}%");
        }
        $jadwalpraktik = $query->paginate(8);
        return view('jadwalpraktik.index', compact('jadwalpraktik'));
    }

    public function create()
    {
        $dokter = Dokter::all();
        return view('jadwalpraktik.create', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'id_dokter' => 'required|exists:dokter,id_dokter',
            'hari' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'durasi_slot' => 'required'
        ]);

        Jadwalpraktik::create($request->all());
        return redirect()->route('jadwalpraktik.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwalpraktik = Jadwalpraktik::findOrFail($id);
        $dokter = Dokter::all();
        return view('jadwalpraktik.edit', compact('jadwalpraktik', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'hari' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'durasi_slot' => 'required'
        ]);

        $jadwalpraktik = Jadwalpraktik::findOrFail($id);
        $jadwalpraktik->update($request->all());
        return redirect()->route('jadwalpraktik.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwalpraktik = JadwalPraktik::where('id_jadwal', $id)->firstOrFail();
        $jadwalpraktik->delete();

        return redirect()->route('jadwalpraktik.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
