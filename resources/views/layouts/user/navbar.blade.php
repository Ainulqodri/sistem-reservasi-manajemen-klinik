<header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h3 class="sitename fw-bold">Drg. Putri</h3>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Pelayanan</a></li>
                    <li><a href="#contact">Contact</a></li>
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endguest

                    @auth
                        <li class="dropdown">
                            <a href="#">
                                {{ Auth::user()->email }}
                                <i class="bi bi-chevron-down dropdown-indicator"></i>
                            </a>
                            <ul>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalProfil">
                                    Profil Saya
                                </button>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item text-start bg-transparent border-0 px-3">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>

    </div>

</header>
