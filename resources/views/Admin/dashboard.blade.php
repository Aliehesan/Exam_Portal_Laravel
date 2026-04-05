@extends('layout')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Admin Dashboard</h5>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <!-- [Total Topics] start -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card stretch stretch-full h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                                    <i class="feather-layers"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark">{{ $totalTopics }}</div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line text-muted">Total Topics</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <a href="{{ url('manage-topics') }}" class="btn btn-sm btn-light-brand w-100">Manage Topics</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Topics] end -->

            <!-- [Total Questions] start -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card stretch stretch-full h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-info text-info">
                                    <i class="feather-help-circle"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark">{{ $totalQuestions }}</div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line text-muted">Total AI Questions</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <a href="{{ url('manage-questions') }}" class="btn btn-sm btn-light-brand w-100">Manage Questions</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Questions] end -->

            <!-- [Questions Selected] start -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card stretch stretch-full h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-success text-success">
                                    <i class="feather-check-square"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark">{{ $selectedQuestions }}</div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line text-muted">Ready for Exam</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 d-flex align-items-center justify-content-between">
                            <span class="fs-12 text-muted">Selected Questions</span>
                            <div class="progress w-50 ht-3">
                                @php
                                    $progress = $totalQuestions > 0 ? ($selectedQuestions / $totalQuestions) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Questions Selected] end -->

            <!-- [Total Students] start -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card stretch stretch-full h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-warning text-warning">
                                    <i class="feather-users"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark" id="dashTotalStudents">0</div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line text-muted">Total Students</h3>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <a href="{{ url('manage-students') }}" class="btn btn-sm btn-light-brand w-100">Manage Students</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Students] end -->
        </div>

        <div class="row">
            <!-- [Recently Added Students] start -->
            <div class="col-lg-8">
                <div class="card stretch stretch-full">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Recently Added Students</h5>
                        <a href="{{ url('manage-students') }}" class="text-primary fs-12 fw-medium">View All</a>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody id="recentStudentsTable">
                                    <!-- Populated via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Recently Added Students] end -->

            <!-- [Quick Links] start -->
            <div class="col-lg-4">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ url('manage-topics') }}" class="d-flex align-items-center p-3 rounded border border-dashed border-gray-300 hover-bg-gray-100 transition-all">
                                <div class="avatar-text bg-soft-primary text-primary me-3">
                                    <i class="feather-plus"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold text-dark">Add New Topic</h6>
                                    <span class="fs-12 text-muted">Create a new exam subject</span>
                                </div>
                            </a>
                            <a href="{{ url('manage-topics') }}" class="d-flex align-items-center p-3 rounded border border-dashed border-gray-300 hover-bg-gray-100 transition-all">
                                <div class="avatar-text bg-soft-info text-info me-3">
                                    <i class="feather-cpu"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold text-dark">Generate Questions</h6>
                                    <span class="fs-12 text-muted">Use AI to build question banks</span>
                                </div>
                            </a>
                            <a href="{{ url('manage-students') }}" class="d-flex align-items-center p-3 rounded border border-dashed border-gray-300 hover-bg-gray-100 transition-all">
                                <div class="avatar-text bg-soft-warning text-warning me-3">
                                    <i class="feather-user-plus"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold text-dark">Register Student</h6>
                                    <span class="fs-12 text-muted">Enroll a new student to the portal</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Quick Links] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                // We're leaving students on LocalStorage as requested 
                const students = JSON.parse(localStorage.getItem('exam_students') || '[]');
                document.getElementById('dashTotalStudents').textContent = students.length;

                // Populate Recent Students Table
                const recentStudents = [...students].sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt)).slice(0, 5);
                const tbody = document.getElementById('recentStudentsTable');

                if (recentStudents.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">No students registered yet.</td></tr>';
                } else {
                    tbody.innerHTML = recentStudents.map(s => {
                        const statusClass = s.status === 'active' ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                        const initials = s.name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase();
                        const dateObj = new Date(s.createdAt);
                        const dateStr = dateObj.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                        
                        return `<tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-text avatar-sm bg-soft-primary text-primary rounded-circle fw-bold">
                                        ${initials}
                                    </div>
                                    <span class="fw-semibold">${s.name}</span>
                                </div>
                            </td>
                            <td><span class="text-muted">${s.email}</span></td>
                            <td><span class="badge ${statusClass}">${s.status === 'active' ? 'Active' : 'Inactive'}</span></td>
                            <td><span class="text-muted fs-12">${dateStr}</span></td>
                        </tr>`;
                    }).join('');
                }
            } catch (err) {
                console.error("Dashboard error:", err);
            }
        });
    </script>
@endsection