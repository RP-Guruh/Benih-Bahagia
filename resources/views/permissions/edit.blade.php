@extends('app')

@section('content')
<div class="container">
    <h4>Kelola Akses untuk: {{ $user->name }}</h4>
    <form method="POST" action="{{ route('permissions.update', $user->id) }}">
        @csrf
        @method('PUT')

        @foreach($menus as $menu)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $menu->name }}
                </div>
                <div class="card-body">
                    @foreach($actions as $action)
                        <label class="me-3">
                            <input type="checkbox" 
                                   name="permissions[{{ $menu->id }}][]" 
                                   value="{{ $action->id }}"
                                   {{ $user->menuActions()
                                       ->where('menu_id', $menu->id)
                                       ->where('action_id', $action->id)
                                       ->exists() ? 'checked' : '' }}>
                            {{ $action->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
