@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3 rounded shadow">
            <h4 class="fw-bold">Tambah Reservasi</h4>
        </div>
        <hr>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_pasien" class="form-label">Nama Pasien</label>
                <select name="id_pasien" class="form-control" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach ($pasien as $p)
                        <option value="{{ $p->id_pasien }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="no_antrian" class="form-label">Nomor Antrian</label>
                <input type="number" name="no_antrian" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
                <input type="date" name="tanggal_reservasi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="waktu_reservasi" class="form-label">Waktu Reservasi</label>
                <input type="time" name="waktu_reservasi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea name="keluhan" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
