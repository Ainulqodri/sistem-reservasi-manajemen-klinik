@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3 rounded shadow">
            <h4 class="fw-bold">Edit Rekam Medis</h4>
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

        <form action="{{ route('rekam_medis.update', $rekam_medis->id_perawatan) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_reservasi" value="{{ $rekam_medis->id_reservasi }}">
            <input type="hidden" name="id_pasien" value="{{ $rekam_medis->id_pasien }}">

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
                                            <option value=""
                                                {{ old('gol_darah', $rekam_medis->gol_darah) == '-' ? 'selected' : '' }}
                                                disabled>
                                                Pilih Gol Darah</option>
                                            <option value="A"
                                                {{ old('gol_darah', $rekam_medis->gol_darah) == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B"
                                                {{ old('gol_darah', $rekam_medis->gol_darah) == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="AB"
                                                {{ old('gol_darah', $rekam_medis->gol_darah) == 'AB' ? 'selected' : '' }}>AB
                                            </option>
                                            <option value="O"
                                                {{ old('gol_darah', $rekam_medis->gol_darah) == 'O' ? 'selected' : '' }}>O
                                            </option>
                                        </select>
                                    </div>

                                    @php
                                        $options = ['Ada', 'Tidak Ada', '-']; // Sesuai dengan ENUM di database
                                    @endphp

                                    @foreach (['penyakit_jantung', 'diabetes', 'alergi_obat', 'alergi_makanan', 'hepatitis', 'hemofili'] as $field)
                                        <div class="mb-2">
                                            <label for="{{ $field }}"
                                                class="form-label fw-bold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                            <select name="{{ $field }}" id="{{ $field }}"
                                                class="form-select">
                                                <option value=""
                                                    {{ old($field, $rekam_medis->$field) == '-' ? 'selected' : '' }}
                                                    disabled>
                                                    Pilih Status</option>
                                                @foreach ($options as $option)
                                                    <option value="{{ $option }}"
                                                        {{ old($field, $rekam_medis->$field) == $option ? 'selected' : '' }}>
                                                        {{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach

                                    <div class="mb-2">
                                        <label for="tekanan_darah" class="form-label fw-bold d-block">Tekanan Darah</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control me-2" style="width: 80px"
                                                name="tekanan_darah_mm" placeholder="mm"
                                                value="{{ old('tekanan_darah_mm', $rekam_medis->tekanan_darah_mm) }}">
                                            <input type="number" class="form-control" style="width: 80px"
                                                name="tekanan_darah_hg" placeholder="hg"
                                                value="{{ old('tekanan_darah_hg', $rekam_medis->tekanan_darah_hg) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="tanggal_perawatan" class="form-label fw-bold">Tanggal Perawatan</label>
                                        <input type="date" name="tanggal_perawatan" id="tanggal_perawatan"
                                            class="form-control"
                                            value="{{ old('tanggal_perawatan', $tanggal_perawatan ?? date('Y-m-d')) }}"
                                            required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="jenis_gigi" class="form-label fw-bold">Gigi</label>
                                        <select name="jenis_gigi" id="jenis_gigi" class="form-select">
                                            <option value="" disabled>Pilih Gigi</option>
                                            @foreach (['geraham', 'seri', 'taring', 'bungsu', 'premolar'] as $gigi)
                                                <option value="{{ $gigi }}"
                                                    {{ old('jenis_gigi', $rekam_medis->jenis_gigi) == $gigi ? 'selected' : '' }}>
                                                    {{ ucfirst($gigi) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="keluhan" class="form-label fw-bold">Keluhan/Diagnosa</label>
                                        <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required>{{ $rekam_medis->keluhan }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="tindakan" class="form-label fw-bold">Tindakan</label>
                                        <textarea name="tindakan" id="tindakan" class="form-control" rows="3" required>{{ $rekam_medis->tindakan }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $rekam_medis->keterangan }}</textarea>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-check-label fw-bold" for="perlu_kontrol">Perlu
                                                Kontrol?</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="perlu_kontrol"
                                                    name="perlu_kontrol" value="1"
                                                    {{ $jadwal_kontrol ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="jadwal_kontrol_form"
                                        style="display: {{ $jadwal_kontrol ? 'block' : 'none' }}; margin-top: 10px;">
                                        <label for="tanggal_kontrol">Tanggal Kontrol:</label>
                                        <input type="date" name="tanggal_kontrol" class="form-control"
                                            value="{{ $jadwal_kontrol->tanggal_kontrol ?? '' }}">
                                    </div>
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
                            <p><strong>ID Reservasi:</strong> {{ $rekam_medis->id_reservasi }}</p>
                            <p><strong>Nama Pasien:</strong> {{ $rekam_medis->pasien->nama }}</p>
                            <p><strong>No HP:</strong> {{ $rekam_medis->pasien->nomor_telepon }}</p>
                            <p><strong>Alamat:</strong> {{ $rekam_medis->pasien->alamat }}</p>
                            <p><strong>Tanggal Kunjungan:</strong> {{ $rekam_medis->reservasi->tanggal_reservasi }}</p>
                            <p><strong>Waktu Kunjungan:</strong> {{ $rekam_medis->reservasi->waktu_reservasi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("perlu_kontrol");
            const jadwalForm = document.getElementById("jadwal_kontrol_form");

            checkbox.addEventListener("change", function() {
                jadwalForm.style.display = this.checked ? "block" : "none";
            });
        });
    </script>
@endsection
