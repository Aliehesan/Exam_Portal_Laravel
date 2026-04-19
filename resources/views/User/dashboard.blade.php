@extends('User.userlayout')

@section('User-content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Student Dashboard</h5>
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
                                    @php
                                        $practiceExam = \App\Models\Exam::where('status', 'active')->first();
                                    @endphp
                                    <a href="{{ $practiceExam ? url('/exampage/' . $practiceExam->id) : url('/viewexam') }}" style="
                              background:#fff;color:#4f46e5;padding:.5rem 1.25rem;
                              border-radius:10px;font-size:13px;font-weight:700;
                              text-decoration:none;transition:opacity .2s
                            ">Start Practice Test</a>
                                    <a href="{{ url('/viewresult') }}" style="
                              background:rgba(255,255,255,.12);color:#fff;
                              border:1px solid rgba(255,255,255,.22);padding:.5rem 1.25rem;
                              border-radius:10px;font-size:13px;font-weight:600;
                              text-decoration:none
                            ">View My Results</a>
                                </div>
                            </div>

                            {{-- Right: subject score bars (dynamic from DB) --}}
                            <div style="min-width:200px">
                                <div style="font-size:11px;font-weight:700;color:rgba(255,255,255,.4);
                            text-transform:uppercase;letter-spacing:1px;margin-bottom:.85rem">
                                    Subject Performance
                                </div>
                                @php
                                    $userId = \Auth::id();
                                    $topics = \App\Models\Topic::all();
                                    $barColors = ['#818cf8', '#fb923c', '#34d399', '#f472b6', '#60a5fa', '#a78bfa', '#fbbf24', '#4ade80'];
                                    $colorIndex = 0;
                                    $subjectPerformance = [];
                                    
                                    foreach ($topics as $topic) {
                                        $topicResults = \App\Models\ExamResult::where('user_id', $userId)
                                            ->whereHas('exam', function($q) use ($topic) {
                                                $q->where('topic_id', $topic->id);
                                            })->get();
                                        
                                        $avgScore = $topicResults->count() > 0 ? round($topicResults->avg('score')) : 0;
                                        $subjectPerformance[] = [
                                            'name' => strtoupper(substr($topic->name, 0, 5)),
                                            'score' => $avgScore,
                                            'color' => $barColors[$colorIndex % count($barColors)],
                                        ];
                                        $colorIndex++;
                                    }
                                @endphp
                                @if(count($subjectPerformance) > 0)
                                    @foreach($subjectPerformance as $sp)
                                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:.5rem">
                                            <span
                                                style="font-size:11px;color:rgba(255,255,255,.5);width:42px;font-weight:600;text-overflow:ellipsis;overflow:hidden;white-space:nowrap">{{ $sp['name'] }}</span>
                                            <div
                                                style="flex:1;height:6px;background:rgba(255,255,255,.1);border-radius:4px;overflow:hidden">
                                                <div
                                                    style="height:100%;width:{{ $sp['score'] }}%;background:{{ $sp['color'] }};border-radius:4px">
                                                </div>
                                            </div>
                                            <span
                                                style="font-size:11px;color:#fff;font-weight:700;width:28px;text-align:right">{{ $sp['score'] }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div style="font-size:12px;color:rgba(255,255,255,.4)">No topics yet</div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- /HERO --}}

            {{-- ── STAT CARDS (3 cards instead of 4 — removed Class Rank) ── --}}
            <div class="col-xxl-4 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                    <i class="feather-award" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $avgScore }}</span><span
                                            style="font-size:1rem">/100</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Avg Score</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Overall Accuracy</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">{{ $avgScore }}%</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width:{{ $avgScore }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-success text-success">
                                    <i class="feather-check-circle" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $passedCount }}</span>/<span
                                            class="counter">{{ $totalAttempted }}</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Exams Passed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Pass Rate</a>
                                <div class="w-100 text-end">
                                    @php $passRate = $totalAttempted > 0 ? round(($passedCount / $totalAttempted) * 100) : 0; @endphp
                                    <span class="fs-12 text-dark">{{ $passRate }}%</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width:{{ $passRate }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-danger text-danger">
                                    <i class="feather-zap" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalAttempted }}</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Attempts</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Exams taken so far</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">{{ $totalAttempted }} Total</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:{{ min($totalAttempted * 10, 100) }}%"></div>
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
                            <a href="{{ url('viewresult') }}" class="btn btn-xs btn-light">View All</a>
                        </div>
                    </div>

                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th>Exam</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentResults as $r)
                                        <tr>
                                            <td>
                                                <span class="fw-semibold text-dark fs-13">{{ $r->exam->title }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark" style="font-size:14px">{{ $r->score }}</span>
                                                <span class="fs-12 text-muted">/100</span>
                                                <div class="progress mt-1 ht-3" style="width:80px">
                                                    <div class="progress-bar bg-{{ $r->passed ? 'success' : 'danger' }}" style="width:{{ $r->score }}%"></div>
                                                </div>
                                            </td>
                                            <td><span class="fs-12 text-muted">{{ $r->created_at->format('d M Y') }}</span></td>
                                            <td>
                                                <span class="badge bg-soft-{{ $r->passed ? 'success' : 'danger' }} text-{{ $r->passed ? 'success' : 'danger' }}">
                                                    {{ $r->passed ? 'Passed' : 'Failed' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ url('/review/' . $r->id) }}" class="fs-12 fw-semibold text-primary">Review</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">No recent results</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /RESULTS TABLE --}}

            {{-- ── NEXT EXAM CARD (proper alignment) ── --}}
            <div class="col-xxl-4">
                {{-- Next Exam Card --}}
                <div class="card" style="border: 2px solid #ede9fe;">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                <i class="feather-clock" style="font-size:20px"></i>
                            </div>
                            <div>
                                <div class="fs-13 fw-semibold text-muted">Up Next</div>
                                <div class="fw-bold text-dark" style="font-size:1.1rem">{{ $examTitle }}</div>
                            </div>
                        </div>

                        {{-- countdown-style info rows --}}
                        <div style="background:#f9f7ff;border-radius:12px;padding:1rem;margin-bottom:1rem">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-12 text-muted"><i class="feather-calendar" style="font-size:13px"></i>
                                    Date</span>
                                <span class="fs-12 fw-semibold text-dark">
                                    {{ $examScheduledDate ? \Carbon\Carbon::parse($examScheduledDate)->format('M d, Y - h:i A') : 'Not Scheduled' }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-12 text-muted"><i class="feather-layers" style="font-size:13px"></i>
                                    Subject</span>
                                <span class="badge bg-soft-primary text-primary">{{ $examSubject ?? 'General' }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-12 text-muted"><i class="feather-help-circle" style="font-size:13px"></i>
                                    Questions</span>
                                <span class="fs-12 fw-semibold text-dark">{{ $questionCount ?? 0 }} MCQs</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fs-12 text-muted"><i class="feather-clock" style="font-size:13px"></i>
                                    Duration</span>
                                <span class="fs-12 fw-semibold text-dark">{{ $examDuration ?? 60 }} Minutes</span>
                            </div>
                        </div>

                        {{-- Starts In countdown --}}
                        <div class="text-center mb-3">
                            <div class="fs-12 text-muted fw-medium mb-1">Starts In</div>
                            <div style="display:flex;justify-content:center;gap:.5rem">
                                @foreach([['hrs', 'Hrs'], ['min', 'Min'], ['sec', 'Sec']] as [$key, $lbl])
                                    <div
                                        style="background:#1e1b4b;border-radius:10px;padding:.5rem .85rem;min-width:52px;text-align:center">
                                        <div id="countdown-{{ $key }}"
                                            style="font-size:1.25rem;font-weight:800;color:#fff;line-height:1;font-family:monospace">
                                            --</div>
                                        <div
                                            style="font-size:9px;color:#818cf8;font-weight:600;text-transform:uppercase;letter-spacing:.5px">
                                            {{ $lbl }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <a href="{{ url('exampage') }}" class="btn btn-primary w-100 fw-semibold" style="border-radius:10px;font-size:13px">
                            <i class="feather-play-circle me-1"></i> Enter Exam Room
                        </a>
                    </div>
                </div>
            </div>
            {{-- /NEXT EXAM --}}

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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const targetDateStr = "{{ $examScheduledDate }}";
                const hrsEl = document.getElementById('countdown-hrs');
                const minEl = document.getElementById('countdown-min');
                const secEl = document.getElementById('countdown-sec');

                if (!targetDateStr) {
                    if (hrsEl) hrsEl.textContent = '00';
                    if (minEl) minEl.textContent = '00';
                    if (secEl) secEl.textContent = '00';
                    return;
                }

                const targetDate = new Date(targetDateStr).getTime();

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    if (distance < 0) {
                        hrsEl.textContent = '00';
                        minEl.textContent = '00';
                        secEl.textContent = '00';
                        return;
                    }

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    if (hrsEl) hrsEl.textContent = hours.toString().padStart(2, '0');
                    if (minEl) minEl.textContent = minutes.toString().padStart(2, '0');
                    if (secEl) secEl.textContent = seconds.toString().padStart(2, '0');
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            });
        </script>
    @endpush
    <!-- [ Main Content ] end -->
@endsection