@extends('app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Create Menu Action</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">CRM</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Customers</span>
                    </li>
                </ol>
            </nav>
        </div>
        @include('partials.alert')
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-0">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h3 class="mb-0">Create a new menu action</h3>
                    </div>

                    <form action="{{ route('settings.menu_action.store') }}" method="POST" class="form_save">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Key</label>
                                    <input type="text" class="form-control" placeholder="Write Key Menu Action" name="code" value="{{ old('key') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Action Name</label>
                                    <input type="text" class="form-control" placeholder="Write Menu Action Name" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ route('settings.menu_action.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                    <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                        <i class="ri-add-line text-white fw-medium"></i> Create Menu Action
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
