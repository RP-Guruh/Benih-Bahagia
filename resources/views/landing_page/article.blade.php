@extends('landing_page.app_landing')
@include('landing_page.partials.header')

@section('content')
<div class="container article-wrapper py-5">
    <div class="row g-4 mb-4">
        
        <!-- Kolom Kiri: Thumbnail / Slider -->
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 90px;"> <!-- Sticky Thumbnail -->
                <div class="bg-white border-0 rounded-3 mb-3 p-3 shadow-sm">
                    <div class="swiper article-slide-main">
                        <div class="swiper-wrapper">
                            @if($article->thumbnail)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/'.$article->thumbnail) }}" class="rounded-3 w-100" alt="{{ $article->title }}">
                                </div>
                            @endif
                            @foreach($article->gallery ?? [] as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/'.$img) }}" class="rounded-3 w-100" alt="gallery">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Konten Artikel -->
        <div class="col-lg-8">
            <div class="bg-white border-0 rounded-3 p-4 shadow-sm h-100">
                <!-- Tombol Back -->
                <div class="mb-3">
                    <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="ri-arrow-left-line"></i> Kembali
                    </a>
                </div>

                <div class="mb-3">
                    <h1 class="fw-bold mb-2">{{ $article->title }}</h1>
                    <div class="d-flex align-items-center gap-2 text-muted small">
                        <i class="ri-user-3-line"></i> {{ $article->author->name ?? 'Admin' }}
                        <span>·</span>
                        <i class="ri-calendar-line"></i> {{ $article->created_at->format('d M Y') }}
                    </div>
                </div>

                <div class="border-top border-bottom my-3 py-2">
                    <span class="text-muted">Kategori:</span>
                    <span class="fw-semibold">{{ $article->category->name ?? '-' }}</span>
                </div>

                <div class="article-content fs-6 lh-lg">
                    {!! $article->content !!}
                </div>

                <div class="mt-4">
                    <h5 class="fw-semibold">Artikel Lainnya</h5>
                    <ul class="list-unstyled mt-3">
                        @foreach(\App\Models\Article::latest()->where('id','!=',$article->id)->take(3)->get() as $other)
                            <li class="mb-2">
                                <a href="{{ route('article.detail', [$other->id, $other->slug]) }}" class="d-flex align-items-center text-decoration-none">
                                    @if($other->thumbnail)
                                        <img src="{{ asset('storage/'.$other->thumbnail) }}" class="rounded me-3" width="70" height="50" style="object-fit: cover;">
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $other->title }}</h6>
                                        <small class="text-muted">{{ $other->created_at->format('d M Y') }}</small>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const mainSlider = new Swiper('.article-slide-main', {
        loop: true,
        spaceBetween: 10,
        thumbs: {
            swiper: {
                el: '.article-slide-thumb',
                slidesPerView: 4,
                spaceBetween: 10,
                freeMode: true,
                watchSlidesProgress: true,
            },
        },
    });

    new Swiper('.article-slide-thumb', {
        slidesPerView: 4,
        spaceBetween: 10,
        freeMode: true,
        watchSlidesProgress: true,
    });
</script>
@endpush
