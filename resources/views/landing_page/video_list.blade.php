@extends('landing_page.app_landing')
@include('landing_page.partials.header')

@section('content')
<div class="edu-video-area pt-150 pb-100">
    <div class="container">
        <div class="section-title mw-630 text-center mb-5">
            <span class="top-title">
                <span>Edukasi</span>
            </span>
            <h2>Semua Video Edukasi</h2>
        </div>

        <div class="row g-4">
            @forelse($videos as $video)
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="card shadow-sm rounded-4 h-100 w-100 overflow-hidden">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $video->embed_url }}" 
                                    title="{{ $video->title }}" 
                                    allowfullscreen 
                                    class="rounded-top-4"></iframe>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2">{{ $video->title }}</h5>
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit(strip_tags($video->description), 120, '...') }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('video.detail', [$video->id, $video->slug]) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    Tonton Selengkapnya
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 small text-muted">
                            <i class="ri-user-3-line"></i> {{ $video->author->name ?? 'Admin' }} 
                            · <i class="ri-calendar-line"></i> {{ $video->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada video tersedia.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $videos->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
