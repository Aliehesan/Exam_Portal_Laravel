@extends('layout')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Manage Students</h5>
            </div>
        </div>
        <div class="page-header-right ms-auto">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="feather-plus me-2"></i>Add New Student
                </button>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stretch stretch-full">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                            <i class="feather-users"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statTotalStudents">0</div>
                            <span class="fs-12 text-muted">Total Students</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stretch stretch-full">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-success text-success">
                            <i class="feather-user-check"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statActiveStudents">0</div>
                            <span class="fs-12 text-muted">Active Students</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stretch stretch-full">
                    <div class="card-body py-3 d-flex align-items-center gap-3">
                        <div class="avatar-text avatar-lg bg-soft-warning text-warning">
                            <i class="feather-user-minus"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark" id="statInactiveStudents">0</div>
                            <span class="fs-12 text-muted">Inactive Students</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <input type="text" id="searchStudent" class="form-control" placeholder="Search by Name or Email...">
                            </div>
                            <div class="col-md-3">
                                <select id="filterStatus" class="form-control">
                                    <option value="all">All Statuses</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="row">
            <div class="col-12">
                <div class="card stretch stretch-full">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Students List</h5>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Registration Date</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsTableBody">
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="feather-users fs-1 d-block mb-3"></i>
                                            <p class="mb-1">No students registered yet.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="feather-user-plus me-2"></i>Add New Student
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" id="addName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="addEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" id="addPhone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select id="addStatus" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addStudentForm" class="btn btn-primary">Save Student</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="feather-edit me-2"></i>Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm">
                        <input type="hidden" id="editStudentId">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" id="editPhone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select id="editStatus" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="editStudentForm" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ─── LocalStorage Helpers ───
        function getStudents() {
            return JSON.parse(localStorage.getItem('exam_students') || '[]');
        }
        function saveStudents(students) {
            localStorage.setItem('exam_students', JSON.stringify(students));
        }

        // ─── Generate Avatar Colors ───
        const avatarColors = ['bg-soft-primary text-primary', 'bg-soft-success text-success', 'bg-soft-warning text-warning', 'bg-soft-danger text-danger', 'bg-soft-info text-info'];

        // ─── Render Stats ───
        function updateStats(students) {
            document.getElementById('statTotalStudents').textContent = students.length;
            document.getElementById('statActiveStudents').textContent = students.filter(s => s.status === 'active').length;
            document.getElementById('statInactiveStudents').textContent = students.filter(s => s.status === 'inactive').length;
        }

        // ─── Render Table ───
        function renderStudents() {
            let students = getStudents();
            updateStats(students);

            const searchVal = document.getElementById('searchStudent').value.toLowerCase();
            const statusVal = document.getElementById('filterStatus').value;

            // Apply Filters
            if (searchVal) {
                students = students.filter(s => s.name.toLowerCase().includes(searchVal) || s.email.toLowerCase().includes(searchVal));
            }
            if (statusVal !== 'all') {
                students = students.filter(s => s.status === statusVal);
            }

            const tbody = document.getElementById('studentsTableBody');

            if (students.length === 0) {
                tbody.innerHTML = `<tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="feather-users fs-1 d-block mb-3"></i>
                        <p class="mb-1">No students found.</p>
                    </td>
                </tr>`;
                return;
            }

            tbody.innerHTML = students.map((s, i) => {
                const badgeClass = s.status === 'active' ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                const avatarColor = avatarColors[i % avatarColors.length];
                const initials = s.name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase();
                
                // Format relative date (simplistic implementation)
                const dateObj = new Date(s.createdAt);
                const dateStr = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

                return `<tr>
                    <td>${i + 1}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-text avatar-sm ${avatarColor} rounded-circle fw-bold">
                                ${initials}
                            </div>
                            <span class="fw-semibold">${s.name}</span>
                        </div>
                    </td>
                    <td><a href="mailto:${s.email}" class="text-body">${s.email}</a></td>
                    <td>${s.phone || '<span class="text-muted">—</span>'}</td>
                    <td><span class="badge ${badgeClass}">${s.status === 'active' ? 'Active' : 'Inactive'}</span></td>
                    <td>${dateStr}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-light-brand me-1" onclick="openEditStudent('${s.id}')" data-bs-toggle="tooltip" title="Edit">
                            <i class="feather-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-light-brand text-danger" onclick="deleteStudent('${s.id}')" data-bs-toggle="tooltip" title="Delete">
                            <i class="feather-trash-2"></i>
                        </button>
                    </td>
                </tr>`;
            }).join('');
        }

        // ─── Add Student ───
        document.getElementById('addStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const students = getStudents();
            
            // Check for duplicate email
            const email = document.getElementById('addEmail').value.trim();
            if (students.some(s => s.email === email)) {
                alert('A student with this email already exists!');
                return;
            }

            students.push({
                id: 'stu_' + Date.now(),
                name: document.getElementById('addName').value.trim(),
                email: email,
                phone: document.getElementById('addPhone').value.trim(),
                status: document.getElementById('addStatus').value,
                createdAt: new Date().toISOString()
            });

            saveStudents(students);
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('addStudentModal')).hide();
            renderStudents();
        });

        // ─── Edit Student ───
        function openEditStudent(id) {
            const student = getStudents().find(s => s.id === id);
            if (!student) return;
            
            document.getElementById('editStudentId').value = student.id;
            document.getElementById('editName').value = student.name;
            document.getElementById('editEmail').value = student.email;
            document.getElementById('editPhone').value = student.phone || '';
            document.getElementById('editStatus').value = student.status;
            
            new bootstrap.Modal(document.getElementById('editStudentModal')).show();
        }

        document.getElementById('editStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('editStudentId').value;
            const email = document.getElementById('editEmail').value.trim();
            let students = getStudents();
            const idx = students.findIndex(s => s.id === id);
            if (idx === -1) return;

            // Check duplicate email for OTHER students
            if (students.some(s => s.email === email && s.id !== id)) {
                alert('Another student with this email already exists!');
                return;
            }

            students[idx].name = document.getElementById('editName').value.trim();
            students[idx].email = email;
            students[idx].phone = document.getElementById('editPhone').value.trim();
            students[idx].status = document.getElementById('editStatus').value;
            
            saveStudents(students);
            bootstrap.Modal.getInstance(document.getElementById('editStudentModal')).hide();
            renderStudents();
        });

        // ─── Delete Student ───
        function deleteStudent(id) {
            if (!confirm('Are you sure you want to remove this student?')) return;
            let students = getStudents().filter(s => s.id !== id);
            saveStudents(students);
            renderStudents();
        }

        // ─── Filters & Init ───
        document.getElementById('searchStudent').addEventListener('input', renderStudents);
        document.getElementById('filterStatus').addEventListener('change', renderStudents);

        document.addEventListener('DOMContentLoaded', function() {
            renderStudents();

            // Fix modal positioning
            document.querySelectorAll('.modal').forEach(function(modal) {
                document.body.appendChild(modal);
            });
        });
    </script>
@endsection
