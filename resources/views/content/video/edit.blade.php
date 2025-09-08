@extends('app')
@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Video</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('content.video.index') }}" class="d-flex align-items-center text-decoration-none">
                        <span class="text-secondary fw-medium hover">Video</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Edit</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h3 class="mb-0">Edit Video: {{ $video->title }}</h3>
                </div>

                <form action="{{ route('content.video.update', $video->id) }}" method="POST" class="form_save">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Title -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Video Title *</label>
                                <input required type="text" id="title" class="form-control" name="title"
                                       value="{{ old('title', $video->title) }}">
                                @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Slug *</label>
                                <input required type="text" id="slug" class="form-control" name="slug"
                                       value="{{ old('slug', $video->slug) }}">
                                @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- YouTube URL -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">YouTube URL *</label>
                                <input required type="url" class="form-control" name="youtube_url"
                                       value="{{ old('youtube_url', $video->youtube_url) }}">
                                @error('youtube_url') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Category *</label>
                                <select required class="form-control" name="category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $video->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label">Description</label>
                                <textarea class="form-control" rows="4" name="description">{{ old('description', $video->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('content.video.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-save-line text-white fw-medium"></i> Update Video
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        if (titleInput) {
            titleInput.addEventListener('keyup', function () {
                let slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            });
        }
    });
</script>
@endpush
