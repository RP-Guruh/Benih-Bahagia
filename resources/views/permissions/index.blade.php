@extends('app')

@section('content')
<div class="container">
    <h3>Manajemen Hak Akses</h3>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('permissions.edit',$user->id) }}" class="btn btn-sm btn-primary">Kelola Akses</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
