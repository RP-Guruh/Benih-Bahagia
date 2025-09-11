@extends('landing_page.app_landing')
@include('landing_page.partials.header')

@section('content')
<div class="container py-5 mt-5 article-wrapper">
    <div class="row g-4 mb-4">
        
        <!-- Kolom Kiri: Video -->
        <div class="col-lg-8">
            <div class="mt-5 bg-white border-0 rounded-3 p-3 shadow-sm">
                <!-- Embed Video -->
                <div class="ratio ratio-16x9 rounded-3 mb-3">
                    <iframe src="{{ $video->embed_url }}" 
                            title="{{ $video->title }}" 
                            frameborder="0" 
                            allowfullscreen></iframe>
                </div>

                <!-- Judul & Info -->
                <h1 class="fw-bold mb-2">{{ $video->title }}</h1>
                <div class="d-flex align-items-center gap-2 text-muted small mb-3">
                    <i class="ri-user-3-line"></i> {{ $video->author->name ?? 'Admin' }}
                    <span>·</span>
                    <i class="ri-calendar-line"></i> {{ $video->created_at->format('d M Y') }}
                </div>

                <!-- Kategori -->
                <div class="border-top border-bottom my-3 py-2">
                    <span class="text-muted">Kategori:</span>
                    <span class="fw-semibold">{{ $video->category->name ?? '-' }}</span>
                </div>

                <!-- Deskripsi -->
                <div class="fs-6 lh-lg">
                    {!! nl2br(e($video->description)) !!}
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Video Lainnya -->
        <div class="col-lg-4">
            <div class="mt-5 bg-white border-0 rounded-3 p-3 shadow-sm">
                <h5 class="fw-semibold mb-3">Video Lainnya</h5>
                <ul class="list-unstyled">
                    @foreach(\App\Models\Video::latest()->where('id','!=',$video->id)->take(4)->get() as $other)
                        <li class="mb-3">
                            <a href="{{ route('video.detail', [$other->id, $other->slug]) }}" class="d-flex align-items-center text-decoration-none">
                                <div class="ratio ratio-16x9 rounded me-3" style="width: 100px;">
                                    <iframe src="{{ $other->embed_url }}" frameborder="0" allowfullscreen></iframe>
                                </div>
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
@endsection
