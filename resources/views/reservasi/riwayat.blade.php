@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">Riwayat Reservasi</h4>
        </div>
        <hr>

        <!-- Tombol Kembali ke Reservasi Hari Ini -->
        <div class="mb-3">
            <a href="{{ route('reservasi.index') }}" class="btn btn-primary btn-sm">⬅ Kembali ke Reservasi Hari Ini</a>
        </div>

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
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasiSemua as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->alamat }}</td>
                        <td>{{ $r->no_hp }}</td>
                        <td>{{ $r->tanggal_reservasi }}</td>
                        <td>{{ $r->waktu_reservasi }}</td>
                        <td>{{ $r->status }}</td>
                        <td>{{ $r->keluhan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $reservasiSemua->links() }}
        </div>
    </div>
@endsection
