@extends('layout')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Manage Exams</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Exams</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createExamModal">
                <i class="feather-plus me-2"></i> Create New Exam
            </button>
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Stats Summary --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                            <i class="feather-file-text"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark">{{ $totalExams }}</div>
                            <span class="fs-12 text-muted">Total Exams</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-success text-success">
                            <i class="feather-zap"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark">{{ $activeExams }}</div>
                            <span class="fs-12 text-muted">Ongoing</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-info text-info">
                            <i class="feather-clock"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark">{{ $scheduledExams }}</div>
                            <span class="fs-12 text-muted">Scheduled</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-secondary text-secondary">
                            <i class="feather-check-circle"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark">{{ $completedExams }}</div>
                            <span class="fs-12 text-muted">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Exams Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">All Exams Directory</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Title</th>
                                        <th>Subject / Topic</th>
                                        <th>Date Scheduled</th>
                                        <th>Duration</th>
                                        <th>Questions</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($exams as $index => $exam)
                                        <tr>
                                            <td class="text-muted">{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $exam->title }}</td>
                                            <td>
                                                @if($exam->topic)
                                                    <span class="badge bg-soft-primary text-primary">{{ $exam->topic->name }}</span>
                                                @else
                                                    <span class="text-muted fs-12">All Subjects</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($exam->scheduled_date)->format('M d, Y h:i A') }}</td>
                                            <td>{{ $exam->duration_minutes }} Min</td>
                                            <td>
                                                @if($exam->selected_count > 0)
                                                    <span class="badge bg-soft-success text-success">{{ $exam->selected_count }} MCQs</span>
                                                @else
                                                    <span class="badge bg-soft-danger text-danger">0 MCQs</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($exam->status === 'active')
                                                    <span class="badge bg-success pulse-danger"><i class="feather-activity me-1"></i>Ongoing</span>
                                                @elseif($exam->status === 'completed')
                                                    <span class="badge bg-secondary"><i class="feather-check me-1"></i>Completed</span>
                                                @elseif($exam->status === 'scheduled')
                                                    <span class="badge bg-primary"><i class="feather-calendar me-1"></i>Scheduled</span>
                                                @else
                                                    <span class="badge bg-warning text-dark"><i class="feather-clock me-1"></i>Pending</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex align-items-center justify-content-end gap-1">
                                                    {{-- START / STOP EXAM BUTTONS --}}
                                                    @if($exam->status !== 'active' && $exam->status !== 'completed')
                                                        <button class="btn btn-sm btn-success" onclick="setStatus({{ $exam->id }}, 'active')" title="Start Exam" style="white-space:nowrap;">
                                                            <i class="feather-play"></i> Start
                                                        </button>
                                                    @endif
                                                    @if($exam->status === 'active')
                                                        <button class="btn btn-sm btn-danger" onclick="setStatus({{ $exam->id }}, 'completed')" title="End Exam" style="white-space:nowrap;">
                                                            <i class="feather-square"></i> Stop
                                                        </button>
                                                    @endif
                                                    @if($exam->status === 'completed')
                                                        <button class="btn btn-sm btn-warning" onclick="if(confirm('Reset this exam to Pending?')) setStatus({{ $exam->id }}, 'pending')" title="Reset" style="white-space:nowrap;">
                                                            <i class="feather-rotate-ccw"></i> Retry
                                                        </button>
                                                    @endif

                                                    {{-- Delete --}}
                                                    <form action="{{ route('exam.destroy', $exam->id) }}" method="POST" class="d-inline-block m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this exam permanently?')" title="Delete">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5 text-muted">
                                                <i class="feather-inbox fs-1 d-block mb-3"></i>
                                                No exams created yet. Click <strong>"Create New Exam"</strong> to get started!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Exam Modal -->
    <div class="modal fade" id="createExamModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('exam.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="feather-plus-circle me-2"></i>Create New Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Exam Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Midterm Exam - Semester 2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subject / Topic</label>
                        <select name="topic_id" class="form-control">
                            <option value="">— All Subjects (General) —</option>
                            @foreach($topics as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Select the subject this exam covers, or leave blank for a mixed exam.</small>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold">Scheduled Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="scheduled_date" class="form-control" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold">Duration (Minutes) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_minutes" class="form-control" value="60" min="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="feather-save me-1"></i> Create Exam</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .pulse-danger {
            animation: pulse-animation 2s infinite;
        }
        @keyframes pulse-animation {
            0% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(76, 175, 80, 0); }
            100% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0); }
        }
    </style>

    <script>
        function setStatus(examId, status) {
            fetch(`/manage-exams/${examId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(data => { throw data; });
                }
                return res.json();
            })
            .then(data => {
                if(data.success) {
                    window.location.reload();
                }
            })
            .catch(err => {
                alert(err.message || 'Error toggling exam status');
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.modal').forEach(function (modal) {
                document.body.appendChild(modal);
            });
        });
    </script>
@endsection
