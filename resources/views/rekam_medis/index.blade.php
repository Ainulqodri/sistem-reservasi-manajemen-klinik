@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">REKAM MEDIS</h4>
        </div>
        <hr>
        <form action="{{ route('rekam_medis.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Pasien..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                @if (request('search'))
                    <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Keluhan/Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Tanggal Perawatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekam_medis as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->pasien->nama }}</td>

                        <td>{{ $r->keluhan }}</td>
                        <td>{{ $r->tindakan }}</td>
                        <td>{{ $r->tanggal_perawatan->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('rekam_medis.show', $r->id_perawatan) }}"
                                class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('rekam_medis.edit', $r->id_perawatan) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('rekam_medis.destroy', $r->id_perawatan) }}" method="POST"
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
                {{ $rekam_medis->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    @endsection
