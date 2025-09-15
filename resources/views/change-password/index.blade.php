@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Change Password</h3>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('change-password.update', $user->id) }}" 
                  method="POST" 
                  class="form_save">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Current Password --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Current Password *</label>
                            <input required type="password" id="current_password" name="current_password" class="form-control">
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">New Password *</label>
                            <input required type="password" id="password" name="password" class="form-control">
                            <small class="form-text text-muted">
                                Password minimal 8 karakter, harus berisi kombinasi huruf besar, huruf kecil, angka, dan simbol.
                            </small>
                        </div>
                    </div>

                    {{-- Confirm New Password --}}
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Confirm New Password *</label>
                            <input required type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            <small class="form-text text-muted">
                                Ulangi password baru untuk konfirmasi.
                            </small>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line"></i> Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
