@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Edit Article: {{ $article->title }}</h3>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('content.article.update', $article->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="form_save">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Title --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Title *</label>
                            <input required type="text" id="title" name="title" class="form-control"
                                   value="{{ old('title', $article->title) }}">
                        </div>
                    </div>

                    {{-- Slug --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Slug *</label>
                            <input required type="text" id="slug" name="slug" class="form-control"
                                   value="{{ old('slug', $article->slug) }}">
                        </div>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @if($article->thumbnail)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$article->thumbnail) }}" 
                                         alt="Thumbnail" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Category *</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Choose Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label">Content *</label>
                            <textarea id="editor" name="content" class="form-control" rows="12">
                                {{ old('content', $article->content) }}
                            </textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('content.article.show', $article->id) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line"></i> Update Article
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('content.article.upload') }}?_token={{ csrf_token() }}"
            }
        })
        .then(editor => { console.log('CKEditor initialized'); })
        .catch(error => { console.error(error); });

    // auto-generate slug
    document.getElementById('title').addEventListener('keyup', function () {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
