@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3 rounded shadow">
            <h4 class="fw-bold">Tambah Jadwal Kontrol Pasien</h4>
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

        <form action="{{ route('jadwalkontrol.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_pasien" class="form-label">Pasien</label>
                <select name="id_pasien" id="id_pasien" class="form-control" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach ($pasien as $p)
                        <option value="{{ $p->id_pasien }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="tanggal_kontrol" class="form-label">Tanggal Kontrol</label>
                <input type="date" name="tanggal_kontrol" id="tanggal_kontrol" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="waktu_kontrol" class="form-label">Waktu Kontrol</label>
                <input type="time" name="waktu_kontrol" id="waktu_kontrol" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status_notifikasi" class="form-label">Status Notifikasi</label>
                <select name="status_notifikasi" id="status_notifikasi" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Belum Dikirim">Belum Dikirim</option>
                    <option value="Terkirim">Terkirim</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jadwalkontrol.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
