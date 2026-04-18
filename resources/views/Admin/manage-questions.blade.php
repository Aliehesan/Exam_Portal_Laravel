@extends('layout')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">
                    @if(isset($exam_id) && $exam_id)
                        Assign Questions to <span class="text-primary">{{ collect($exams)->where('id', $exam_id)->first()->title ?? 'Exam' }}</span>
                    @else
                        Manage Question Bank
                    @endif
                </h5>
            </div>
            @if(isset($exam_id) && $exam_id)
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('manage-exams') }}">Manage Exams</a></li>
                    <li class="breadcrumb-item">Assign Questions</li>
                </ul>
            @endif
        </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
        <!-- Filter Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <form method="GET" action="{{ route('questions.index') }}" class="card-body py-3">
                        @if(isset($exam_id) && $exam_id)
                            <input type="hidden" name="exam_id" value="{{ $exam_id }}">
                        @endif
                        <div class="row align-items-center g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold mb-1">Filter by Topic</label>
                                <select name="topic" id="filterTopic" class="form-control" onchange="this.form.submit()">
                                    <option value="all">All Topics</option>
                                    @foreach($topics as $t)
                                        <option value="{{ $t->id }}" {{ request('topic') == $t->id ? 'selected' : '' }}>
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold mb-1">Filter by Difficulty</label>
                                <select name="difficulty" id="filterDifficulty" class="form-control"
                                    onchange="this.form.submit()">
                                    <option value="all">All Levels</option>
                                    <option value="Easy" {{ request('difficulty') === 'Easy' ? 'selected' : '' }}>Easy
                                    </option>
                                    <option value="Medium" {{ request('difficulty') === 'Medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="Hard" {{ request('difficulty') === 'Hard' ? 'selected' : '' }}>Hard
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold mb-1">Filter by Status</label>
                                <select name="status" id="filterStatus" class="form-control" onchange="this.form.submit()">
                                    <option value="all">All</option>
                                    <option value="selected" {{ request('status') === 'selected' ? 'selected' : '' }}>Selected
                                        for Exam</option>
                                    <option value="unselected" {{ request('status') === 'unselected' ? 'selected' : '' }}>Not
                                        Selected</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label d-block mb-1">&nbsp;</label>
                                <a href="{{ route('questions.index') }}{{ isset($exam_id) && $exam_id ? '?exam_id='.$exam_id : '' }}" class="btn btn-light-brand w-50">
                                    <i class="feather-refresh-cw me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                            <i class="feather-help-circle"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statTotal">{{ $questions->count() }}</div>
                            <span class="fs-12 text-muted">Questions Shown</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-success text-success">
                            <i class="feather-check-circle"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statSelected">
                                {{ $questions->where('is_selected', true)->count() }}
                            </div>
                            <span class="fs-12 text-muted">Selected for Exam</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-warning text-warning">
                            <i class="feather-layers"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statTopics">
                                {{ $questions->unique('topic_id')->count() }}
                            </div>
                            <span class="fs-12 text-muted">Topics Covered</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-danger text-danger">
                            <i class="feather-x-circle"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statUnselected">
                                {{ $questions->where('is_selected', false)->count() }}
                            </div>
                            <span class="fs-12 text-muted">Not Selected</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Table -->
        <div class="row">
            <div class="col-12">
                <div class="card stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Questions List</h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-success" onclick="selectAllVisible()">
                                <i class="feather-check-square me-1"></i>Select All
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="deselectAllVisible()">
                                <i class="feather-square me-1"></i>Deselect All
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteAllVisible()">
                                <i class="feather-trash-2 me-1"></i>Delete Filtered
                            </button>
                        </div>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th style="width:40px">
                                            <input type="checkbox" class="form-check-input" id="checkAll"
                                                onchange="toggleAllCheckboxes(this)">
                                        </th>
                                        <th style="width:40px">#</th>
                                        <th>Question</th>
                                        <th>Topic</th>
                                        <th>Difficulty</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="questionsTableBody">
                                    @forelse($questions as $index => $q)
                                        @php
                                            $diffColor = $q->difficulty === 'Easy' ? 'bg-soft-success text-success' : ($q->difficulty === 'Hard' ? 'bg-soft-danger text-danger' : 'bg-soft-warning text-warning');
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input q-check" data-id="{{ $q->id }}"
                                                    {{ $q->is_selected ? 'checked' : '' }}
                                                    onchange="toggleSelect('{{ $q->id }}', this.checked)">
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <span class="fw-medium text-truncate-1-line"
                                                    style="max-width: 350px; display: inline-block;">
                                                    {{ $q->question }}
                                                </span>
                                            </td>
                                            <td><span class="badge bg-soft-primary text-primary">{{ $q->topic->name }}</span>
                                            </td>
                                            <td><span class="badge {{ $diffColor }}">{{ $q->difficulty }}</span></td>
                                            <td id="status-badge-{{ $q->id }}">
                                                @if($q->is_selected)
                                                    <span class="badge bg-soft-success text-success"><i
                                                            class="feather-check me-1"></i>Selected</span>
                                                @else
                                                    <span class="badge bg-soft-danger text-danger"><i class="feather-x me-1"></i>Not
                                                        Selected</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-light-brand me-1" type="button"
                                                    onclick="viewQuestion('{{ $q->id }}')" data-bs-toggle="tooltip"
                                                    title="View Details">
                                                    <i class="feather-eye"></i>
                                                </button>
                                                <form action="{{ route('questions.destroy', $q->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Delete this question?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light-brand text-danger"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <i class="feather-trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="feather-inbox fs-1 d-block mb-3"></i>
                                                <p class="mb-1">No questions found.</p>
                                                <small>Go to <a href="{{ url('manage-topics') }}">Manage Topics</a> and click
                                                    "Generate Questions" on a topic.</small>
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
    <!-- [ Main Content ] end -->

    <!-- View Question Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="feather-eye me-2"></i>Question Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const CSRF_TOKEN = '{{ csrf_token() }}';
        const EXAM_ID = '{{ $exam_id ?? '' }}';
        
        let allQuestions = @json($questions->map(function ($q) {
            $q->topicName = $q->topic->name;
            return $q;
        }));
        let filteredIds = allQuestions.map(q => q.id);

        // ─── Toggle Single Question Selection ───
        async function toggleSelect(id, checked) {
            // Optimistic UI update
            const idx = allQuestions.findIndex(q => q.id == id);
            if (idx !== -1) allQuestions[idx].is_selected = checked;

            // DOM UI update for badge
            const badgeTd = document.getElementById(`status-badge-${id}`);
            if (badgeTd) {
                badgeTd.innerHTML = checked
                    ? '<span class="badge bg-soft-success text-success"><i class="feather-check me-1"></i>Selected</span>'
                    : '<span class="badge bg-soft-danger text-danger"><i class="feather-x me-1"></i>Not Selected</span>';
            }

            await fetch(`/manage-questions/${id}/toggle`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify({ is_selected: checked, exam_id: EXAM_ID })
            });
        }

        // ─── Select / Deselect All Visible ───
        async function bulkUpdateSelection(status) {
            if (filteredIds.length === 0) return;

            // Optimistic UI update
            allQuestions.forEach(q => { if (filteredIds.includes(q.id)) q.is_selected = status; });
            // Only update DOM checkboxes and badges instead of re-rendering entire table
            document.querySelectorAll('.q-check').forEach(chk => {
                chk.checked = status;
                const id = chk.dataset.id;
                const badgeTd = document.getElementById(`status-badge-${id}`);
                if (badgeTd) {
                    badgeTd.innerHTML = status
                        ? '<span class="badge bg-soft-success text-success"><i class="feather-check me-1"></i>Selected</span>'
                        : '<span class="badge bg-soft-danger text-danger"><i class="feather-x me-1"></i>Not Selected</span>';
                }
            });

            await fetch(`/manage-questions/bulk-update`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify({ ids: filteredIds, status: status, exam_id: EXAM_ID })
            });
        }

        function selectAllVisible() { bulkUpdateSelection(true); }
        function deselectAllVisible() { bulkUpdateSelection(false); }
        function toggleAllCheckboxes(master) {
            if (master.checked) selectAllVisible(); else deselectAllVisible();
        }

        async function deleteAllVisible() {
            if (!confirm(`Delete ${filteredIds.length} filtered questions?`)) return;
            await fetch(`/manage-questions/bulk-delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify({ ids: filteredIds })
            });
            window.location.reload();
            document.getElementById('selectAllMaster').checked = false;
        }

        // ─── View Question Details ───
        function viewQuestion(id) {
            const q = allQuestions.find(q => q.id == id);
            if (!q) return;
            const correctLabel = { A: q.option_a, B: q.option_b, C: q.option_c, D: q.option_d };
            const diffColor = q.difficulty === 'Easy' ? 'bg-soft-success text-success' :
                q.difficulty === 'Hard' ? 'bg-soft-danger text-danger' :
                    'bg-soft-warning text-warning';

            document.getElementById('viewModalBody').innerHTML = `
                                                    <div class="mb-4">
                                                        <span class="badge bg-soft-primary text-primary me-2">${q.topicName}</span>
                                                        <span class="badge ${diffColor}">${q.difficulty}</span>
                                                    </div>
                                                    <h6 class="fw-bold mb-4">${q.question}</h6>
                                                    <div class="row g-3 mb-4">
                                                        <div class="col-md-6">
                                                            <div class="p-3 border rounded ${q.correct_answer === 'A' ? 'border-success bg-soft-success' : ''}">
                                                                <strong>A.</strong> ${q.option_a}
                                                                ${q.correct_answer === 'A' ? '<i class="feather-check text-success float-end"></i>' : ''}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-3 border rounded ${q.correct_answer === 'B' ? 'border-success bg-soft-success' : ''}">
                                                                <strong>B.</strong> ${q.option_b}
                                                                ${q.correct_answer === 'B' ? '<i class="feather-check text-success float-end"></i>' : ''}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-3 border rounded ${q.correct_answer === 'C' ? 'border-success bg-soft-success' : ''}">
                                                                <strong>C.</strong> ${q.option_c}
                                                                ${q.correct_answer === 'C' ? '<i class="feather-check text-success float-end"></i>' : ''}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="p-3 border rounded ${q.correct_answer === 'D' ? 'border-success bg-soft-success' : ''}">
                                                                <strong>D.</strong> ${q.option_d}
                                                                ${q.correct_answer === 'D' ? '<i class="feather-check text-success float-end"></i>' : ''}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <strong>Correct Answer:</strong>
                                                        <span class="badge bg-success">${q.correct_answer} — ${correctLabel[q.correct_answer]}</span>
                                                    </div>
                                                `;
            new bootstrap.Modal(document.getElementById('viewModal')).show();
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Fix: move modals to body so they aren't clipped by .nxl-content
            document.querySelectorAll('.modal').forEach(function (modal) {
                document.body.appendChild(modal);
            });
        });
    </script>
@endsection