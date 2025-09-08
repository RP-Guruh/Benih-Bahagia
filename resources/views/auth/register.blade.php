@extends('partials.login_app')
@section('content')

<style>
    body {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .register-card {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 2.5rem;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        animation: fadeInUp 0.8s ease;
    }
    .register-logo img {
        width: 140px;
        height: auto;
    }
    .btn-modern {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        transition: transform 0.2s ease;
    }
    .btn-modern:hover {
        transform: scale(1.03);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="register-card">
    <!-- Logo -->
    <div class="register-logo text-center mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/landing_page/images/LogoBenih.png') }}" alt="logo">
        </a>
    </div>

    <!-- Title -->
    <h3 class="text-center fw-bold mb-2">Buat Akun Baru 🚀</h3>
    <p class="text-center text-muted mb-4">
        Daftar sekarang untuk bergabung dengan <strong>Benih Bahagia</strong>
    </p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-medium">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" 
                   class="form-control rounded-3 @error('name') is-invalid @enderror"
                   required autofocus autocomplete="name" placeholder="Nama lengkap Anda">
            @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control rounded-3 @error('email') is-invalid @enderror"
                   required autocomplete="username" placeholder="example@email.com">
            @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-medium">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control rounded-3 @error('password') is-invalid @enderror"
                   required autocomplete="new-password" placeholder="••••••••">
            @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control rounded-3"
                   required autocomplete="new-password" placeholder="••••••••">
            @error('password_confirmation')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Optional: Tempat Guru Mengajar -->
        <div class="mb-4">
            <label for="teaching_place" class="form-label fw-medium">Tempat Guru Mengajar (Opsional)</label>
            <input id="teaching_place" type="text" name="teaching_place" 
                   value="{{ old('teaching_place') }}" 
                   class="form-control rounded-3"
                   placeholder="Contoh: SD Negeri 01 Jakarta">
            @error('teaching_place')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-modern text-white fw-bold py-2 w-100 rounded-3 mb-3">
            Daftar
        </button>

        <!-- Link to Login -->
        <p class="text-center text-muted mb-0">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">
                Masuk
            </a>
        </p>
    </form>
</div>
@endsection
