@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Dokter</h1>
        <form action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="nama">Nama Dokter</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="foto" class="form-label">foto</label>
                <input type="file" class="form-control" id="foto" name="foto" accept=".png, .jpg, .jpeg"
                    placeholder="Masukkan foto">
            </div>
            <div id="preview-container">
                <img id="foto-preview" src="" alt="Preview foto"
                    style="display: none; max-width: 100%; height: auto; margin-top: 10px;" />
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

@section('javascript')
    <script>
        document.getElementById("foto").addEventListener("change", function(event) {
            const file = event.target.files[0]; // Mengambil file yang diunggah
            const preview = document.getElementById("foto-preview");

            if (file) {
                const reader = new FileReader(); // Membuat FileReader untuk membaca file
                reader.onload = function(e) {
                    preview.src = e.target.result; // Menetapkan data gambar ke atribut src
                    preview.style.display = "block"; // Menampilkan gambar
                };
                reader.readAsDataURL(file); // Membaca file sebagai URL Data
            } else {
                preview.style.display = "none"; // Menyembunyikan gambar jika tidak ada file
                preview.src = "";
            }
        });
    </script>
@endsection
