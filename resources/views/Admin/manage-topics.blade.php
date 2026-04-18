@extends('layout')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Manage Topics</h5>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <!-- [Add New Topic] start -->
            <div class="col-lg-4">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Add New Topic</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('topics.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Topic Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="e.g. Java, Python, Data Structures" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="e.g. Syllabus boundaries, Unit 1 to 2, specific scope" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="feather-plus me-2"></i>Add Topic
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [Add New Topic] end -->

            <!-- [Topics List] start -->
            <div class="col-lg-8">
                <div class="card stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">All Topics</h5>
                        <span class="badge bg-soft-primary text-primary">Total: {{ $topics->count() }}</span>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th>#</th>
                                        <th>Topic Name</th>
                                        <th>Description</th>
                                        <th>Questions</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $colors = [
                                            ['bg' => 'bg-soft-primary', 'text' => 'text-primary'],
                                            ['bg' => 'bg-soft-success', 'text' => 'text-success'],
                                            ['bg' => 'bg-soft-warning', 'text' => 'text-warning'],
                                            ['bg' => 'bg-soft-danger', 'text' => 'text-danger'],
                                            ['bg' => 'bg-soft-info', 'text' => 'text-info'],
                                        ];
                                    @endphp
                                    @forelse ($topics as $index => $topic)
                                        @php
                                            $color = $colors[$index % 5];
                                            $statusClass = $topic->status === 'active' ? 'bg-soft-success text-success' : 'bg-soft-warning text-warning';
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div
                                                        class="avatar-text avatar-sm {{ $color['bg'] }} {{ $color['text'] }} rounded">
                                                        <i class="feather-book-open"></i>
                                                    </div>
                                                    <span class="fw-semibold">{{ $topic->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted fs-12" style="white-space: pre-line; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden;">{{ $topic->description ?: '—' }}</div>
                                            </td>
                                            <td><span
                                                    class="badge bg-soft-primary text-primary">{{ $topic->questions_count }}</span>
                                            </td>
                                            <td><span class="badge {{ $statusClass }}">{{ ucfirst($topic->status) }}</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-primary me-1"
                                                    onclick="openGenerateModal('{{ $topic->id }}','{{ addslashes($topic->name) }}')"
                                                    data-bs-toggle="tooltip" title="Generate Questions">
                                                    <i class="feather-cpu"></i>
                                                </button>
                                                <button class="btn btn-sm btn-light-brand me-1"
                                                    data-topic="{{ json_encode($topic) }}"
                                                    onclick="openEditModal(this)"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="feather-edit"></i>
                                                </button>
                                                <form action="{{ route('topics.destroy', $topic->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Delete this topic and all its questions?');">
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
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="feather-inbox fs-3 d-block mb-2"></i>
                                                No topics added yet. Add your first topic!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Topics List] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Generate Questions Modal -->
    <div class="modal fade" id="generateModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="feather-cpu me-2"></i>Generate AI Questions
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Topic</label>
                        <input type="text" id="genTopicName" class="form-control" readonly>
                        <input type="hidden" id="genTopicId">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Number of Questions</label>
                        <select id="genCount" class="form-control">
                            <option value="5">5 Questions</option>
                            <option value="10" selected>10 Questions</option>
                            <option value="25">25 Questions</option>
                            <option value="50">50 Questions</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Difficulty Level</label>
                        <select id="genDifficulty" class="form-control">
                            <option value="Easy">Easy</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="Hard">Hard</option>
                            <option value="Mixed">Mixed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnGenerate">
                        <i class="feather-zap me-2"></i>Generate with AI
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Topic Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="feather-edit me-2"></i>Edit Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Topic Name</label>
                            <input type="text" name="name" id="editTopicName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description (Syllabus/Boundary) <span
                                    class="text-danger">*</span></label>
                            <textarea name="description" id="editTopicDesc" class="form-control" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" id="editTopicStatus" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const CSRF_TOKEN = '{{ csrf_token() }}';

        // ─── Edit Topic Modal ───
        function openEditModal(btn) {
            const topic = JSON.parse(btn.getAttribute('data-topic'));
            document.getElementById('editForm').action = `/manage-topics/${topic.id}`;
            document.getElementById('editTopicName').value = topic.name;
            document.getElementById('editTopicDesc').value = topic.description || '';
            document.getElementById('editTopicStatus').value = topic.status;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }

        // ─── Generate Questions Modal ───
        function openGenerateModal(id, name) {
            document.getElementById('genTopicId').value = id;
            document.getElementById('genTopicName').value = name;
            new bootstrap.Modal(document.getElementById('generateModal')).show();
        }

        document.getElementById('btnGenerate').addEventListener('click', async function () {
            const topicId = document.getElementById('genTopicId').value;
            const count = document.getElementById('genCount').value;
            const difficulty = document.getElementById('genDifficulty').value;

            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Generating...';

            try {
                const response = await fetch('/manage-questions/generate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        topic_id: topicId,
                        count: count,
                        difficulty: difficulty
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.error || 'Failed to generate questions');
                }

                bootstrap.Modal.getInstance(document.getElementById('generateModal')).hide();
                // Reload page to reflect new questions
                window.location.reload();
            } catch (err) {
                console.error('Generation error:', err);
                alert('❌ Error generating questions.\n\n' + err.message);
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="feather-zap me-2"></i>Generate with AI';
            }
        });

        // ─── Init ───
        document.addEventListener('DOMContentLoaded', function () {
            // Fix: move modals to body so they aren't clipped by .nxl-content
            document.querySelectorAll('.modal').forEach(function (modal) {
                document.body.appendChild(modal);
            });
        });
    </script>
@endsection