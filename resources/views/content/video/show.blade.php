@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Show Video</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('content.video.index') }}" class="fw-medium">Video List</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Detail</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Video Info --}}
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Video Information</h4>

            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Title</label>
                            <input type="text" class="form-control" value="{{ $video->title }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Slug</label>
                            <input type="text" class="form-control" value="{{ $video->slug }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">YouTube URL</label>
                            <input type="text" class="form-control" value="{{ $video->youtube_url }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Category</label>
                            <input type="text" class="form-control" value="{{ $video->category->name ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Author</label>
                            <input type="text" class="form-control" value="{{ $video->author->name ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label">Description</label>
                            <textarea class="form-control" rows="3" readonly>{{ $video->description ?? '-' }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Created At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($video->created_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Updated At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($video->updated_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    {{-- Preview Video --}}
                    <div class="col-lg-12 mb-4">
                        <label class="label">Video Preview</label>
                        @php
                            $videoId = null;
                            if (preg_match('/(?:youtube\.com\/.*v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video->youtube_url, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp

                        @if($videoId)
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @else
                            <p class="text-danger">Invalid YouTube URL</p>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('content.video.edit', $video->id) }}" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                <i class="ri-edit-2-line"></i> Edit
                            </a>
                            <a href="{{ route('content.video.index') }}" class="btn btn-secondary py-2 px-4 fw-medium fs-16">
                                <i class="ri-arrow-go-back-line"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
