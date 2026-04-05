@extends('User.userlayout')

@section('User-content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">User Dashboard</h5>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->

    <div class="main-content">
        <div class="row g-3">

            {{-- ── WELCOME HERO ── --}}
            <div class="col-12">
                <div class="card" style="
                    background: linear-gradient(130deg, #1e1b4b 0%, #4f46e5 60%, #7c3aed 100%);
                    border: none; border-radius: 20px; overflow: hidden; position: relative;
                  ">
                    {{-- decorative circles --}}
                    <span style="position:absolute;width:220px;height:220px;border-radius:50%;
                      background:rgba(255,255,255,.05);top:-60px;right:60px;pointer-events:none"></span>
                    <span style="position:absolute;width:140px;height:140px;border-radius:50%;
                      background:rgba(255,255,255,.04);bottom:-40px;right:200px;pointer-events:none"></span>

                    <div class="card-body" style="padding: 2rem 2.25rem;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:1.5rem">

                            {{-- Left: greeting + next exam countdown --}}
                            <div>
                                <div style="
                            display:inline-flex;align-items:center;gap:6px;
                            background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.15);
                            border-radius:30px;padding:4px 14px;font-size:11px;
                            color:#c4b5fd;font-weight:600;letter-spacing:.4px;margin-bottom:.85rem;
                          ">
                                    <span style="width:6px;height:6px;background:#34d399;border-radius:50%;
                              display:inline-block;animation:dot-pulse 1.5s infinite"></span>
                                    Portal Active — Semester 2
                                </div>

                                <div
                                    style="font-size:1.55rem;font-weight:800;color:#fff;line-height:1.2;margin-bottom:.35rem">
                                    Welcome back, <span style="color:#c4b5fd">{{ auth()->user()->name ?? 'Student' }}</span>
                                    👋
                                </div>
                                <div style="font-size:13px;color:rgba(255,255,255,.55);margin-bottom:1.5rem">
                                    {{ now()->format('l, F d, Y') }} &nbsp;·&nbsp; Keep pushing — your next exam is close!
                                </div>

                                <div style="display:flex;gap:.75rem;flex-wrap:wrap">
                                    <a href="#" style="
                              background:#fff;color:#4f46e5;padding:.5rem 1.25rem;
                              border-radius:10px;font-size:13px;font-weight:700;
                              text-decoration:none;transition:opacity .2s
                            ">Start Practice Test</a>
                                    <a href="#" style="
                              background:rgba(255,255,255,.12);color:#fff;
                              border:1px solid rgba(255,255,255,.22);padding:.5rem 1.25rem;
                              border-radius:10px;font-size:13px;font-weight:600;
                              text-decoration:none
                            ">View My Results</a>
                                </div>
                            </div>

                            {{-- Right: subject score bars --}}
                            <div style="min-width:200px">
                                <div style="font-size:11px;font-weight:700;color:rgba(255,255,255,.4);
                            text-transform:uppercase;letter-spacing:1px;margin-bottom:.85rem">
                                    Subject Performance
                                </div>
                                @php
                                    $subjects = [
                                        ['CS', 88, '#818cf8'],
                                        ['MATH', 74, '#fb923c'],
                                        ['PHY', 66, '#34d399'],
                                        ['CHEM', 91, '#f472b6'],
                                        ['ENG', 79, '#60a5fa'],
                                    ];
                                  @endphp
                                @foreach($subjects as [$sub, $score, $color])
                                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:.5rem">
                                        <span
                                            style="font-size:11px;color:rgba(255,255,255,.5);width:34px;font-weight:600">{{ $sub }}</span>
                                        <div
                                            style="flex:1;height:6px;background:rgba(255,255,255,.1);border-radius:4px;overflow:hidden">
                                            <div
                                                style="height:100%;width:{{ $score }}%;background:{{ $color }};border-radius:4px">
                                            </div>
                                        </div>
                                        <span
                                            style="font-size:11px;color:#fff;font-weight:700;width:28px;text-align:right">{{ $score }}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- /HERO --}}

            {{-- ── STAT CARDS ── --}}
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                    <i class="feather-award" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">82</span><span
                                            style="font-size:1rem">/100</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Avg Score</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Overall Performance</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">Top 15%</span>
                                    <span class="fs-11 text-muted">(82%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width:82%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-success text-success">
                                    <i class="feather-check-circle" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">8</span>/<span
                                            class="counter">10</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Exams Passed</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Pass Rate</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">8 Cleared</span>
                                    <span class="fs-11 text-muted">(80%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width:80%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-warning" style="color:#d97706">
                                    <i class="feather-trending-up" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark">#<span class="counter">12</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Class Rank</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Out of 245 students</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">Top 5%</span>
                                    <span class="fs-11 text-muted">(↑3)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:95%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-danger text-danger">
                                    <i class="feather-zap" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">7</span> <span
                                            style="font-size:1rem">days</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Study Streak</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Keep it going!</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">Personal Best</span>
                                    <span class="fs-11 text-muted">(12 days)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:58%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /STAT CARDS --}}

            {{-- ── RECENT RESULTS TABLE ── --}}
            <div class="col-xxl-8">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">My Recent Results</h5>
                        <div class="card-header-action">
                            <div class="card-header-btn">
                                <div data-bs-toggle="tooltip" title="Delete">
                                    <a href="#" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"></a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Refresh">
                                    <a href="#" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"></a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Maximize">
                                    <a href="#" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"></a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25,25">
                                    <i class="feather-more-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item"><i class="feather-download"></i> Export PDF</a>
                                    <a href="#" class="dropdown-item"><i class="feather-eye"></i> View All</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item"><i class="feather-settings"></i> Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th>Exam</th>
                                        <th>Subject</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Replace this @foreach with your real $results variable --}}
                                    @php
                                        $results = [
                                            ['Data Structures', 'CS101', 88, '01 Apr 2026', 'Passed', 'success'],
                                            ['Calculus II', 'MATH201', 72, '29 Mar 2026', 'Passed', 'success'],
                                            ['Organic Chemistry', 'CHEM301', 95, '27 Mar 2026', 'Passed', 'success'],
                                            ['Physics Mechanics', 'PHY102', 41, '25 Mar 2026', 'Failed', 'danger'],
                                            ['English Literature', 'ENG205', 78, '22 Mar 2026', 'Passed', 'success'],
                                        ];
                                    @endphp
                                    @foreach($results as [$exam, $subject, $score, $date, $status, $color])
                                        <tr>
                                            <td>
                                                <span class="fw-semibold text-dark fs-13">{{ $exam }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-gray-200 text-dark">{{ $subject }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark" style="font-size:14px">{{ $score }}</span>
                                                <span class="fs-12 text-muted">/100</span>
                                                {{-- mini score bar --}}
                                                <div class="progress mt-1 ht-3" style="width:80px">
                                                    <div class="progress-bar bg-{{ $color }}" style="width:{{ $score }}%"></div>
                                                </div>
                                            </td>
                                            <td><span class="fs-12 text-muted">{{ $date }}</span></td>
                                            <td>
                                                <span class="badge bg-soft-{{ $color }} text-{{ $color }}">{{ $status }}</span>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="fs-12 fw-semibold text-primary">Review</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                            <li><a href="#"><i class="bi bi-arrow-left"></i></a></li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#"><i class="bi bi-dot"></i></a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><i class="bi bi-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- /RESULTS TABLE --}}

            {{-- ── NEXT EXAM + QUICK LINKS ── --}}
            <div class="col-xxl-4">

                {{-- Next Exam Card --}}
                <div class="card mb-3" style="border: 2px solid #ede9fe;">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                <i class="feather-clock" style="font-size:20px"></i>
                            </div>
                            <div>
                                <div class="fs-13 fw-semibold text-muted">Up Next</div>
                                <div class="fw-bold text-dark" style="font-size:1.1rem">Advanced Algorithms</div>
                            </div>
                        </div>

                        {{-- countdown-style info rows --}}
                        <div style="background:#f9f7ff;border-radius:12px;padding:1rem;margin-bottom:1rem">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-12 text-muted"><i class="feather-calendar" style="font-size:13px"></i>
                                    Date</span>
                                <span class="fs-12 fw-semibold text-dark">Today, 2:30 PM</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-12 text-muted"><i class="feather-layers" style="font-size:13px"></i>
                                    Subject</span>
                                <span class="badge bg-soft-primary text-primary">CS401</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-12 text-muted"><i class="feather-help-circle" style="font-size:13px"></i>
                                    Questions</span>
                                <span class="fs-12 fw-semibold text-dark">60 MCQs</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fs-12 text-muted"><i class="feather-clock" style="font-size:13px"></i>
                                    Duration</span>
                                <span class="fs-12 fw-semibold text-dark">90 Minutes</span>
                            </div>
                        </div>

                        {{-- Starts In countdown --}}
                        <div class="text-center mb-3">
                            <div class="fs-12 text-muted fw-medium mb-1">Starts In</div>
                            <div style="display:flex;justify-content:center;gap:.5rem">
                                @foreach([['02', 'Hrs'], ['34', 'Min'], ['18', 'Sec']] as [$val, $lbl])
                                    <div
                                        style="background:#1e1b4b;border-radius:10px;padding:.5rem .85rem;min-width:52px;text-align:center">
                                        <div
                                            style="font-size:1.25rem;font-weight:800;color:#fff;line-height:1;font-family:monospace">
                                            {{ $val }}</div>
                                        <div
                                            style="font-size:9px;color:#818cf8;font-weight:600;text-transform:uppercase;letter-spacing:.5px">
                                            {{ $lbl }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <a href="#" class="btn btn-primary w-100 fw-semibold" style="border-radius:10px;font-size:13px">
                            <i class="feather-play-circle me-1"></i> Enter Exam Room
                        </a>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Quick Actions</h5>
                    </div>
                    <div class="card-body" style="padding:.75rem 1.25rem">
                        @php
                            $actions = [
                                ['feather-book-open', 'Practice Tests', 'bg-soft-primary text-primary', '#'],
                                ['feather-bar-chart-2', 'My Analytics', 'bg-soft-success text-success', '#'],
                                ['feather-calendar', 'Exam Schedule', 'bg-soft-warning text-warning', '#'],
                                ['feather-download', 'Download Results', 'bg-soft-danger text-danger', '#'],
                            ];
                          @endphp
                        @foreach($actions as [$icon, $label, $cls, $href])
                            <a href="{{ $href }}" class="d-flex align-items-center gap-3 text-decoration-none" style="
                                padding:.65rem .5rem;border-radius:10px;transition:background .15s;
                                border-bottom: 1px solid #f3f4f6;
                                {{ $loop->last ? 'border-bottom:none' : '' }}
                              " onmouseover="this.style.background='#f9f7ff'" onmouseout="this.style.background='transparent'">
                                <div class="avatar-text avatar-sm {{ $cls }}" style="border-radius:10px">
                                    <i class="{{ $icon }}" style="font-size:14px"></i>
                                </div>
                                <span class="fs-13 fw-semibold text-dark">{{ $label }}</span>
                                <i class="feather-chevron-right text-muted ms-auto" style="font-size:14px"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
            {{-- /NEXT EXAM + QUICK LINKS --}}

        </div>{{-- /row --}}
    </div>{{-- /main-content --}}

    @push('scripts')
        <style>
            @keyframes dot-pulse {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: .4;
                    transform: scale(1.4);
                }
            }
        </style>
    @endpush
    <!-- [ Main Content ] end -->
@endsection