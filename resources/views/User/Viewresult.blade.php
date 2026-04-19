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
                        <a href="{{ url('/export-results') }}" style="
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
            @php
                $totalAttempted = $results->count();
                $passedCount = $results->where('passed', true)->count();
                $failedCount = $results->where('passed', false)->count();
                $avgScore = $totalAttempted > 0 ? round($results->avg('score')) : 0;
                $passRate = $totalAttempted > 0 ? round(($passedCount / $totalAttempted) * 100) : 0;
            @endphp
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                    <i class="feather-file-text" style="font-size:20px"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalAttempted }}</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Attempted</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Completed Exams</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">{{ $totalAttempted }} Records</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width:100%"></div>
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
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $passedCount }}</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Exams Passed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Pass Rate</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">{{ $passRate }}% Pass</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width:{{ $passRate }}%"></div>
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
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $avgScore }}</span><span
                                            style="font-size:1rem">/100</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Average Score</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Overall Accuracy</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">{{ $avgScore }}% Avg</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{ $avgScore }}%"></div>
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
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $failedCount }}</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Exams Failed</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="fs-12 fw-medium text-muted">Needs Improvement</a>
                                <div class="w-100 text-end">
                                    <span class="fs-12 text-dark">{{ $failedCount }} Failures</span>
                                </div>
                            </div>
                            <div class="progress mt-2 ht-3">
                                @php $failPct = $totalAttempted > 0 ? ($failedCount / $totalAttempted) * 100 : 0; @endphp
                                <div class="progress-bar bg-danger" role="progressbar" style="width:{{ $failPct }}%"></div>
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
                                        <th>Result</th>
                                        <th>Attempted On</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($results as $i => $r)
                                        <tr class="result-row" data-status="{{ $r->passed ? 'passed' : 'failed' }}">
                                            <td>
                                                <span class="fw-semibold text-muted fs-12">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                            </td>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px">
                                                    <div class="avatar-text avatar-sm bg-soft-primary text-primary"
                                                        style="border-radius:10px;width:34px;height:34px;flex-shrink:0">
                                                        <i class="feather-file-text" style="font-size:13px"></i>
                                                    </div>
                                                    <div style="min-width:0">
                                                        <span class="d-block fw-semibold text-dark text-truncate-1-line"
                                                            style="font-size:13px;max-width:250px">
                                                            {{ $r->exam->title }}
                                                        </span>
                                                        <span class="fs-11 text-muted">Total: {{ $r->total_questions }} Qs</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-soft-primary text-primary">
                                                    {{ $r->exam->topic ? $r->exam->topic->name : 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px;min-width:120px">
                                                    <span class="fw-bold text-dark" style="font-size:15px;font-family:monospace;flex-shrink:0">
                                                        {{ $r->score }}<span class="fs-11 text-muted fw-normal">/100</span>
                                                    </span>
                                                    <div style="flex:1">
                                                        <div class="progress ht-3">
                                                            <div class="progress-bar bg-{{ $r->passed ? 'success' : 'danger' }}" style="width:{{ $r->score }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($r->passed)
                                                    <span class="badge bg-soft-success text-success">
                                                        <i class="feather-check" style="font-size:11px"></i> Passed
                                                    </span>
                                                @else
                                                    <span class="badge bg-soft-danger text-danger">
                                                        <i class="feather-x" style="font-size:11px"></i> Failed
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fs-12 text-muted">{{ $r->created_at->format('d M Y, h:i A') }}</span>
                                            </td>
                                            <td class="text-end">
                                                <div style="display:flex;align-items:center;justify-content:flex-end;gap:.4rem">
                                                    <a href="{{ url('/review/' . $r->id) }}" class="fs-12 fw-semibold text-primary" style="white-space:nowrap">
                                                        <i class="feather-eye" style="font-size:12px"></i> Review
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <div class="text-muted">No exam results found. Start by attempting an exam!</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── SUBJECT BREAKDOWN ── --}}
            @php
                $subjectStats = $results->groupBy('exam.topic.name')->map(function($group) {
                    return [
                        'avg' => round($group->avg('score')),
                        'count' => $group->count()
                    ];
                });
            @endphp
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Performance by Subject</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($subjectStats as $name => $stat)
                                <div class="col-xxl-4 col-md-6">
                                    <div style="background:#f9fafb;border-radius:12px;padding:1rem 1.25rem;border-left:3px solid #4f46e5">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <div class="fw-semibold text-dark" style="font-size:13.5px">{{ $name ?: 'General' }}</div>
                                                <div class="fs-12 text-muted">{{ $stat['count'] }} attempted</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="fw-bold text-dark" style="font-size:1.3rem;font-family:monospace;line-height:1">
                                                    {{ $stat['avg'] }}
                                                </div>
                                                <div class="fs-11 text-muted">avg</div>
                                            </div>
                                        </div>
                                        <div class="progress ht-3">
                                            <div class="progress-bar bg-primary" style="width:{{ $stat['avg'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
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

        document.getElementById('result-search')?.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.result-row').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    </script>
@endsection
