@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">RESERVASI</h4>
        </div>
        <hr>
        <!-- Tombol untuk melihat semua reservasi -->
        <div class="d-flex justify-content-between">
            <div class="mb-3">
                <a href="{{ route('reservasi.riwayat') }}" class="btn btn-link btn-sm">Lihat Riwayat Reservasi</a>
            </div>
            <!-- Form Pencarian -->
            <form action="{{ route('reservasi.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Pasien..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if (request('search'))
                        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <h6>Reservasi Hari ini</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Tanggal Reservasi</th>
                    <th>Waktu Reservasi</th>
                    <th>Status</th>
                    <th>Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservasiHariIni as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->alamat }}</td>
                        <td>{{ $r->no_hp }}</td>
                        <td>{{ $r->tanggal_reservasi }}</td>
                        <td>{{ $r->waktu_reservasi }}</td>
                        <td>{{ $r->status }}</td>
                        <td>{{ $r->keluhan }}</td>
                        <td>
                            @if ($r->status == 'Menunggu')
                                <a href="{{ route('rekam_medis.create', $r->id_reservasi) }}"
                                    class="btn btn-outline-primary btn-sm">Rekam Medis</a>
                            @else
                                ✅ Sudah Direkam
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center fw-bold">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $reservasiHariIni->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    @endsection
