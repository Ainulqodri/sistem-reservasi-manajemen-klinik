@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ubah Pasien</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pasien.update', $pasien->id_pasien) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" value="{{ $pasien->nama }}" name="nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}"
                            name="tanggal_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" {{ $pasien->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ $pasien->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="varchar" class="form-control" id="pekerjaan" value="{{ $pasien->pekerjaan }}"
                            name="pekerjaan" required>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $pasien->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" value="{{ $pasien->nomor_telepon }}"
                                id="nomor_telepon" name="nomor_telepon" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
