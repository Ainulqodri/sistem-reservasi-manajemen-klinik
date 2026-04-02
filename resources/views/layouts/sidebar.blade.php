<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark shadow-lg" style="width: 280px;">
    <h3 class="mb-3 ms-3 mb-md-0 me-md-auto text-white text-decoration-none text-center">
        <img src="{{ asset('img/gigi.jpg') }}" alt="" class="w-50">
        <span class="fs-6 fw-bold">Drg. Putri</span>
    </h3>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page">
                <i class="bi bi-house-door-fill"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pasien.index') }}"
                class="nav-link text-white {{ request()->is('pasien*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Data Pasien
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.index') }}"
                class="nav-link text-white {{ request()->is('dokter*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                Data dokter
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jadwalpraktik.index') }}"
                class="nav-link text-white {{ request()->is('jadwal_praktik*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                Jadwal Praktik Dokter
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jadwalkontrol.index') }}"
                class="nav-link text-white {{ request()->is('jadwal_kontrol*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                Jadwal Kontrol Pasien
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('rekam_medis.index') }}"
                class="nav-link text-white {{ request()->is('rekam_medis*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                Rekam Medis
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reservasi.index') }}"
                class="nav-link text-white {{ request()->is('reservasi*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                Reservasi
            </a>
        </li>
    </ul>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/gigi2.jpg') }}" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>YULIA</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">

            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
