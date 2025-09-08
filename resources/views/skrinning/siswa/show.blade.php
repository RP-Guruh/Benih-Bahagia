@extends('app')

@section('content')
<div class="main-content-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>{{ $article->title }}</h3>
        <a href="{{ route('content.article.edit', $article->id) }}" class="btn btn-primary">
            <i class="ri-edit-2-line"></i> Edit
        </a>
    </div>

    {{-- Article Info --}}
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            
            {{-- Thumbnail --}}
            @if($article->thumbnail)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/'.$article->thumbnail) }}" 
                         alt="Thumbnail" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            @endif

            {{-- Metadata --}}
            <div class="mb-3 text-muted small">
                <span>Kategori: <strong>{{ $article->category->name ?? '-' }}</strong></span> |
                <span>Author: <strong>{{ $article->author->name ?? '-' }}</strong></span> |
                <span>Created: <strong>{{ $article->created_at->translatedFormat('j F Y H:i') }}</strong></span>
            </div>

            {{-- Content --}}
            <div class="article-content">
                {!! $article->content !!}
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('content.article.index') }}" class="btn btn-secondary">
            <i class="ri-arrow-go-back-line"></i> Back to Articles
        </a>
    </div>
</div>
@endsection
