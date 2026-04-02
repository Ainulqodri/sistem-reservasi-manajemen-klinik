@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3 rounded shadow">
            <h4 class="fw-bold">Rekam Medis</h4>
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

        <form action="{{ route('rekam_medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_reservasi" value="{{ $reservasi->id_reservasi }}">
            <input type="hidden" name="id_pasien" value="{{ $reservasi->id_pasien }}">

            {{-- Rekam Medis --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="pt-1">Rekam Medis</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="gol_darah" class="form-label fw-bold">Gol Darah</label>
                                        <select name="gol_darah" id="gol_darah" class="form-select">
                                            <option value="">Pilih Gol Darah</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="penyakit_jantung" class="form-label fw-bold">Penyakit Jantung</label>
                                        <select name="penyakit_jantung" id="penyakit_jantung" class="form-select">
                                            <option value="" selected>Pilih Status</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="diabetes" class="form-label fw-bold">Diabetes</label>
                                        <select name="diabetes" id="diabetes" class="form-select">
                                            <option value="" selected>Pilih Status</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="alergi_obat" class="form-label fw-bold">Alergi Obat</label>
                                        <select name="alergi_obat" id="alergi_obat" class="form-select">
                                            <option value="" selected>Pilih Status</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="alergi_makanan" class="form-label fw-bold">Alergi Makanan</label>
                                        <select name="alergi_makanan" id="alergi_makanan" class="form-select">
                                            <option value="" selected>Pilih Status</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="hepatitis" class="form-label fw-bold">Hepatitis</label>
                                        <select name="hepatitis" id="hepatitis" class="form-select">
                                            <option value="" selected>Pilih Status</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="hemofili" class="form-label fw-bold">Hemofili</label>
                                        <select name="hemofili" id="hemofili" class="form-select">
                                            <option value="" selected>Pilih Status</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="tekanan_darah" class="form-label fw-bold d-block">Tekanan Darah</label>
                                        <input type="number" class="form-control d-inline" style="width: 80px"
                                            name="tekanan_darah_mm" placeholder="mm">
                                        <input type="number" class="form-control d-inline" style="width: 80px"
                                            name="tekanan_darah_hg" placeholder="hg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="tanggal_perawatan" class="form-label fw-bold">Tanggal
                                            Perawatan</label>
                                        <input type="date" name="tanggal_perawatan"
                                            value="{{ old('tanggal_perawatan', date('Y-m-d')) }}" id="tanggal_perawatan"
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="jenis_gigi" class="form-label fw-bold">Gigi</label>
                                        <select name="jenis_gigi" id="jenis_gigi" class="form-select">
                                            <option disabled selected>Pilih Gigi</option>
                                            <option value="geraham">Geraham</option>
                                            <option value="seri">Seri</option>
                                            <option value="taring">Taring</option>
                                            <option value="bungsu">Bungsu</option>
                                            <option value="premolar">Premolar</option>
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label for="keluhan" class="form-label fw-bold">Keluhan/Diagnosa</label>
                                        <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required>{{ $reservasi->keluhan }}</textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label for="tindakan" class="form-label fw-bold">Tindakan</label>
                                        <textarea name="tindakan" id="tindakan" class="form-control" rows="3" required
                                            placeholder="tuliskan tindakan yang dilakukan"></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3"
                                            placeholder="tuliskan keterangan tambahan (opsional)"></textarea>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-check-label fw-bold" for="perlu_kontrol">Perlu
                                                Kontrol?</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="perlu_kontrol"
                                                    name="perlu_kontrol" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="jadwal_kontrol_form" style="display: none; margin-top: 10px;">
                                    <label>Tanggal Kontrol:</label>
                                    <input type="date" name="tanggal_kontrol" class="form-control">
                                </div>
                            </div>
                            <div class="float-end mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="pt-1">Data Reservasi</h6>
                        </div>
                        <div class="card-body">
                            <!-- Tampilkan data reservasi -->
                            <div class="mb-4">
                                <p><strong>ID Reservasi:</strong> {{ $reservasi->id_reservasi }}</p>
                                <p><strong>Nama Pasien:</strong> {{ $reservasi->nama }}</p>
                                <p><strong>No HP:</strong> {{ $reservasi->no_hp }}</p>
                                <p><strong>Alamat:</strong> {{ $reservasi->alamat }}</p>
                                <p><strong>Tanggal Kunjungan:</strong> {{ $reservasi->tanggal_reservasi }}</p>
                                <p><strong>Waktu Kunjungan:</strong> {{ $reservasi->waktu_reservasi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
