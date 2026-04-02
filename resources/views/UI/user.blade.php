@extends('index')

@section('content')
    <!-- Section Hero -->
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

    <!-- Section About -->
    @include('UI.about')

    <!-- Section Service -->
    @include('UI.service')

    <!-- Section Reservasi -->
    @include('UI.reservasi')
@endsection
