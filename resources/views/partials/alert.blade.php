
@if($errors->any())
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>Oops!</strong> Please check the errors below:
    <ul class="mb-0 mt-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Custom Alert --}}
@if(session('alert'))
<div class="alert alert-{{ session('alert.type') ?? 'info' }} alert-dismissible" role="alert">
    @if(session('alert.title'))
        <strong>{{ session('alert.title') }}</strong><br>
    @endif
    {{ session('alert.message') }}
    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
