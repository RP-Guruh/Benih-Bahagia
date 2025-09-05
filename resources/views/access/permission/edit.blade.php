@extends('app')
@section('content')
    <div class="main-content-container overflow-hidden">

        <!-- Header & Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Edit Permissions for Level: {{ $level->name }}</h3>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><span class="fw-medium">Access</span></li>
                    <li class="breadcrumb-item active" aria-current="page"><span class="fw-medium">Level Permissions</span>
                    </li>
                </ol>
            </nav>
        </div>

        @include('partials.alert')

        <!-- Add New Permissions -->
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-0">
                <div class="p-4">
                    <h4 class="mb-3">Add New Permissions</h4>
                    <form action="{{ route('access.permission.store', $level->id) }}" method="POST" class="form_save">
                        @csrf
                        <input type="hidden" name="level_id" value="{{ $level->id }}">
                        <div id="permission-rows">
                            <div class="row mb-2 permission-row align-items-center">
                                <div class="col-12 col-md-5 mb-2 mb-md-0">
                                    <select name="menu_id[]" class="form-control" required>
                                        <option value="">Select Menu</option>
                                        @foreach($menu as $m)
                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-5 mb-2 mb-md-0">
                                    <select name="action_id[]" class="form-control" required>
                                        <option value="">Select Action</option>
                                        @foreach($action as $a)
                                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 d-flex justify-content-center">
                                    <button type="button" class="btn btn-success add-row">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-3 mb-4 mt-2">
                            <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                <i class="ri-add-line text-white fw-medium"></i> Add Permissions
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Existing Permissions -->
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-0">
                <div class="p-4">
                    <h4 class="mb-3">Existing Permissions</h4>
                    <div class="default-table-area style-two default-table-width">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Action</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($level->permissions as $perm)
                                        <tr>
                                            {{-- Form Update --}}
                                            <form class="form_edit" action="{{ route('access.permission.update', $perm->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td class="p-1">
                                                    <select name="menu_id" class="form-control">
                                                        @foreach($menu as $m)
                                                            <option value="{{ $m->id }}" {{ $perm->menu_id == $m->id ? 'selected' : '' }}>
                                                                {{ $m->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="p-1">
                                                    <select name="action_id" class="form-control">
                                                        @foreach($action as $a)
                                                            <option value="{{ $a->id }}" {{ $perm->action_id == $a->id ? 'selected' : '' }}>
                                                                {{ $a->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="p-1">{{ $perm->created_at->format('j F Y H:i') }}</td>
                                                <td class="p-1">{{ $perm->updated_at->format('j F Y H:i') }}</td>
                                                <td class="p-1 d-flex flex-wrap gap-2 justify-content-center">
                                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                            </form>

                                            {{-- Form Delete --}}
                                            <form action="{{ route('access.permission.destroy', $perm->id) }}" method="POST"
                                                class="form_destroy d-inline"
                                                onsubmit="return confirm('Are you sure you want to remove this permission?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a href="{{ route('access.permission.index') }}" class="btn btn-secondary mt-3">Back to Level
                        Permission</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/access/permission/add_row.js') }}"></script>
@endpush