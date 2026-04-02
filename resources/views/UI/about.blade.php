<section id="about" class="about section">
    <div class="container">
        <div class="ms-auto">
            <div class="content" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <h3>Tentang Kami</h3>
                    <p>
                        Kami adalah klinik kesehatan yang berkomitmen untuk memberikan layanan terbaik bagi masyarakat.
                        Dengan tenaga medis profesional dan fasilitas modern, kami siap membantu Anda dalam menjaga kesehatan.
                    </p>
                </div>
                <div class="row gap-3">
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <i class="fa-solid fa-vial-circle-check fs-3"></i>
                                <div>
                                    <h5>Pelayanan Medis Terbaik</h5>
                                    <p>Kami menyediakan berbagai layanan medis dengan standar kualitas tinggi.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-pump-medical"></i>
                                <div>
                                    <h5>Fasilitas Modern</h5>
                                    <p>Dengan peralatan medis terkini, kami memastikan diagnosis yang akurat dan perawatan yang efektif.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-heart-circle-xmark"></i>
                                <div>
                                    <h5>Komitmen untuk Kesehatan</h5>
                                    <p>Kami hadir untuk membantu Anda dan keluarga menjaga kesehatan dengan pelayanan terbaik.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <!-- Jadwal Dokter -->
                        <div class="text-center mt-5">
                            <h5 class="fw-bold">Jadwal Praktik Dokter</h5>
                        </div>
                        <table class="table table-bordered mt-3 text-center table-striped">
                            <thead>
                                <tr class="table-info">
                                    <th>Hari</th>
                                    <th>Jam Praktik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal_dokter as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->jam_buka)->format('H.i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_tutup)->format('H.i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
