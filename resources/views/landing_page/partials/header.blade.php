<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/landing_page/images/logo-cropeed.png') }}"
                 alt="Logo Benih"
                 class="img-fluid"
                 style="max-height: 65px; width:auto;">
            <span class="fw-bold ms-2 baloo-2-logo" style="color:#524FD9; font-size:28px;">
                Benih Bahagia
            </span>
        </a>

        <!-- Toggle Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 baloo-2-logo" style="font-size:20px;">
                <li class="nav-item">
                    <a class="nav-link active fw-medium" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#articles">Edukasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#about-app">Tentang Kami</a>
                </li>
            </ul>

            <!-- Tombol Login -->
            <a href="{{ route('login') }}" 
               class="btn btn-primary fw-bold rounded-pill px-4 ms-lg-3 baloo-2-logo" style="font-size:18px;">
              
                <i class="ri-login-box-line me-1"></i> Login Guru
            </a>
        </div>
    </div>
</nav>
