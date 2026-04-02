@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Dokter</h1>
        <form action="{{ route('dokter.update', $dokter->id_dokter) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="nama">Nama Dokter</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $dokter->nama_dokter }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ $dokter->alamat }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                    value="{{ $dokter->no_telepon }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                @if ($dokter->foto)
                    <div class="mb-3">
                        <img id="existing-preview" src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Lama"
                            style="max-width: 30%; height: auto;" />
                    </div>
                @endif
                @error('foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div id="preview-container">
                <img id="foto-preview" src="" alt="Preview Foto"
                    style="display: none; max-width: 30%; height: auto; margin-top: 10px;" />
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
    </div>
@endsection
@section('javascript')
    <script>
        document.getElementById("foto").addEventListener("change", function(event) {
            const file = event.target.files[0]; // Mengambil file yang diunggah
            const preview = document.getElementById("foto-preview");
            const existingPreview = document.getElementById("existing-preview");

            if (file) {
                const reader = new FileReader(); // Membuat FileReader untuk membaca file
                reader.onload = function(e) {
                    preview.src = e.target.result; // Menetapkan data gambar ke atribut src
                    preview.style.display = "block"; // Menampilkan gambar
                };
                reader.readAsDataURL(file); // Membaca file sebagai URL Data

                // Sembunyikan gambar lama jika ada
                if (existingPreview) {
                    existingPreview.style.display = "none";
                }
            } else {
                preview.style.display = "none"; // Menyembunyikan gambar jika tidak ada file
                preview.src = "";

                if (existingPreview) {
                    existingPreview.style.display = "block";
                }
            }
        });
    </script>
@endsection
