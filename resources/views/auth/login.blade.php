    @extends('partials.login_app')
    @section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container">
        <div class="main-content d-flex flex-column p-0">
            <div class="m-auto m-1230">
                <div class="row align-items-center">
                    <!-- Left Image -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="{{ asset('assets/images/login.jpg') }}" class="rounded-3" alt="login">
                    </div>

                    <!-- Right Form -->
                    <div class="col-lg-6">
                        <div class="mw-480 ms-lg-auto">
                            <a href="{{ url('/') }}" class="d-inline-block mb-4">
                                <img src="{{ asset('assets/images/logo.svg') }}" class="rounded-3 for-light-logo" alt="logo">
                                <img src="{{ asset('assets/images/white-logo.svg') }}" class="rounded-3 for-dark-logo" alt="logo">
                            </a>
                            <h3 class="fs-28 mb-2">Welcome back to FarmaSys!</h3>
                            <p class="fw-medium fs-16 mb-4">Sign In with social account or enter your details</p>

                            <!-- Social Login -->
                        

                            <!-- Laravel Login Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-group mb-4">
                                    <label for="email" class="label text-secondary">Email Address</label>
                                    <input id="email" type="email" name="email"
                                        class="form-control h-55 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autofocus autocomplete="username"
                                        placeholder="example@trezo.com">
                                    @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-4">
                                    <label for="password" class="label text-secondary">Password</label>
                                    <input id="password" type="password" name="password"
                                        class="form-control h-55 @error('password') is-invalid @enderror"
                                        required autocomplete="current-password" placeholder="Type password">
                                    @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember + Forgot -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                                        <label class="form-check-label text-secondary" for="remember_me">
                                            Remember Me
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-primary small">
                                        Forgot your password?
                                    </a>
                                    @endif
                                </div>

                                <!-- Submit -->
                                <div class="form-group mb-4">
                                    <button type="submit" class="btn btn-primary fw-medium py-2 px-3 w-100">
                                        <div class="d-flex align-items-center justify-content-center py-1">
                                            <i class="material-symbols-outlined text-white fs-20 me-2">login</i>
                                            <span>Login</span>
                                        </div>
                                    </button>
                                </div>

                                <!-- Register -->
                                <!-- <div class="form-group">
                                    <p>
                                        Don’t have an account?
                                        <a href="{{ route('register') }}" class="fw-medium text-primary text-decoration-none">Register</a>
                                    </p>
                                </div> -->
                            </form>

                        </div>
                    </div>
                    <!-- End Right Form -->
                </div>
            </div>
        </div>
    </div>
@endsection