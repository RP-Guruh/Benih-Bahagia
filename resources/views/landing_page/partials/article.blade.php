<div class="edu-article-area pt-150" id="articles">
    <div class="container">
        <div class="section-title mw-630 text-center mb-5">
            <span class="top-title">
                <span>Edukasi</span>
            </span>
            <h2>Artikel Edukasi: Panduan & Wawasan Seputar Tumbuh Kembang Anak</h2>
        </div>

    <div class="row g-4">
    @foreach($articles as $artikel)
        <div class="col-md-6 col-lg-4 d-flex">
            <div class="single-testimonials shadow-sm rounded-4 p-4 h-100 w-100">
                <p class="mb-3 text-dark">
                    {{ Str::limit(strip_tags($artikel->content), 180, '...') }}
                </p>

                <div class="d-flex align-items-center review-info">
                    <div class="review">
                        <img src="{{ Storage::url($artikel->thumbnail) }}" 
                             class="rounded-circle wh-50" 
                             alt="{{ $artikel->title }}">
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-1">{{ $artikel->title }}</h4>
                        <span class="small text-muted">
                            {{ $artikel->author->name ?? 'Admin' }} · {{ $artikel->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('article.detail', [$artikel->id, $artikel->slug]) }}" 
                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>


        @if($articles->count() >= 3)
            <div class="text-center mt-5">
                <a href="{{ route('article.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                    Lihat Semua Artikel
                </a>
            </div>
        @endif
    </div>
</div>


<div class="edu-video-area pt-5 pb-5 position-relative z-1" id="videos">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 mb-lg-5">
            <div class="section-title ms-0 text-start mw-630 mb-0">
                <span class="top-title">
                    <span>Edukasi</span>
                </span>
                <h2>Video Edukasi: Belajar Interaktif Seputar Tumbuh Kembang Anak</h2>
            </div>

            <div class="team-controller d-flex gap-3">
                <div class="controller-icon prev" tabindex="0" role="button" aria-label="Next slide">
                    <i class="ri-arrow-left-line"></i>
                </div>
                <div class="controller-icon next" tabindex="0" role="button" aria-label="Previous slide">
                    <i class="ri-arrow-right-line"></i>
                </div>
            </div>
        </div>
        
        <div class="swiper team-slide">
            <div class="swiper-wrapper">
                @foreach($video as $video)
                    <div class="swiper-slide">
                        <div class="our-team-single-item shadow-sm rounded-4 overflow-hidden h-auto">
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $video->embed_url }}" 
                                        title="{{ $video->title }}" 
                                        allowfullscreen 
                                        class="rounded-top"></iframe>
                            </div>
                            <div class="team-content d-flex flex-column p-3">
                                <h3 class="mb-1">{{ $video->title }}</h3>
                                <span class="small text-muted mb-2">
                                    {{ $video->created_at->format('d M Y') }}
                                </span>
                                <p class="mb-3 text-dark">
                                    {{ Str::limit(strip_tags($video->description), 100, '...') }}
                                </p>
                                <a href="{{ route('video.detail', [$video->id, $video->slug]) }}" target="_blank" 
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3 mt-auto ">
                                    Tonton Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

