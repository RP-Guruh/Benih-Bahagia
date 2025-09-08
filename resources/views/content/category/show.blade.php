@extends('app')
@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Category: {{ $category->name }}</h3>
    </div>

    {{-- Articles --}}
{{-- Articles --}}
<div class="card mb-4">
    <div class="card-body">
        <h5 class="mb-3">Articles in this Category</h5>

        @if($articles->isEmpty())
            <p class="text-muted">No articles yet.</p>
        @else
            <div class="row g-3">
                @foreach($articles as $article)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card h-100">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}" 
                                     class="card-img-top" alt="{{ $article->title }}" style="height:150px; object-fit:cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title mb-2">{{ $article->title }}</h6>
                                <p class="text-muted mb-2" style="font-size:0.85rem;">
                                    {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('j M Y') }}
                                </p>
                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('content.article.show', $article->id) }}" class="btn btn-sm btn-outline-primary w-50">
                                        View
                                    </a>
                                    <a href="{{ route('content.article.edit', $article->id) }}" class="btn btn-sm btn-outline-secondary w-50">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>


{{-- Videos --}}
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Videos in this Category</h5>
        @if($videos->isEmpty())
            <p class="text-muted">No videos yet.</p>
        @else
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-3 mb-4">
                        <div class="border rounded p-3 h-100 d-flex flex-column">
                            <h6 class="fw-bold mb-2">{{ $video->title }}</h6>

                            {{-- Embed YouTube --}}
                            @php
                                preg_match(
                                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                                    $video->youtube_url,
                                    $matches
                                );
                                $youtubeId = $matches[1] ?? null;
                            @endphp

                            @if($youtubeId)
                                <div class="ratio ratio-16x9 mb-2">
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                        title="{{ $video->title }}" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @endif

                            <p class="text-muted small flex-grow-1">{{ Str::limit($video->description, 80) }}</p>

                            <p class="text-secondary small mb-2">
                                <i class="ri-time-line"></i> 
                                {{ \Carbon\Carbon::parse($video->created_at)->translatedFormat('j F Y H:i') }}
                            </p>

                             <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('content.video.show', $article->id) }}" class="btn btn-sm btn-outline-primary w-50">
                                        View
                                    </a>
                                    <a href="{{ route('content.video.edit', $article->id) }}" class="btn btn-sm btn-outline-secondary w-50">
                                        Edit
                                    </a>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>


</div>
@endsection
