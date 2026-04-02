@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">DATA DOKTER</h4>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">Tambah Dokter</a>
            <form action="{{ route('dokter.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama dokter..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if (request('search'))
                        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
        <div class="bg-white p-2 rounded shadow">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokter as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama_dokter }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>{{ $d->no_telepon }}</td>
                            <td><img src="{{ asset('storage/' . $d->foto) }}" alt="Foto Dokter" class="mt-3"
                                    style="width: 150px;">
                            </td>

                            <td>
                                <a href="{{ route('dokter.edit', $d->id_dokter) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('dokter.destroy', $d->id_dokter) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center fw-bold">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $dokter->links() }}
                </div>
            </div>
        </div>
    @endsection
