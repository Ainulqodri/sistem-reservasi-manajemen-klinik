@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">JADWAL PRAKTIK DOKTER</h4>
        </div>
        <hr>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('jadwalpraktik.create') }}" class="btn btn-primary">Tambah Jadwal Dokter</a>
            <form action="{{ route('jadwalpraktik.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan hari"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if (request('search'))
                        <a href="{{ route('jadwalpraktik.index') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalpraktik as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $j->dokter->nama_dokter ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ $j->jam_buka }}</td>
                        <td>{{ $j->jam_tutup }}</td>
                        <td>
                            <a href="{{ route('jadwalpraktik.edit', $j->id_jadwal) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('jadwalpraktik.destroy', $j->id_jadwal) }}" method="POST"
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
            {{ $jadwalpraktik->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
