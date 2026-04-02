<?php

namespace App\Http\Controllers;

use App\Models\jadwalkontrol;
use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = RekamMedis::with('pasien');

        if ($search) {
            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }
        $rekam_medis = $query->paginate(8);
        return view('rekam_medis.index', compact('rekam_medis', 'search'));
    }

    public function create($id)
    {
        $reservasi = Reservasi::with('pasien')->findOrFail($id);
        return view('rekam_medis.create', compact('reservasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien'             => 'required|exists:pasien,id_pasien',
            'id_reservasi'          => 'required|exists:reservasi,id_reservasi',
            'gol_darah'             => 'nullable|string',
            'penyakit_jantung'      => 'nullable|string',
            'diabetes'              => 'nullable|string',
            'alergi_obat'           => 'nullable|string',
            'alergi_makanan'        => 'nullable|string',
            'hepatitis'             => 'nullable|string',
            'hemofili'              => 'nullable|string',
            'tekanan_darah_mm'      => 'nullable|integer',
            'tekanan_darah_hg'      => 'nullable|integer',
            'jenis_gigi'            => 'required|string',
            'keluhan'              => 'required|string',
            'tindakan'              => 'required|string',
            'keterangan'            => 'nullable|string',
            'tanggal_perawatan'     => 'required|date',
            'tanggal_kontrol' => 'nullable|required_if:perlu_kontrol,1|date',
        ]);

        $rekam_medis = new RekamMedis();
        $rekam_medis->id_pasien         = $validated['id_pasien'];
        $rekam_medis->id_reservasi      = $validated['id_reservasi'];
        $rekam_medis->gol_darah         = !empty($validated['gol_darah']) ? $validated['gol_darah'] : '-';
        $rekam_medis->penyakit_jantung  = !empty($validated['penyakit_jantung']) ? $validated['penyakit_jantung'] : '-';
        $rekam_medis->diabetes          = !empty($validated['diabetes']) ? $validated['diabetes'] : '-';
        $rekam_medis->alergi_obat       = !empty($validated['alergi_obat']) ? $validated['alergi_obat'] : '-';
        $rekam_medis->alergi_makanan    = !empty($validated['alergi_makanan']) ? $validated['alergi_makanan'] : '-';
        $rekam_medis->hepatitis         = !empty($validated['hepatitis']) ? $validated['hepatitis'] : '-';
        $rekam_medis->hemofili          = !empty($validated['hemofili']) ? $validated['hemofili'] : '-';
        $rekam_medis->tekanan_darah_mm  = $validated['tekanan_darah_mm'];
        $rekam_medis->tekanan_darah_hg  = $validated['tekanan_darah_hg'];
        $rekam_medis->jenis_gigi        = $validated['jenis_gigi'];
        $rekam_medis->keluhan           = $validated['keluhan'];
        $rekam_medis->tindakan          = $validated['tindakan'];
        $rekam_medis->keterangan        = !empty($validated['keterangan']) ? $validated['keterangan'] : '-';
        $rekam_medis->tanggal_perawatan = $validated['tanggal_perawatan'];

        $rekam_medis->save();
        Reservasi::where('id_reservasi', $request->id_reservasi)->update(['status' => 'selesai']);

        if ($request->perlu_kontrol) {
            jadwalkontrol::create([
                'id_rekam_medis' => $rekam_medis->id_perawatan,
                'id_pasien' => $rekam_medis->pasien->id_pasien,
                'tanggal_kontrol' => $request->tanggal_kontrol,
            ]);
        }

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam Medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rekam_medis = RekamMedis::findOrFail($id);
        $tanggal_perawatan = optional($rekam_medis->tanggal_perawatan)->format('Y-m-d');
        $pasien = Pasien::all();
        $jadwal_kontrol = jadwalkontrol::where('id_rekam_medis', $rekam_medis->id_perawatan)->first();

        return view('rekam_medis.edit', compact('rekam_medis', 'pasien', 'jadwal_kontrol'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pasien'             => 'required|exists:pasien,id_pasien',
            'id_reservasi'          => 'required|exists:reservasi,id_reservasi',
            'gol_darah'             => 'nullable|string',
            'penyakit_jantung'      => 'nullable|string',
            'diabetes'              => 'nullable|string',
            'alergi_obat'           => 'nullable|string',
            'alergi_makanan'        => 'nullable|string',
            'hepatitis'             => 'nullable|string',
            'hemofili'              => 'nullable|string',
            'tekanan_darah_mm'      => 'nullable|integer',
            'tekanan_darah_hg'      => 'nullable|integer',
            'jenis_gigi'            => 'required|string',
            'keluhan'               => 'required|string',
            'tindakan'              => 'required|string',
            'keterangan'            => 'nullable|string',
            'tanggal_perawatan'     => 'required|date',
            'tanggal_kontrol'       => 'nullable|required_if:perlu_kontrol,1|date',
        ]);

        $rekam_medis = RekamMedis::findOrFail($id);
        $rekam_medis->update([
            'id_pasien'         => $validated['id_pasien'],
            'id_reservasi'      => $validated['id_reservasi'],
            'gol_darah'         => $validated['gol_darah'] ?? '-',
            'penyakit_jantung'  => $validated['penyakit_jantung'] ?? '-',
            'diabetes'          => $validated['diabetes'] ?? '-',
            'alergi_obat'       => $validated['alergi_obat'] ?? '-',
            'alergi_makanan'    => $validated['alergi_makanan'] ?? '-',
            'hepatitis'         => $validated['hepatitis'] ?? '-',
            'hemofili'          => $validated['hemofili'] ?? '-',
            'tekanan_darah_mm'  => $validated['tekanan_darah_mm'],
            'tekanan_darah_hg'  => $validated['tekanan_darah_hg'],
            'jenis_gigi'        => $validated['jenis_gigi'],
            'keluhan'           => $validated['keluhan'],
            'tindakan'          => $validated['tindakan'],
            'keterangan'        => $validated['keterangan'] ?? '-',
            'tanggal_perawatan' => $validated['tanggal_perawatan'],
        ]);

        // Update status reservasi ke 'selesai'
        Reservasi::where('id_reservasi', $request->id_reservasi)->update(['status' => 'selesai']);

        // Cek apakah kontrol perlu diperbarui
        if ($request->perlu_kontrol) {
            JadwalKontrol::updateOrCreate(
                ['id_rekam_medis' => $rekam_medis->id_perawatan], // Kondisi pencarian
                [
                    'id_pasien' => $rekam_medis->id_pasien, 
                    'tanggal_kontrol' => $request->tanggal_kontrol // Pastikan ada
                ]
            );            
        } else {
            // Jika tidak perlu kontrol, hapus data jadwal kontrol sebelumnya
            JadwalKontrol::where('id_rekam_medis', $rekam_medis->id_perawatan)->delete();
        }

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        return view('rekam_medis.detail', compact('rekamMedis'));
    }

    public function destroy($id_perawatan)
    {
        RekamMedis::where('id_perawatan', $id_perawatan)->delete();
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }
}
