<section id="reservasi" class="reservasi section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Reservasi Klinik</h2>
    </div><!-- End Section Title -->

    <div class="container">
        @guest
            <div class="alert alert-warning text-center">
                Anda harus <a href="{{ route('login') }}">login</a> terlebih dahulu untuk melakukan reservasi.
            </div>
        @else
            @if (Auth::user()->id_pasien)
                <div class="row">
                    <!-- Form Reservasi -->
                    <div class="col-lg-12">
                        <form id="reservasi-form" action="{{ route('reservasi.store') }}" method="POST"
                            class="form-control shadow rounded p-4">
                            @csrf
                            <input type="hidden" name="tanggal_reservasi" id="selected-date">
                            <input type="hidden" name="waktu_reservasi" id="selected-time">
                            
                            <div class="mb-3">
                                <label for="keluhan" class="form-label">Keluhan</label>
                                <textarea name="keluhan" id="keluhan" class="form-control" placeholder="Jelaskan keluhan Anda" rows="4"></textarea>
                                @error('keluhan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <p class="fw-semibold p-2 bg-light">Tanggal :
                                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                            </p>
                            <p class="text-secondary" style="margin-top: -10px">Silahkan pilih jam untuk reservasi</p>

                            <!-- Container untuk slot waktu -->
                            <div id="slot-container" class="d-flex flex-wrap gap-2"></div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3" id="btn-submit" disabled>
                                    Reservasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        @endguest
    </div>
</section>
