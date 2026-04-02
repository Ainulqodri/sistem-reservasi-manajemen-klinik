<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Pasien::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%");
        }

        $pasien = $query->paginate(8);
        return view('pasien.index', compact('pasien', 'search'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function show($id)
    {
        $pasien = Pasien::with('rekamMedis')->findOrFail($id);
        return view('pasien.detail', compact('pasien'));
    }

    public function destroy($id)
    {
        Pasien::findOrFail($id)->delete();
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
