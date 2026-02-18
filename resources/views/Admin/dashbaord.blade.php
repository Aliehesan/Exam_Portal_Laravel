@extends('layout')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <!-- [Invoices Awaiting Payment] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-gray-200">
                                    <i class="feather-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">45</span>/<span
                                            class="counter">76</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Invoices Awaiting Payment
                                    </h3>
                                </div>
                            </div>
                            <a href="#" class="">
                                <i class="feather-more-vertical"></i>
                            </a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted text-truncate-1-line">Invoices
                                    Awaiting
                                </a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">$5,569</span>
                                    <span class="fs-11 text-muted">(56%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 56%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Invoices Awaiting Payment] end -->
            <!-- [Converted Leads] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-gray-200">
                                    <i class="feather-cast"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">48</span>/<span
                                            class="counter">86</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Converted Leads</h3>
                                </div>
                            </div>
                            <a href="#" class="">
                                <i class="feather-more-vertical"></i>
                            </a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted text-truncate-1-line">Converted
                                    Leads </a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">52 Completed</span>
                                    <span class="fs-11 text-muted">(63%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 63%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Converted Leads] end -->
            <!-- [Projects In Progress] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-gray-200">
                                    <i class="feather-briefcase"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">16</span>/<span
                                            class="counter">20</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Projects In Progress</h3>
                                </div>
                            </div>
                            <a href="#" class="">
                                <i class="feather-more-vertical"></i>
                            </a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted text-truncate-1-line">Projects In
                                    Progress
                                </a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">16 Completed</span>
                                    <span class="fs-11 text-muted">(78%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 78%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Projects In Progress] end -->
            <!-- [Conversion Rate] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-gray-200">
                                    <i class="feather-activity"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">46.59</span>%
                                    </div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Conversion Rate</h3>
                                </div>
                            </div>
                            <a href="#" class="">
                                <i class="feather-more-vertical"></i>
                            </a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted text-truncate-1-line"> Conversion
                                    Rate
                                </a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">$2,254</span>
                                    <span class="fs-11 text-muted">(46%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 46%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Conversion Rate] end -->
            <!-- [Mini] start -->
            <div class="col-lg-4">
                <div class="card mb-4 stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-text">
                                <i class="feather feather-star"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">Tasks Completed</div>
                                <div class="fs-12 text-muted">22/35 completed</div>
                            </div>
                        </div>
                        <div class="fs-4 fw-bold text-dark">22/35</div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between gap-4">
                        <div id="task-completed-area-chart"></div>
                        <div class="fs-12 text-muted text-nowrap">
                            <span class="fw-semibold text-primary">28% more</span><br />
                            <span>from last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-text">
                                <i class="feather feather-file-text"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">New Tasks</div>
                                <div class="fs-12 text-muted">0/20 tasks</div>
                            </div>
                        </div>
                        <div class="fs-4 fw-bold text-dark">5/20</div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between gap-4">
                        <div id="new-tasks-area-chart"></div>
                        <div class="fs-12 text-muted text-nowrap">
                            <span class="fw-semibold text-success">34% more</span><br />
                            <span>from last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-text">
                                <i class="feather feather-airplay"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">Project Done</div>
                                <div class="fs-12 text-muted">20/30 project</div>
                            </div>
                        </div>
                        <div class="fs-4 fw-bold text-dark">20/30</div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between gap-4">
                        <div id="project-done-area-chart"></div>
                        <div class="fs-12 text-muted text-nowrap">
                            <span class="fw-semibold text-danger">42% more</span><br />
                            <span>from last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Mini] end !-->
            <!-- [Latest Leads] start -->
            <div class="col-xxl-8">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Latest Leads</h5>
                        <div class="card-header-action">
                            <div class="card-header-btn">
                                <div data-bs-toggle="tooltip" title="Delete">
                                    <a href="#" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove">
                                    </a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Refresh">
                                    <a href="#" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh">
                                    </a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                    <a href="#" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand">
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                    <div data-bs-toggle="tooltip" title="Options">
                                        <i class="feather-more-vertical"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                    <a href="#" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                    <a href="#" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                    <a href="#" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                    <a href="#" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &
                                        Tricks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th scope="row">Users</th>
                                        <th>Proposal</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-image">
                                                    <img src="assets/images/avatar/2.png" alt="" class="img-fluid" />
                                                </div>
                                                <a href="#">
                                                    <span class="d-block">Archie Cantones</span>
                                                    <span
                                                        class="fs-12 d-block fw-normal text-muted">arcie.tones@gmail.com</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-gray-200 text-dark">Sent</span>
                                        </td>
                                        <td>11/06/2023 10:53</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Completed</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"><i class="feather-more-vertical"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-image">
                                                    <img src="assets/images/avatar/3.png" alt="" class="img-fluid" />
                                                </div>
                                                <a href="#">
                                                    <span class="d-block">Holmes Cherryman</span>
                                                    <span
                                                        class="fs-12 d-block fw-normal text-muted">golms.chan@gmail.com</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-gray-200 text-dark">New</span>
                                        </td>
                                        <td>11/06/2023 10:53</td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">In Progress </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"><i class="feather-more-vertical"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-image">
                                                    <img src="assets/images/avatar/4.png" alt="" class="img-fluid" />
                                                </div>
                                                <a href="#">
                                                    <span class="d-block">Malanie Hanvey</span>
                                                    <span
                                                        class="fs-12 d-block fw-normal text-muted">lanie.nveyn@gmail.com</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-gray-200 text-dark">Sent</span>
                                        </td>
                                        <td>11/06/2023 10:53</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Completed</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"><i class="feather-more-vertical"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-image">
                                                    <img src="assets/images/avatar/5.png" alt="" class="img-fluid" />
                                                </div>
                                                <a href="#">
                                                    <span class="d-block">Kenneth Hune</span>
                                                    <span
                                                        class="fs-12 d-block fw-normal text-muted">nneth.une@gmail.com</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-gray-200 text-dark">Returning</span>
                                        </td>
                                        <td>11/06/2023 10:53</td>
                                        <td>
                                            <span class="badge bg-soft-warning text-warning">Not
                                                Interested</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"><i class="feather-more-vertical"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-image">
                                                    <img src="assets/images/avatar/6.png" alt="" class="img-fluid" />
                                                </div>
                                                <a href="#">
                                                    <span class="d-block">Valentine Maton</span>
                                                    <span
                                                        class="fs-12 d-block fw-normal text-muted">alenine.aton@gmail.com</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-gray-200 text-dark">Sent</span>
                                        </td>
                                        <td>11/06/2023 10:53</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Completed</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"><i class="feather-more-vertical"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                            <li>
                                <a href="#"><i class="bi bi-arrow-left"></i></a>
                            </li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li>
                                <a href="#"><i class="bi bi-dot"></i></a>
                            </li>
                            <li><a href="#">8</a></li>
                            <li><a href="#">9</a></li>
                            <li>
                                <a href="#"><i class="bi bi-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- [Latest Leads] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection