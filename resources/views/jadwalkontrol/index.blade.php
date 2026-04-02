@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-2 rounded shadow">
            <h4 class="fw-bold">JADWAL KONTROL PASIEN</h4>
        </div>
        <hr>
        <form action="{{ route('jadwalkontrol.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Pasien atau tanggal"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                @if (request('search'))
                    <a href="{{ route('jadwalkontrol.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Tgl Kontrol</th>
                    <th>Status Notifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalkontrol as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->rekamMedis->pasien->nama ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $k->tanggal_kontrol }}</td>
                        <td>{{ $k->status_notifikasi ? 'Terkirim' : 'Belum Dikirim' }}</td>
                        <td>
                            <a href="{{ route('jadwalkontrol.edit', $k->id_kontrol) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('jadwalkontrol.destroy', $k->id_kontrol) }}" method="POST"
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
            {{ $jadwalkontrol->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
