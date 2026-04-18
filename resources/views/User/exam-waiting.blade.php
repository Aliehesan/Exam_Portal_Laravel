@extends('User.userlayout')

@section('User-content')
    <div class="main-content d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="row w-100 justify-content-center">
            <div class="col-md-8 col-lg-6 text-center">
                
                <div class="card shadow-lg border-0" style="border-radius: 1.5rem; background: #fff;">
                    <div class="card-body p-5">
                        
                        <div class="mb-4">
                            <div class="avatar-text avatar-xl bg-soft-warning text-warning mx-auto shadow-sm" style="width: 100px; height: 100px;">
                                <i class="feather-clock" style="font-size: 3rem;"></i>
                            </div>
                        </div>

                        <h2 class="fw-bolder mb-3 text-dark">Exam Not Started Yet</h2>
                        
                        <p class="text-muted fs-15 mb-4 px-4">
                            The administrator is currently preparing your exam room. <br>
                            Please wait until they officially launch the exam test packet.
                        </p>

                        <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="text-primary fw-bold letter-spacing-1">WAITING FOR ADMIN...</span>
                        </div>

                        <div class="mt-5 pt-3 border-top border-gray-100">
                            <button onclick="window.location.reload();" class="btn btn-light-brand px-5 fw-semibold" style="border-radius: 50px;">
                                <i class="feather-rotate-cw me-2"></i> REFRESH PAGE
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
