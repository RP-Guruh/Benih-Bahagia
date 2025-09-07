<!-- ========== EDUKASI ARTIKEL ========== -->
<div class="edu-article-area py-120 bg-light" id="articles">
    <div class="container">
        <div class="section-title text-center mb-5">
            <span class="top-title"><span>Edukasi</span></span>
            <h2 class="mb-3">Artikel Edukasi</h2>
            <p class="text-muted fs-16">
                Baca berbagai artikel pilihan untuk mendukung pemahaman guru dan orang tua tentang tumbuh kembang anak.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @for ($i = 1; $i <= 8; $i++)
            <div class="col-md-6 col-lg-3">
                <div class="edu-card h-100">
                    <div class="edu-thumb">
                        <img src="https://picsum.photos/400/250?random={{ $i }}" alt="Artikel {{ $i }}">
                        <span class="edu-badge">Artikel</span>
                    </div>
                    <div class="edu-content">
                        <h5 class="mb-2">Judul Artikel {{ $i }}</h5>
                        <p>Deskripsi singkat artikel edukasi tentang tumbuh kembang anak.</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center">
            <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Lihat Lebih Banyak</a>
        </div>
    </div>
</div>

<!-- ========== EDUKASI VIDEO ========== -->
<div class="edu-video-area py-120" id="videos">
    <div class="container">
        <div class="section-title text-center mb-5">
            <span class="top-title"><span>Edukasi</span></span>
            <h2 class="mb-3">Video Edukasi</h2>
            <p class="text-muted fs-16">
                Tonton video pembelajaran interaktif dari YouTube untuk mendukung perkembangan anak.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach ([
                'dQw4w9WgXcQ', '3JZ_D3ELwOQ', '2Vv-BfVoq4g', 'hTWKbfoikeg',
                'ktvTqknDobU', 'CevxZvSJLk8', '09R8_2nJtjg', 'fJ9rUzIMcZQ'
            ] as $videoId)
            <div class="col-md-6 col-lg-3">
                <div class="ratio ratio-16x9 shadow-sm rounded overflow-hidden">
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                        title="YouTube video" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#" class="btn btn-primary px-4 py-2 rounded-pill">Lihat Lebih Banyak</a>
        </div>
    </div>
</div>
