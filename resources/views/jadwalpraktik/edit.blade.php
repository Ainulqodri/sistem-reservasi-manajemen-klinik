@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3 rounded shadow">
            <h4 class="fw-bold">Edit Jadwal Praktik Dokter</h4>
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

        <form action="{{ route('jadwalpraktik.update', $jadwalpraktik->id_jadwal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id_dokter" class="form-label">Dokter</label>
                <select name="id_dokter" id="id_dokter" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->id_dokter }}"
                            {{ $jadwalpraktik->id_dokter == $d->id_dokter ? 'selected' : '' }}>
                            {{ $d->nama_dokter }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <select name="hari" id="hari" class="form-control" required>
                    <option value="">-- Pilih Hari --</option>
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                        <option value="{{ $h }}" {{ $jadwalpraktik->hari == $h ? 'selected' : '' }}>
                            {{ $h }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jam_buka" class="form-label">Jam Buka</label>
                <input type="time" name="jam_buka" id="jam_buka" class="form-control"
                    value="{{ $jadwalpraktik->jam_buka }}" required>
            </div>

            <div class="mb-3">
                <label for="jam_tutup" class="form-label">Jam Tutup</label>
                <input type="time" name="jam_tutup" id="jam_tutup" class="form-control"
                    value="{{ $jadwalpraktik->jam_tutup }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('jadwalpraktik.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
