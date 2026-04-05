@extends('User.userlayout')

@section('User-content')

    <div class="main-content">
        <div class="row g-3">

            {{-- ── PAGE HEADER ── --}}
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between flex-wrap"
                    style="gap:1rem;margin-bottom:.25rem">
                    <div>
                        <h4 class="fw-bold text-dark mb-0" style="font-size:1.25rem">All Exams</h4>
                        <p class="fs-12 text-muted mb-0 mt-1">Browse, filter and attempt your assigned exams</p>
                    </div>
                    {{-- Search bar --}}
                    <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap">
                        <div style="
                        display:flex;align-items:center;gap:8px;
                        background:#fff;border:1px solid #e5e7eb;
                        border-radius:10px;padding:.45rem 1rem;width:240px
                      ">
                            <i class="feather-search" style="font-size:14px;color:#9ca3af"></i>
                            <input type="text" id="exam-search" placeholder="Search exams…"
                                style="border:none;outline:none;font-size:13px;color:#374151;width:100%;font-family:inherit;background:transparent" />
                        </div>
                        <div class="dropdown">
                            <button style="
                          display:flex;align-items:center;gap:6px;
                          background:#fff;border:1px solid #e5e7eb;
                          border-radius:10px;padding:.45rem 1rem;
                          font-size:13px;font-weight:600;color:#374151;cursor:pointer
                        " data-bs-toggle="dropdown">
                                <i class="feather-filter" style="font-size:13px"></i> Filter
                                <i class="feather-chevron-down" style="font-size:12px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" style="min-width:160px">
                                <a href="#" class="dropdown-item fs-13">All Subjects</a>
                                <a href="#" class="dropdown-item fs-13">Computer Science</a>
                                <a href="#" class="dropdown-item fs-13">Mathematics</a>
                                <a href="#" class="dropdown-item fs-13">Physics</a>
                                <a href="#" class="dropdown-item fs-13">Chemistry</a>
                                <a href="#" class="dropdown-item fs-13">English</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── FILTER TABS + COUNTS ── --}}
            <div class="col-12">
                <div class="card" style="border-radius:14px">
                    <div class="card-body" style="padding:.75rem 1.25rem">
                        <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap" id="filter-tabs">
                            @php
                                $tabs = [
                                    ['all', 'All Exams', 24, '#4f46e5', '#ede9fe'],
                                    ['available', 'Available', 8, '#10b981', '#d1fae5'],
                                    ['upcoming', 'Upcoming', 6, '#f59e0b', '#fef3c7'],
                                    ['completed', 'Completed', 10, '#6b7280', '#f3f4f6'],
                                ];
                            @endphp
                            @foreach($tabs as [$key, $label, $count, $activeColor, $activeBg])
                                <button data-tab="{{ $key }}" onclick="filterExams('{{ $key }}')" style="
                                                    display:flex;align-items:center;gap:7px;padding:.45rem 1rem;
                                                    border-radius:8px;border:1px solid #e5e7eb;font-size:13px;
                                                    font-weight:600;cursor:pointer;transition:all .2s;
                                                    background:{{ $key === 'all' ? $activeBg : '#fff' }};
                                                    color:{{ $key === 'all' ? $activeColor : '#6b7280' }};
                                                    border-color:{{ $key === 'all' ? $activeColor : '#e5e7eb' }};
                                                  " data-active-color="{{ $activeColor }}" data-active-bg="{{ $activeBg }}">
                                    {{ $label }}
                                    <span style="
                                                    background:{{ $key === 'all' ? $activeColor : '#f3f4f6' }};
                                                    color:{{ $key === 'all' ? '#fff' : '#6b7280' }};
                                                    font-size:10px;font-weight:700;padding:1px 7px;border-radius:20px
                                                  ">{{ $count }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── EXAM CARDS GRID ── --}}
            {{-- Replace $exams with your controller variable --}}
            @php
                $exams = [
                    [
                        'title' => 'Data Structures & Algorithms',
                        'code' => 'CS101',
                        'subject' => 'Computer Science',
                        'questions' => 60,
                        'duration' => '90 min',
                        'marks' => 100,
                        'pass' => 40,
                        'deadline' => 'Today, 11:59 PM',
                        'status' => 'available',
                        'color' => 'primary',
                        'icon' => 'feather-cpu',
                        'attempts' => 1,
                        'max_attempts' => 2,
                        'difficulty' => 'Medium',
                        'diff_color' => 'warning',
                    ],
                    [
                        'title' => 'Calculus II — Integration',
                        'code' => 'MATH201',
                        'subject' => 'Mathematics',
                        'questions' => 45,
                        'duration' => '75 min',
                        'marks' => 100,
                        'pass' => 35,
                        'deadline' => 'Apr 06, 2026',
                        'status' => 'available',
                        'color' => 'warning',
                        'icon' => 'feather-trending-up',
                        'attempts' => 0,
                        'max_attempts' => 1,
                        'difficulty' => 'Hard',
                        'diff_color' => 'danger',
                    ],
                    [
                        'title' => 'Organic Chemistry Reactions',
                        'code' => 'CHEM301',
                        'subject' => 'Chemistry',
                        'questions' => 50,
                        'duration' => '60 min',
                        'marks' => 100,
                        'pass' => 40,
                        'deadline' => 'Apr 08, 2026',
                        'status' => 'upcoming',
                        'color' => 'danger',
                        'icon' => 'feather-zap',
                        'attempts' => 0,
                        'max_attempts' => 1,
                        'difficulty' => 'Hard',
                        'diff_color' => 'danger',
                    ],
                    [
                        'title' => 'Physics — Mechanics & Motion',
                        'code' => 'PHY102',
                        'subject' => 'Physics',
                        'questions' => 40,
                        'duration' => '60 min',
                        'marks' => 100,
                        'pass' => 35,
                        'deadline' => 'Completed',
                        'status' => 'completed',
                        'color' => 'info',
                        'icon' => 'feather-activity',
                        'attempts' => 1,
                        'max_attempts' => 1,
                        'difficulty' => 'Medium',
                        'diff_color' => 'warning',
                        'score' => 41,
                        'passed' => false,
                    ],
                    [
                        'title' => 'English Literature — Poetry',
                        'code' => 'ENG205',
                        'subject' => 'English',
                        'questions' => 30,
                        'duration' => '45 min',
                        'marks' => 100,
                        'pass' => 40,
                        'deadline' => 'Completed',
                        'status' => 'completed',
                        'color' => 'success',
                        'icon' => 'feather-book-open',
                        'attempts' => 1,
                        'max_attempts' => 1,
                        'difficulty' => 'Easy',
                        'diff_color' => 'success',
                        'score' => 78,
                        'passed' => true,
                    ],
                    [
                        'title' => 'Advanced Algorithms',
                        'code' => 'CS401',
                        'subject' => 'Computer Science',
                        'questions' => 60,
                        'duration' => '90 min',
                        'marks' => 100,
                        'pass' => 40,
                        'deadline' => 'Today, 2:30 PM',
                        'status' => 'available',
                        'color' => 'primary',
                        'icon' => 'feather-code',
                        'attempts' => 0,
                        'max_attempts' => 1,
                        'difficulty' => 'Hard',
                        'diff_color' => 'danger',
                    ],
                ];
            @endphp

            @foreach($exams as $exam)
                <div class="col-xxl-4 col-md-6 exam-card-col" data-status="{{ $exam['status'] }}">
                    <div class="card stretch stretch-full"
                        style="border-radius:16px;border:1px solid #e5e7eb;transition:box-shadow .2s"
                        onmouseover="this.style.boxShadow='0 4px 20px rgba(79,70,229,.1)'"
                        onmouseout="this.style.boxShadow='none'">
                        <div class="card-body" style="padding:1.35rem">

                            {{-- Top row: subject badge + difficulty + status --}}
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge bg-soft-{{ $exam['color'] }} text-{{ $exam['color'] }}">
                                    {{ $exam['code'] }}
                                </span>
                                <div style="display:flex;align-items:center;gap:6px">
                                    <span class="badge bg-soft-{{ $exam['diff_color'] }} text-{{ $exam['diff_color'] }}"
                                        style="font-size:10px">
                                        {{ $exam['difficulty'] }}
                                    </span>
                                    @if($exam['status'] === 'available')
                                        <span class="badge bg-soft-success text-success" style="font-size:10px">Open</span>
                                    @elseif($exam['status'] === 'upcoming')
                                        <span class="badge bg-soft-warning text-warning" style="font-size:10px">Soon</span>
                                    @else
                                        <span class="badge bg-gray-200 text-dark" style="font-size:10px">Done</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Icon + Title --}}
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="avatar-text avatar-lg bg-soft-{{ $exam['color'] }} text-{{ $exam['color'] }}"
                                    style="flex-shrink:0">
                                    <i class="{{ $exam['icon'] }}" style="font-size:18px"></i>
                                </div>
                                <div style="min-width:0">
                                    <div class="fw-bold text-dark text-truncate-1-line"
                                        style="font-size:14.5px;line-height:1.3">
                                        {{ $exam['title'] }}
                                    </div>
                                    <div class="fs-12 text-muted mt-1">{{ $exam['subject'] }}</div>
                                </div>
                            </div>

                            {{-- Details grid --}}
                            <div style="
                                    display:grid;grid-template-columns:1fr 1fr;gap:.5rem;
                                    background:#f9fafb;border-radius:10px;padding:.85rem;margin-bottom:1rem
                                  ">
                                <div>
                                    <div
                                        style="font-size:10px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">
                                        Questions</div>
                                    <div class="fw-bold text-dark" style="font-size:15px">{{ $exam['questions'] }}</div>
                                </div>
                                <div>
                                    <div
                                        style="font-size:10px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">
                                        Duration</div>
                                    <div class="fw-bold text-dark" style="font-size:15px">{{ $exam['duration'] }}</div>
                                </div>
                                <div>
                                    <div
                                        style="font-size:10px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">
                                        Total Marks</div>
                                    <div class="fw-bold text-dark" style="font-size:15px">{{ $exam['marks'] }}</div>
                                </div>
                                <div>
                                    <div
                                        style="font-size:10px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">
                                        Pass Mark</div>
                                    <div class="fw-bold text-dark" style="font-size:15px">{{ $exam['pass'] }}</div>
                                </div>
                            </div>

                            {{-- Deadline row --}}
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="feather-calendar" style="font-size:13px;color:#9ca3af"></i>
                                    <span class="fs-12 text-muted">{{ $exam['deadline'] }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="feather-refresh-cw" style="font-size:12px;color:#9ca3af"></i>
                                    <span class="fs-12 text-muted">{{ $exam['attempts'] }}/{{ $exam['max_attempts'] }}
                                        attempts</span>
                                </div>
                            </div>

                            {{-- Attempts progress bar --}}
                            <div class="progress mb-3 ht-3">
                                @php $pct = $exam['max_attempts'] > 0 ? ($exam['attempts'] / $exam['max_attempts']) * 100 : 0; @endphp
                                <div class="progress-bar bg-{{ $exam['color'] }}" role="progressbar" style="width:{{ $pct }}%">
                                </div>
                            </div>

                            {{-- Score row (only for completed) --}}
                            @if($exam['status'] === 'completed' && isset($exam['score']))
                                <div class="d-flex align-items-center justify-content-between mb-3"
                                    style="background:#f9fafb;border-radius:10px;padding:.65rem 1rem">
                                    <span class="fs-12 fw-semibold text-muted">Your Score</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold text-dark" style="font-size:16px;font-family:monospace">
                                            {{ $exam['score'] }}<span class="fs-12 text-muted fw-normal">/100</span>
                                        </span>
                                        @if($exam['passed'])
                                            <span class="badge bg-soft-success text-success">Passed</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger">Failed</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- CTA Button --}}
                            @if($exam['status'] === 'available' && $exam['attempts'] < $exam['max_attempts'])
                                <a href="{{ url('/exampage') }}" class="btn btn-primary w-100 fw-semibold"
                                    style="border-radius:10px;font-size:13px;padding:.6rem">
                                    <i class="feather-play-circle me-1"></i> Attempt Exam
                                </a>

                            @elseif($exam['status'] === 'upcoming')
                                <button disabled class="btn w-100 fw-semibold"
                                    style="border-radius:10px;font-size:13px;padding:.6rem;
                                                          background:#f3f4f6;color:#9ca3af;border:1px solid #e5e7eb;cursor:not-allowed">
                                    <i class="feather-lock me-1"></i> Not Open Yet
                                </button>

                            @elseif($exam['status'] === 'completed')
                                <a href="#" {{-- replace with route('exam.result', $exam['id']) --}} class="btn w-100 fw-semibold"
                                    style="border-radius:10px;font-size:13px;padding:.6rem;
                                                          background:#ede9fe;color:#4f46e5;border:1px solid #c4b5fd">
                                    <i class="feather-eye me-1"></i> View Result
                                </a>

                            @else
                                <button disabled class="btn w-100 fw-semibold"
                                    style="border-radius:10px;font-size:13px;padding:.6rem;
                                                          background:#f3f4f6;color:#9ca3af;border:1px solid #e5e7eb;cursor:not-allowed">
                                    <i class="feather-check me-1"></i> Max Attempts Reached
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

            {{-- ── PAGINATION ── --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap"
                        style="padding:.85rem 1.25rem;gap:.75rem">
                        <span class="fs-12 text-muted">Showing <span class="fw-semibold text-dark">6</span> of <span
                                class="fw-semibold text-dark">24</span> exams</span>
                        <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                            <li><a href="#"><i class="bi bi-arrow-left"></i></a></li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="bi bi-dot"></i></a></li>
                            <li><a href="#">8</a></li>
                            <li><a href="#"><i class="bi bi-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>{{-- /row --}}
    </div>{{-- /main-content --}}

    @push('scripts')
        <script>
            // ── Tab filter ──
            function filterExams(status) {
                // Update tab styles
                document.querySelectorAll('#filter-tabs button').forEach(btn => {
                    const isActive = btn.dataset.tab === status;
                    btn.style.background = isActive ? btn.dataset.activeBg : '#fff';
                    btn.style.color = isActive ? btn.dataset.activeColor : '#6b7280';
                    btn.style.borderColor = isActive ? btn.dataset.activeColor : '#e5e7eb';
                    const badge = btn.querySelector('span');
                    badge.style.background = isActive ? btn.dataset.activeColor : '#f3f4f6';
                    badge.style.color = isActive ? '#fff' : '#6b7280';
                });

                // Show / hide cards
                document.querySelectorAll('.exam-card-col').forEach(col => {
                    const match = status === 'all' || col.dataset.status === status;
                    col.style.display = match ? '' : 'none';
                });
            }

            // ── Search filter ──
            document.getElementById('exam-search').addEventListener('input', function () {
                const q = this.value.toLowerCase();
                document.querySelectorAll('.exam-card-col').forEach(col => {
                    const text = col.innerText.toLowerCase();
                    col.style.display = text.includes(q) ? '' : 'none';
                });
            });
        </script>
    @endpush

@endsection