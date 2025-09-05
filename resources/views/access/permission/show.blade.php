@extends('app')

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Permissions for Level: {{ $level->name }}</h3>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <h4 class="mb-3">Permission List</h4>
                <div class="default-table-area style-two default-table-width">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Actions</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissionsByMenu as $menuName => $perms)
                                    <tr>
                                        <td>{{ $menuName }}</td>
                                        <td>
                                            @foreach($perms as $perm)
                                                @php

                                                    switch (strtolower($perm->action->name ?? '')) {
                                                        case 'create':
                                                            $btnClass = 'bg-success bg-opacity-10 text-success';
                                                            break;
                                                        case 'delete':
                                                            $btnClass = 'bg-danger bg-opacity-10 text-danger';
                                                            break;
                                                        case 'update':
                                                            $btnClass = 'bg-warning bg-opacity-10 text-warning';
                                                            break;
                                                        default:
                                                            $btnClass = 'bg-primary bg-opacity-10 text-primary';
                                                    }
                                                @endphp

                                                <span class="badge {{ $btnClass }} fw-bold py-2 px-4 mt-2 me-2">
                                                    {{ $perm->action->name ?? '-' }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>
                                            {{ $perms->first()->created_at->format('j F Y H:i') }}
                                        </td>
                                        <td>
                                            {{ $perms->last()->updated_at->format('j F Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('access.permission.index') }}" class="btn btn-secondary">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                    <a href="{{ route('access.permission.edit', $level->id) }}" class="btn btn-primary">
                        <i class="ri-edit-line"></i> Manage Permissions
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection