@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="fw-bold mb-0">Detail Rekam Medis</h4>
            </div>

            <div class="card-body m-2">
                {{-- Informasi Pasien --}}
                <div class="row mb-4">
                    <div class="col-md-6 border-3 border-primary border-start">
                        <h5 class="fw-bold text-primary">Informasi Pasien</h5>
                        <p><strong>Nama:</strong> {{ $rekamMedis->pasien->nama }}</p>
                        <p><strong>No HP:</strong> {{ $rekamMedis->pasien->nomor_telepon }}</p>
                        <p><strong>Alamat:</strong> {{ $rekamMedis->pasien->alamat }}</p>
                    </div>
                    <div class="col-md-6 border-3 border-primary border-start">
                        <h5 class="fw-bold text-primary">Detail Rekam Medis</h5>
                        <p><strong>Tanggal Perawatan:</strong> {{ $rekamMedis->tanggal_perawatan }}</p>
                        <p><strong>Golongan Darah:</strong> {{ $rekamMedis->gol_darah }}</p>
                        <p><strong>Tekanan Darah:</strong> {{ $rekamMedis->tekanan_darah_mm }}/{{ $rekamMedis->tekanan_darah_hg }} mmHg</p>
                    </div>
                </div>

                {{-- Riwayat Penyakit --}}
                <div class="row mb-4">
                    <div class="col-md-6 border-3 border-primary border-start">
                        <h5 class="fw-bold text-primary">Riwayat Penyakit</h5>
                        <ul>
                            <li>Penyakit Jantung: {{ $rekamMedis->penyakit_jantung }}</li>
                            <li>Diabetes: {{ $rekamMedis->diabetes }}</li>
                            <li>Alergi Obat: {{ $rekamMedis->alergi_obat }}</li>
                            <li>Alergi Makanan: {{ $rekamMedis->alergi_makanan }}</li>
                            <li>Hepatitis: {{ $rekamMedis->hepatitis }}</li>
                            <li>Hemofili: {{ $rekamMedis->hemofili }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6 border-3 border-primary border-start">
                        <h5 class="fw-bold text-primary">Perawatan</h5>
                        <p><strong>Jenis Gigi:</strong> {{ $rekamMedis->jenis_gigi }}</p>
                        <p><strong>Keluhan/Diagnosa:</strong> {{ $rekamMedis->keluhan }}</p>
                        <p><strong>Tindakan:</strong> {{ $rekamMedis->tindakan }}</p>
                        <p><strong>Keterangan:</strong> {{ $rekamMedis->keterangan ?? '-' }}</p>
                    </div>
                </div>

                {{-- Jadwal Kontrol --}}
                @if ($rekamMedis->perlu_kontrol)
                    <div class="alert alert-warning text-center">
                        <strong>Pasien perlu kontrol kembali pada tanggal:</strong>
                        <h5 class="fw-bold">{{ $rekamMedis->tanggal_kontrol }}</h5>
                    </div>
                @endif

                <a href="{{ route('rekam_medis.index') }}" class="btn btn-outline-secondary btn-sm">< Kembali</a>
            </div>
        </div>
    </div>
@endsection
