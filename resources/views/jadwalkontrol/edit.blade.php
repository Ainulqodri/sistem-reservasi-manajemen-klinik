@extends('layouts.app')

@section('content')
    <div class="container d-flex">
        <div class="card shadow-sm w-50">
            <div class="card-header bg-primary text-white">
                <h4 class="fw-bold mb-0">Edit Jadwal Kontrol Pasien</h4>
            </div>

            <div class="card-body">
                {{-- Tampilkan pesan error jika ada --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Informasi Pasien --}}
                <div class="mb-4">
                    <h5 class="fw-bold">Nama: <span class="fw-normal">{{ $jadwalkontrol->rekamMedis->pasien->nama }}</span></h5>
                    <h5 class="fw-bold">Alamat: <span class="fw-normal">{{ $jadwalkontrol->rekamMedis->pasien->alamat }}</span></h5>
                    <h5 class="fw-bold">No HP: <span class="fw-normal">{{ $jadwalkontrol->rekamMedis->pasien->nomor_telepon }}</span></h5>
                </div>

                {{-- Form Edit Jadwal Kontrol --}}
                <form action="{{ route('jadwalkontrol.update', $jadwalkontrol->id_kontrol) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_rekam_medis" value="{{ $jadwalkontrol->id_rekam_medis }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_kontrol" class="form-label fw-bold">Tanggal Kontrol</label>
                                <input type="date" name="tanggal_kontrol" id="tanggal_kontrol" class="form-control" required
                                    value="{{ old('tanggal_kontrol', $jadwalkontrol->tanggal_kontrol) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-25">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('jadwalkontrol.index') }}" class="btn btn-secondary w-25">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
