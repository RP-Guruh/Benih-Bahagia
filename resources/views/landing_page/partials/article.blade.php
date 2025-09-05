<section id="blog" class="my-5">
    <div class="container py-5">

        <!-- Judul Section -->
        <div class="text-center mb-5">
            <h6 class="text-primary fw-semibold">Artikel Kami</h6>
            <h2 class="fw-bold display-5">Artikel Terbaru</h2>
            <p class="text-muted mb-0">Tips, edukasi, dan informasi terbaru untuk orang tua dan tenaga kesehatan.</p>
        </div>

        <!-- Grid Artikel -->
        <div class="row g-4">

            <!-- Artikel 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="blog-item h-100 d-flex flex-column">
                    <div class="blog-thumb overflow-hidden rounded-3 mb-3">
                        <a href="{{ url('/artikel/1') }}">
                            <img src="{{ asset('assets/landing_page/images/blog1.jpg') }}" 
                                 class="img-fluid w-100" alt="Artikel 1">
                        </a>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <span class="text-muted small mb-2">Diposting oleh: Admin</span>
                        <h5 class="fw-bold mb-3">
                            <a href="{{ url('/artikel/1') }}" class="text-dark text-decoration-none">
                                Skrinning Tumbuh Kembang Anak
                            </a>
                        </h5>
                        <p class="text-muted flex-grow-1">
                            Pentingnya skrining dini untuk memantau tumbuh kembang anak secara optimal.
                        </p>
                        <a href="{{ url('/artikel/1') }}" class="stretched-link text-primary fw-semibold mt-2">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Artikel 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="blog-item h-100 d-flex flex-column">
                    <div class="blog-thumb overflow-hidden rounded-3 mb-3">
                        <a href="{{ url('/artikel/2') }}">
                            <img src="{{ asset('assets/landing_page/images/blog2.jpg') }}" 
                                 class="img-fluid w-100" alt="Artikel 2">
                        </a>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <span class="text-muted small mb-2">Diposting oleh: Admin</span>
                        <h5 class="fw-bold mb-3">
                            <a href="{{ url('/artikel/2') }}" class="text-dark text-decoration-none">
                                Edukasi Kesehatan untuk Orang Tua
                            </a>
                        </h5>
                        <p class="text-muted flex-grow-1">
                            Edukasi orang tua sangat penting dalam mendukung pertumbuhan anak yang sehat.
                        </p>
                        <a href="{{ url('/artikel/2') }}" class="stretched-link text-primary fw-semibold mt-2">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Artikel 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="blog-item h-100 d-flex flex-column">
                    <div class="blog-thumb overflow-hidden rounded-3 mb-3">
                        <a href="{{ url('/artikel/3') }}">
                            <img src="{{ asset('assets/landing_page/images/blog3.jpg') }}" 
                                 class="img-fluid w-100" alt="Artikel 3">
                        </a>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <span class="text-muted small mb-2">Diposting oleh: Admin</span>
                        <h5 class="fw-bold mb-3">
                            <a href="{{ url('/artikel/3') }}" class="text-dark text-decoration-none">
                                Konsultasi dengan Ahli
                            </a>
                        </h5>
                        <p class="text-muted flex-grow-1">
                            Konsultasi dengan tenaga ahli membantu orang tua menemukan solusi terbaik.
                        </p>
                        <a href="{{ url('/artikel/3') }}" class="stretched-link text-primary fw-semibold mt-2">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tombol Semua Artikel -->
        <div class="text-center mt-5">
            <a href="{{ url('/artikel') }}" class="btn btn-primary px-4 py-2 fw-semibold">
                Lihat Semua Artikel
            </a>
        </div>

    </div>
</section>
