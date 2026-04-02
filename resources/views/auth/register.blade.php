<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card shadow-lg rounded-4 p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Form Registrasi</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- ROW 1: DATA DIRI --}}
                        <h5 class="mb-3">Data Diri</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <x-input-label for="nama" value="Nama Lengkap" />
                                <x-text-input id="nama" class="form-control" type="text" name="nama"
                                    :value="old('nama')" required />
                                <x-input-error :messages="$errors->get('nama')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                                <x-text-input id="tanggal_lahir" class="form-control" type="date"
                                    name="tanggal_lahir" :value="old('tanggal_lahir')" required />
                                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <x-input-label value="Jenis Kelamin" />
                                <div class="d-flex gap-4 mt-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="laki-laki"
                                            name="jenis_kelamin" value="Laki-laki" checked>
                                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="perempuan"
                                            name="jenis_kelamin" value="Perempuan">
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <x-input-label for="alamat" value="Alamat" />
                                <x-text-input id="alamat" class="form-control" type="text" name="alamat"
                                    :value="old('alamat')" required />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <x-input-label for="nomor_telepon" value="No. Telp/WhatsApp" />
                                <x-text-input id="nomor_telepon" class="form-control" type="text" name="nomor_telepon"
                                    :value="old('nomor_telepon')" required />
                                <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-12 mb-4">
                                <x-input-label for="pekerjaan" value="Pekerjaan" />
                                <x-text-input id="pekerjaan" class="form-control" type="text" name="pekerjaan"
                                    :value="old('pekerjaan')" required />
                                <x-input-error :messages="$errors->get('pekerjaan')" class="mt-1 text-danger" />
                            </div>
                        </div>

                        {{-- ROW 2: AKUN --}}
                        <h5 class="mb-3 mt-4">Data Akun</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" class="form-control" type="email" name="email"
                                    :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <x-input-label for="password" value="Password" />
                                <x-text-input id="password" class="form-control" type="password" name="password"
                                    required />
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
                            </div>

                            <div class="col-md-6 mb-4">
                                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                                <x-text-input id="password_confirmation" class="form-control" type="password"
                                    name="password_confirmation" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('login') }}" class="text-sm text-muted">
                                Sudah punya akun?
                            </a>
                            <x-primary-button class="px-4 py-2">
                                Daftar
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
