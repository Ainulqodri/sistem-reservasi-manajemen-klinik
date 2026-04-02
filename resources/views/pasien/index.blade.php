@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">DATA PASIEN</h4>
        </div>
        <hr>
        <form action="{{ route('pasien.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Pasien..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                @if(request('search'))
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
        </form>
        <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">Tambah Pasien</a>
        <div class="bg-white p-2 rounded shadow">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Pekerjaan</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasien as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->tanggal_lahir }}</td>
                            <td>{{ $p->jenis_kelamin }}</td>
                            <td>{{ $p->pekerjaan }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->nomor_telepon }}</td>
                            <td>
                                <a href="{{ route('pasien.show', $p->id_pasien) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('pasien.edit', $p->id_pasien) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pasien.destroy', $p->id_pasien) }}" method="POST"
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
                {{ $pasien->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
@endsection
