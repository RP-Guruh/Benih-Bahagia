@extends('app')
@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Create Category</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('dashboard') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('content.category.index') }}" class="d-flex align-items-center text-decoration-none">
                        <span class="text-secondary fw-medium hover">Category</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Create</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h3 class="mb-0">Create a New Category</h3>
                </div>

                <form action="{{ route('content.category.store') }}" method="POST" class="form_save">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Category Name *</label>
                                <input required type="text" id="name" class="form-control" name="name"
                                       placeholder="Category name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Slug *</label>
                                <input required type="text" id="slug" class="form-control" name="slug"
                                       placeholder="auto-generated slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('content.category.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-add-line text-white fw-medium"></i> Save Category
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
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput) {
            nameInput.addEventListener('keyup', function () {
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
