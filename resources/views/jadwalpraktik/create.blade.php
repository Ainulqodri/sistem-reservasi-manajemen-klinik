@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3 rounded shadow">
            <h4 class="fw-bold">Tambah Jadwal Praktik Dokter</h4>
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

        <form action="{{ route('jadwalpraktik.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_dokter" class="form-label">Dokter</label>
                <select name="id_dokter" id="id_dokter" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->id_dokter }}">{{ $d->nama_dokter }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <select name="hari" id="hari" class="form-control" required>
                    <option selected disabled>-- Pilih Hari --</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="jam_mulai" class="form-label">Jam Buka</label>
                <input type="time" name="jam_buka" id="jam_buka" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="jam_selesai" class="form-label">Jam Tutup</label>
                <input type="time" name="jam_tutup" id="jam_tutup" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="durasi_slot" class="form-label">Durasi waktu</label>
                <input type="number" name="durasi_slot" id="durasi_slot" value="15" min="5" step="5" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jadwalpraktik.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
