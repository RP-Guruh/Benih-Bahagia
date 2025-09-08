@extends('partials.login_app')
@section('content')
<x-auth-session-status class="mb-4" :status="session('status')" />

<style>
    body {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        animation: fadeInUp 0.8s ease;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .btn-modern {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        transition: transform 0.2s ease;
    }
    .btn-modern:hover {
        transform: scale(1.03);
    }
    .login-logo img {
        width: 140px;
        height: auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-card p-5">
                
                <!-- Logo -->
                <div class="login-logo text-center mb-4">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/landing_page/images/LogoBenih.png') }}" alt="logo">
                    </a>
                </div>

                <!-- Title -->
                <h3 class="text-center fw-bold mb-2">Selamat Datang Kembali 👋</h3>
                <p class="text-center text-muted mb-4">
                    Masuk untuk melanjutkan perjalanan Anda di <strong>Benih Bahagia</strong>
                </p>

                <!-- Laravel Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" name="email"
                            class="form-control rounded-3 @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="example@email.com">
                        @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password"
                            class="form-control rounded-3 @error('password') is-invalid @enderror"
                            required autocomplete="current-password" placeholder="••••••••">
                        @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label class="form-check-label" for="remember_me">
                                Remember Me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">
                            Lupa password?
                        </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-modern text-white fw-bold py-2 w-100 rounded-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="material-symbols-outlined text-white fs-20 me-2">login</i>
                                <span>Login</span>
                            </div>
                        </button>
                    </div>

                    <!-- Register -->
                    {{-- 
                    <div class="form-group text-center">
                        <p class="mb-0">
                            Belum punya akun?
                            <a href="{{ route('register') }}" 
                               class="fw-bold text-primary text-decoration-none">Daftar</a>
                        </p>
                    </div> 
                    --}}
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
