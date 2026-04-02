<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Klinik Gigi Drg. Putri</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    @include('layouts.user.navbar')

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background min-vh-100">

            <img src="{{ asset('img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

            <div class="container position-relative">
                <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                    <h2>Klinik Drg. Putri Kharisma Dewi</h2>
                    <p class="fs-10">Menyempurnakan senyum Anda dengan layanan perawatan gigi terbaik. Kami hadir
                        dengan profesionalisme dan kehangatan, siap memberikan pengalaman perawatan yang nyaman dan
                        berkualitas.</p>
                    <a href="#reservasi" class="btn btn-outline-primary mt-2">Reservasi Sekarang</a>
                </div><!-- End Welcome -->
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        @include('UI.about')

        <!-- Services Section -->
        @include('UI.service')

        <!-- reservasi Section -->
        @include('UI.reservasi')
    </main>

    @include('layouts.user.footer')
    <!-- Modal Profil User -->
    @auth
        <div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content shadow rounded">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalProfilLabel">Profil Saya</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input name="nama" type="text" id="nama" class="form-control"
                                    value="{{ auth()->user()->nama }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki"
                                        value="Laki-laki"
                                        {{ auth()->user()->pasien->jenis_kelamin == 'laki-laki' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="laki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                        value="Perempuan"
                                        {{ auth()->user()->pasien->jenis_kelamin == 'perempuan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" id="tanggal_lahir" class="form-control"
                                    value="{{ auth()->user()->pasien->tanggal_lahir }}">
                            </div>

                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label">Nomor HP</label>
                                <input name="nomor_telepon" type="text" id="nomor_telepon" class="form-control"
                                    value="{{ auth()->user()->pasien->nomor_telepon }}">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control">{{ auth()->user()->pasien->alamat }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">pekerjaan</label>
                                <input name="pekerjaan" type="text" id="pekerjaan" class="form-control"
                                    value="{{ auth()->user()->pasien->pekerjaan }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <textarea name="email" id="email" class="form-control">{{ auth()->user()->email }}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var $slotContainer = $('#slot-container');
            var $waktuReservasiInput = $('#selected-time'); // pastikan input hidden memiliki id="selected-time"
            var $btnSubmit = $('#btn-submit');
            var $tanggalReservasiInput = $('#selected-date'); // input hidden tanggal
            var $form = $('#reservasi-form');
            // Fungsi untuk load slot berdasarkan tanggal hari ini
            function loadSlots() {
                $slotContainer.html('Loading...');
                $btnSubmit.prop('disabled', true);
                $waktuReservasiInput.val('');

                // Gunakan tanggal hari ini
                var tgl = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
                $tanggalReservasiInput.val(tgl);

                // Perbaiki nama parameter saat mengirim ke backend
                $.get("{{ route('reservasi.slots') }}", {
                        tanggal: tgl // Sesuai dengan yang diambil di Controller
                    })
                    .done(function(data) {
                        console.log("Slot data:", data);
                        $slotContainer.html('');
                        if (data.length === 0) {
                            $slotContainer.html('Tidak ada slot yang tersedia untuk hari ini.');
                        } else {
                            $.each(data, function(index, slot) {
                                var $button = $('<button type="button" class="btn m-1"></button>');
                                $button.text(slot.time);

                                // Jika slot sudah dipesan ATAU sudah lewat dari waktu sekarang, disable tombol
                                if (slot.reserved) {
                                    $button.addClass('btn-secondary').prop('disabled', true);
                                } else {
                                    $button.addClass('btn-outline-primary');
                                    $button.on('click', function() {
                                        $slotContainer.find('button').removeClass('active');
                                        $(this).addClass('active');
                                        $waktuReservasiInput.val(slot.time + ':00');
                                        checkForm();
                                    });
                                }

                                // Menandai slot yang sudah lewat dengan warna merah
                                if (slot.past) {
                                    $button.addClass('btn-danger').prop('disabled', true);
                                }

                                $slotContainer.append($button);
                            });
                        }
                        checkForm();
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Error loading slots:", textStatus, errorThrown);
                        $slotContainer.html("Error loading slots.");
                    });
            }


            // Fungsi validasi: aktifkan tombol hanya jika semua field wajib terisi
            function checkForm() {
                var keluhan = $('#keluhan').val().trim();
                var waktuReservasi = $waktuReservasiInput.val().trim();

                if (keluhan && waktuReservasi) {
                    $btnSubmit.prop('disabled', false);
                } else {
                    $btnSubmit.prop('disabled', true);
                }
            }

            // Event listener pada input wajib
            $('#keluhan').on('input', checkForm);

            // Muat slot saat halaman dimuat
            loadSlots();

            // Submit form dengan AJAX
            $form.on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: $form.attr('action'),
                    method: $form.attr('method'),
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.redirect) {
                            Swal.fire({
                                title: "Reservasi Berhasil!",
                                text: "Reservasi Anda telah berhasil.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.replace('/');
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                            var errorMessage = "";
                            var errorData = {};
                            if (errors) {
                                $.each(errors, function(key, messages) {
                                    errorMessage += messages[0] + "<br>";
                                    errorData[key] = messages[0];
                                });
                            } else {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: "Reservasi Gagal!",
                                html: errorMessage,
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then(() => {
                                // Simpan input yang sudah diisi ke sessionStorage
                                $('#reservasi-form :input').each(function() {
                                    if (this.type !== "submit") {
                                        sessionStorage.setItem(this.id, $(this)
                                            .val());
                                    }
                                });
                                sessionStorage.setItem("errors", JSON.stringify(
                                    errorData));
                                sessionStorage.setItem("scrollTo", "#reservasi");
                                window.location.reload(); // Reload halaman
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Terjadi kesalahan, silakan coba lagi.",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location
                                    .reload(); // Reload halaman jika error lain
                            });
                        }
                    }
                });
            });
            $(document).ready(function() {
                var scrollTo = sessionStorage.getItem("scrollTo");
                var errors = JSON.parse(sessionStorage.getItem("errors")) || {};

                // Ambil nilai inputan yang tersimpan di sessionStorage dan masukkan ke form
                $('#reservasi-form :input').each(function() {
                    if (this.type !== "submit" && sessionStorage.getItem(this.id)) {
                        $(this).val(sessionStorage.getItem(this.id));
                    }
                });
                // Tampilkan error setelah reload
                $.each(errors, function(field, message) {
                    var inputField = $('#' + field);
                    inputField.addClass('is-invalid'); // Tambahkan class error
                    if (inputField.next('.text-danger').length === 0) {
                        inputField.after('<span class="text-danger">' + message + '</span>');
                    }
                });

                // Scroll ke #reservasi jika sebelumnya ada error validasi
                if (scrollTo) {
                    setTimeout(function() {
                        document.querySelector(scrollTo).scrollIntoView({
                            behavior: "smooth"
                        });
                    }, 100);
                }

                setTimeout(function() {
                    sessionStorage.clear();
                }, 500);
            });
        });
    </script>
</body>

</html>
