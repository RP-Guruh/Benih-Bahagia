@extends('app')
@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Category</h3>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="p-4">
                <form action="{{ route('content.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Name -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Category Name *</label>
                                <input required type="text" id="name" class="form-control" name="name"
                                       value="{{ old('name', $category->name) }}">
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Slug *</label>
                                <input required type="text" id="slug" class="form-control" name="slug"
                                       value="{{ old('slug', $category->slug) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('content.category.index') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Category</button>
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
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('keyup', function () {
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });
    });
</script>
@endpush
