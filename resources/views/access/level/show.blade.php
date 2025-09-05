@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Show Level Access</h3>

        <nav style="--bs-breadcrumb-divider: '>'; " aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('access.level.index') }}" class="fw-medium">Level Access List</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Detail</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Level Access Information</h4>

            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Level Name</label>
                            <input type="text" class="form-control" value="{{ $level->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Level Description</label>
                            <textarea class="form-control" rows="2" readonly>{{ $level->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Created At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($level->created_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Updated At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($level->updated_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Created by</label>
                            <input type="text" class="form-control"
                                   value="{{ $level->creator ? $level->creator->name : '-' }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Last Updated by</label>
                            <input type="text" class="form-control"
                                   value="{{ $level->updater ? $level->updater->name : '-' }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('access.level.edit', $level->id) }}" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                <i class="ri-edit-2-line"></i> Edit
                            </a>
                            <a href="{{ route('access.level.index') }}" class="btn btn-secondary py-2 px-4 fw-medium fs-16">
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
