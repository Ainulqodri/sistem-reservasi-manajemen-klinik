@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="fw-bold text-center">Detail Pasien</h3>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <!-- Informasi Pasien -->
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5>Informasi Pasien</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</p>
                            <p><strong>No. HP:</strong> {{ $pasien->nomor_telepon }}</p>
                            <p><strong>Alamat:</strong> {{ $pasien->alamat }}</p>
                            <p><strong>Tempat Lahir:</strong> {{ $pasien->tempat_lahir }}</p>
                            <p><strong>Tanggal Lahir:</strong> {{ $pasien->tanggal_lahir }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Riwayat Rekam Medis -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Riwayat Rekam Medis</h5>
                        </div>
                        <div class="card-body">
                            @if ($pasien->rekamMedis->isEmpty())
                                <p class="text-muted text-center">Belum ada rekam medis.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Tanggal Perawatan</th>
                                            <th>Keluhan</th>
                                            <th>Tindakan</th>
                                            <th>Keterangan</th>
                                            <th>Dokter</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pasien->rekamMedis as $rekam)
                                            <tr>
                                                <td>{{ date('d M Y', strtotime($rekam->tanggal_perawatan)) }}</td>
                                                <td>{{ $rekam->keluhan }}</td>
                                                <td>{{ $rekam->tindakan }}</td>
                                                <td>{{ $rekam->keterangan ?? '-' }}</td>
                                                <td>{{ $rekam->dokter->nama ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('rekam_medis.show', $rekam->id_perawatan) }}"
                                                        class="btn btn-info btn-sm">
                                                        Lihat Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
