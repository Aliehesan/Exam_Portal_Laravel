@extends('User.userlayout')

@section('User-content')

    <div class="main-content">
        <div class="row g-3">

            {{-- ── PAGE HEADER ── --}}
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:1rem">
                    <div>
                        <h4 class="fw-bold text-dark mb-0" style="font-size:1.25rem">My Results</h4>
                        <p class="fs-12 text-muted mb-0 mt-1">All your attempted exams and detailed performance</p>
                    </div>
                    <div style="display:flex;align-items:center;gap:.65rem;flex-wrap:wrap">
                        {{-- Search --}}
                        <div style="
                        display:flex;align-items:center;gap:8px;
                        background:#fff;border:1px solid #e5e7eb;
                        border-radius:10px;padding:.42rem .9rem;width:220px
                      ">
                            <i class="feather-search" style="font-size:14px;color:#9ca3af"></i>
                            <input id="result-search" type="text" placeholder="Search results…" style="border:none;outline:none;font-size:13px;color:#374151;
                          width:100%;font-family:inherit;background:transparent" />
                        </div>
                        {{-- Export --}}
                        <a href="#" style="
                        display:flex;align-items:center;gap:6px;
                        background:#fff;border:1px solid #e5e7eb;border-radius:10px;
                        padding:.42rem .9rem;font-size:13px;font-weight:600;
                        color:#374151;text-decoration:none
                      ">
                            <i class="feather-download" style="font-size:13px"></i> Export
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── PERFORMANCE SUMMARY CARDS ── --}}
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                    <i class="feather-file-text" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">10</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Attempted</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted" style="font-size:16px"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Out of 12 exams</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">2 Remaining</span>
                                    <span class="fs-11 text-muted">(83%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width:83%"></div>
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
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">8</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Exams Passed</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted" style="font-size:16px"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Pass Rate</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">80% Pass</span>
                                    <span class="fs-11 text-muted">(+4% ↑)</span>
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
                                    <i class="feather-bar-chart-2" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">82</span><span
                                            style="font-size:1rem">/100</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Average Score</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted" style="font-size:16px"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Score Trend</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">Grade B+</span>
                                    <span class="fs-11 text-muted">(82%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:82%"></div>
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
                                    <i class="feather-x-circle" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">2</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Exams Failed</h3>
                                </div>
                            </div>
                            <a href="#"><i class="feather-more-vertical text-muted" style="font-size:16px"></i></a>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Fail Rate</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">Retry Available</span>
                                    <span class="fs-11 text-muted">(20%)</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:20%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /STAT CARDS --}}

            {{-- ── RESULTS TABLE ── --}}
            <div class="col-12">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Attempted Exam Results</h5>
                        <div class="card-header-action">
                            {{-- Status filter pills --}}
                            <div style="display:flex;gap:.4rem" id="result-filter">
                                @foreach([['all', 'All'], ['passed', 'Passed'], ['failed', 'Failed']] as [$k, $l])
                                    <button data-filter="{{ $k }}" onclick="filterResults('{{ $k }}')" style="
                                              padding:.28rem .75rem;border-radius:20px;font-size:11px;font-weight:700;
                                              cursor:pointer;border:1px solid #e5e7eb;transition:all .2s;
                                              background:{{ $k === 'all' ? '#4f46e5' : '#fff' }};
                                              color:{{ $k === 'all' ? '#fff' : '#6b7280' }};
                                            ">{{ $l }}</button>
                                @endforeach
                            </div>
                            <div class="card-header-btn ms-2">
                                <div><a href="#" class="avatar-text avatar-xs bg-danger"></a></div>
                                <div><a href="#" class="avatar-text avatar-xs bg-warning"></a></div>
                                <div><a href="#" class="avatar-text avatar-xs bg-success"></a></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th>#</th>
                                        <th>Exam</th>
                                        <th>Subject</th>
                                        <th>Score</th>
                                        <th>Grade</th>
                                        <th>Time Taken</th>
                                        <th>Attempted On</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Replace with @foreach($results as $result) from controller --}}
                                    @php
                                        $results = [
                                            [
                                                'id' => 1,
                                                'exam' => 'Data Structures & Algorithms',
                                                'code' => 'CS101',
                                                'subject' => 'Computer Science',
                                                'color' => 'primary',
                                                'score' => 88,
                                                'pass' => 40,
                                                'total' => 100,
                                                'grade' => 'A',
                                                'time' => '47 min',
                                                'date' => '01 Apr 2026',
                                                'passed' => true,
                                            ],
                                            [
                                                'id' => 2,
                                                'exam' => 'Calculus II — Integration',
                                                'code' => 'MATH201',
                                                'subject' => 'Mathematics',
                                                'color' => 'warning',
                                                'score' => 72,
                                                'pass' => 35,
                                                'total' => 100,
                                                'grade' => 'B',
                                                'time' => '55 min',
                                                'date' => '29 Mar 2026',
                                                'passed' => true,
                                            ],
                                            [
                                                'id' => 3,
                                                'exam' => 'Organic Chemistry Reactions',
                                                'code' => 'CHEM301',
                                                'subject' => 'Chemistry',
                                                'color' => 'danger',
                                                'score' => 95,
                                                'pass' => 40,
                                                'total' => 100,
                                                'grade' => 'A+',
                                                'time' => '38 min',
                                                'date' => '27 Mar 2026',
                                                'passed' => true,
                                            ],
                                            [
                                                'id' => 4,
                                                'exam' => 'Physics — Mechanics & Motion',
                                                'code' => 'PHY102',
                                                'subject' => 'Physics',
                                                'color' => 'info',
                                                'score' => 41,
                                                'pass' => 35,
                                                'total' => 100,
                                                'grade' => 'D',
                                                'time' => '60 min',
                                                'date' => '25 Mar 2026',
                                                'passed' => false,
                                            ],
                                            [
                                                'id' => 5,
                                                'exam' => 'English Literature — Poetry',
                                                'code' => 'ENG205',
                                                'subject' => 'English',
                                                'color' => 'success',
                                                'score' => 78,
                                                'pass' => 40,
                                                'total' => 100,
                                                'grade' => 'B+',
                                                'time' => '52 min',
                                                'date' => '22 Mar 2026',
                                                'passed' => true,
                                            ],
                                            [
                                                'id' => 6,
                                                'exam' => 'Operating Systems',
                                                'code' => 'CS303',
                                                'subject' => 'Computer Science',
                                                'color' => 'primary',
                                                'score' => 84,
                                                'pass' => 40,
                                                'total' => 100,
                                                'grade' => 'A',
                                                'time' => '68 min',
                                                'date' => '18 Mar 2026',
                                                'passed' => true,
                                            ],
                                            [
                                                'id' => 7,
                                                'exam' => 'Linear Algebra',
                                                'code' => 'MATH301',
                                                'subject' => 'Mathematics',
                                                'color' => 'warning',
                                                'score' => 33,
                                                'pass' => 35,
                                                'total' => 100,
                                                'grade' => 'F',
                                                'time' => '70 min',
                                                'date' => '15 Mar 2026',
                                                'passed' => false,
                                            ],
                                            [
                                                'id' => 8,
                                                'exam' => 'Thermodynamics',
                                                'code' => 'PHY202',
                                                'subject' => 'Physics',
                                                'color' => 'info',
                                                'score' => 76,
                                                'pass' => 40,
                                                'total' => 100,
                                                'grade' => 'B',
                                                'time' => '58 min',
                                                'date' => '10 Mar 2026',
                                                'passed' => true,
                                            ],
                                        ];
                                    @endphp

                                    @foreach($results as $i => $r)
                                        <tr class="result-row" data-status="{{ $r['passed'] ? 'passed' : 'failed' }}">

                                            {{-- Serial --}}
                                            <td>
                                                <span
                                                    class="fw-semibold text-muted fs-12">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                            </td>

                                            {{-- Exam name --}}
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px">
                                                    <div class="avatar-text avatar-sm bg-soft-{{ $r['color'] }} text-{{ $r['color'] }}"
                                                        style="border-radius:10px;width:34px;height:34px;flex-shrink:0">
                                                        <i class="feather-file-text" style="font-size:13px"></i>
                                                    </div>
                                                    <div style="min-width:0">
                                                        <span class="d-block fw-semibold text-dark text-truncate-1-line"
                                                            style="font-size:13px;max-width:200px">
                                                            {{ $r['exam'] }}
                                                        </span>
                                                        <span class="fs-11 text-muted">Pass mark:
                                                            {{ $r['pass'] }}/{{ $r['total'] }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Subject --}}
                                            <td>
                                                <span class="badge bg-soft-{{ $r['color'] }} text-{{ $r['color'] }}">
                                                    {{ $r['code'] }}
                                                </span>
                                            </td>

                                            {{-- Score with inline bar --}}
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px;min-width:120px">
                                                    <span class="fw-bold text-dark"
                                                        style="font-size:15px;font-family:monospace;flex-shrink:0">
                                                        {{ $r['score'] }}<span
                                                            class="fs-11 text-muted fw-normal">/{{ $r['total'] }}</span>
                                                    </span>
                                                    <div style="flex:1">
                                                        <div class="progress ht-3">
                                                            @php
                                                                $pct = ($r['score'] / $r['total']) * 100;
                                                                $barcl = $pct >= 75 ? 'success' : ($pct >= 40 ? 'warning' : 'danger');
                                                              @endphp
                                                            <div class="progress-bar bg-{{ $barcl }}" style="width:{{ $pct }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Grade badge --}}
                                            <td>
                                                @php
                                                    $gc = match (true) {
                                                        str_contains($r['grade'], 'A') => ['bg-soft-success text-success', '#'],
                                                        str_contains($r['grade'], 'B') => ['bg-soft-primary text-primary', '#'],
                                                        str_contains($r['grade'], 'C') => ['bg-soft-warning text-warning', '#'],
                                                        default => ['bg-soft-danger text-danger', '#'],
                                                    };
                                                @endphp
                                                <span class="badge {{ $gc[0] }}"
                                                    style="font-size:13px;font-weight:800;min-width:34px;text-align:center;font-family:monospace">
                                                    {{ $r['grade'] }}
                                                </span>
                                            </td>

                                            {{-- Time taken --}}
                                            <td>
                                                <div style="display:flex;align-items:center;gap:5px">
                                                    <i class="feather-clock" style="font-size:12px;color:#9ca3af"></i>
                                                    <span class="fs-12 text-muted">{{ $r['time'] }}</span>
                                                </div>
                                            </td>

                                            {{-- Date --}}
                                            <td>
                                                <span class="fs-12 text-muted">{{ $r['date'] }}</span>
                                            </td>

                                            {{-- Pass/Fail --}}
                                            <td>
                                                @if($r['passed'])
                                                    <span class="badge bg-soft-success text-success">
                                                        <i class="feather-check" style="font-size:11px"></i> Passed
                                                    </span>
                                                @else
                                                    <span class="badge bg-soft-danger text-danger">
                                                        <i class="feather-x" style="font-size:11px"></i> Failed
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- Action --}}
                                            <td class="text-end">
                                                <div style="display:flex;align-items:center;justify-content:flex-end;gap:.4rem">
                                                    <a href="#" {{-- route('exam.review', $r['id']) --}}
                                                        class="fs-12 fw-semibold text-primary" style="white-space:nowrap">
                                                        <i class="feather-eye" style="font-size:12px"></i> Review
                                                    </a>
                                                    @if(!$r['passed'])
                                                        <span style="color:#e5e7eb">|</span>
                                                        <a href="#" {{-- route('exam.attempt', $r['id']) --}}
                                                            class="fs-12 fw-semibold text-danger" style="white-space:nowrap">
                                                            <i class="feather-refresh-cw" style="font-size:12px"></i> Retry
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between flex-wrap" style="gap:.75rem">
                        <span class="fs-12 text-muted">
                            Showing <span class="fw-semibold text-dark">8</span> of <span
                                class="fw-semibold text-dark">10</span> results
                        </span>
                        <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                            <li><a href="#"><i class="bi bi-arrow-left"></i></a></li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#"><i class="bi bi-arrow-right"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
            {{-- /RESULTS TABLE --}}

            {{-- ── SUBJECT BREAKDOWN ── --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Performance by Subject</h5>
                        <span class="fs-12 text-muted">Average score across all attempted exams</span>
                    </div>
                    <div class="card-body">
                        @php
                            $subjects = [
                                ['Computer Science', 'primary', 86, 2],
                                ['Mathematics', 'warning', 52, 2],
                                ['Chemistry', 'danger', 95, 1],
                                ['Physics', 'info', 58, 2],
                                ['English', 'success', 78, 1],
                            ];
                          @endphp
                        <div class="row g-3">
                            @foreach($subjects as [$name, $color, $avg, $count])
                                <div class="col-xxl-4 col-md-6">
                                    <div style="
                                            background:#f9fafb;border-radius:12px;padding:1rem 1.25rem;
                                            border-left:3px solid var(--bs-{{ $color }},#4f46e5)
                                          ">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <div class="fw-semibold text-dark" style="font-size:13.5px">{{ $name }}</div>
                                                <div class="fs-12 text-muted">{{ $count }} exam{{ $count > 1 ? 's' : '' }}
                                                    attempted</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="fw-bold text-dark"
                                                    style="font-size:1.3rem;font-family:monospace;line-height:1">
                                                    {{ $avg }}
                                                </div>
                                                <div class="fs-11 text-muted">avg / 100</div>
                                            </div>
                                        </div>
                                        <div class="progress ht-3">
                                            <div class="progress-bar bg-{{ $color }}" style="width:{{ $avg }}%"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <span class="fs-11 text-muted">0</span>
                                            @php
                                                $grade = match (true) {
                                                    $avg >= 90 => ['A+', 'success'],
                                                    $avg >= 80 => ['A', 'success'],
                                                    $avg >= 70 => ['B+', 'primary'],
                                                    $avg >= 60 => ['B', 'primary'],
                                                    $avg >= 50 => ['C', 'warning'],
                                                    default => ['F', 'danger'],
                                                };
                                              @endphp
                                            <span class="badge bg-soft-{{ $grade[1] }} text-{{ $grade[1] }}"
                                                style="font-size:10px">
                                                Grade {{ $grade[0] }}
                                            </span>
                                            <span class="fs-11 text-muted">100</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- /SUBJECT BREAKDOWN --}}

        </div>{{-- /row --}}
    </div>{{-- /main-content --}}

    @push('scripts')
        <script>
            // ── Status filter (Passed / Failed / All) ──
            function filterResults(status) {
                document.querySelectorAll('#result-filter button').forEach(btn => {
                    const active = btn.dataset.filter === status;
                    btn.style.background = active ? '#4f46e5' : '#fff';
                    btn.style.color = active ? '#fff' : '#6b7280';
                    btn.style.borderColor = active ? '#4f46e5' : '#e5e7eb';
                });
                document.querySelectorAll('.result-row').forEach(row => {
                    row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
                });
            }

            // ── Search filter ──
            document.getElementById('result-search').addEventListener('input', function () {
                const q = this.value.toLowerCase();
                document.querySelectorAll('.result-row').forEach(row => {
                    row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
                });
            });
        </script>
    @endpush

@endsection