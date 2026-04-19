@extends('User.userlayout')

@section('User-content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Account Settings</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user-dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Change Password</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-8">
                <div class="card" style="border:none; border-radius:20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05)">
                    <div class="card-header bg-white pt-4 px-4 pb-0 border-0">
                        <h5 class="card-title fw-bold text-dark mb-1">Change Password</h5>
                        <p class="text-muted fs-12">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px">
                                <i class="feather-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark fs-13">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px"><i class="feather-lock text-muted"></i></span>
                                    <input type="password" name="current_password" class="form-control border-start-0 @error('current_password') is-invalid @enderror" placeholder="Enter current password" style="border-radius: 0 10px 10px 0" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4 opacity-50">

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark fs-13">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px"><i class="feather-key text-muted"></i></span>
                                    <input type="password" name="new_password" class="form-control border-start-0 @error('new_password') is-invalid @enderror" placeholder="Enter new password" style="border-radius: 0 10px 10px 0" required>
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text fs-11 mt-2 text-muted">Password must be at least 8 characters long.</div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-semibold text-dark fs-13">Confirm New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px"><i class="feather-shield text-muted"></i></span>
                                    <input type="password" name="new_password_confirmation" class="form-control border-start-0" placeholder="Confirm new password" style="border-radius: 0 10px 10px 0" required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary fw-bold py-2" style="border-radius:12px">
                                    <i class="feather-save me-2"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
