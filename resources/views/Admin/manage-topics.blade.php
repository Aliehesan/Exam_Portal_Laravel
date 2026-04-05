@extends('layout')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Manage Topics</h5>
            </div>
            <!-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather-home"></i></a></li>
                    <li class="breadcrumb-item">Manage Topics</li>
                </ul> -->
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
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Topic Name <span class="text-danger">*</span></label>
                                <input type="text" name="topic_name" class="form-control" placeholder="Enter topic name"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4"
                                    placeholder="Enter topic description"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="mt-5">
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
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-soft-primary text-primary">Total: 5</span>
                        </div>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th scope="row">#</th>
                                        <th>Topic Name</th>
                                        <th>Description</th>
                                        <th>Questions</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-sm bg-soft-primary text-primary rounded">
                                                    <i class="feather-book-open"></i>
                                                </div>
                                                <span class="fw-semibold">Islamic History</span>
                                            </div>
                                        </td>
                                        <td><span class="text-muted fs-12">History of Islam and its events</span></td>
                                        <td><span class="badge bg-soft-primary text-primary">25</span></td>
                                        <td><span class="badge bg-soft-success text-success">Active</span></td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light-brand" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-light-brand text-danger"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="feather-trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-sm bg-soft-success text-success rounded">
                                                    <i class="feather-book-open"></i>
                                                </div>
                                                <span class="fw-semibold">Fiqh</span>
                                            </div>
                                        </td>
                                        <td><span class="text-muted fs-12">Islamic jurisprudence and rulings</span></td>
                                        <td><span class="badge bg-soft-primary text-primary">18</span></td>
                                        <td><span class="badge bg-soft-success text-success">Active</span></td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light-brand" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-light-brand text-danger"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="feather-trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-sm bg-soft-warning text-warning rounded">
                                                    <i class="feather-book-open"></i>
                                                </div>
                                                <span class="fw-semibold">Aqeedah</span>
                                            </div>
                                        </td>
                                        <td><span class="text-muted fs-12">Islamic beliefs and theology</span></td>
                                        <td><span class="badge bg-soft-primary text-primary">12</span></td>
                                        <td><span class="badge bg-soft-success text-success">Active</span></td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light-brand" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-light-brand text-danger"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="feather-trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-sm bg-soft-danger text-danger rounded">
                                                    <i class="feather-book-open"></i>
                                                </div>
                                                <span class="fw-semibold">Arabic Grammar</span>
                                            </div>
                                        </td>
                                        <td><span class="text-muted fs-12">Nahw and Sarf fundamentals</span></td>
                                        <td><span class="badge bg-soft-primary text-primary">30</span></td>
                                        <td><span class="badge bg-soft-warning text-warning">Inactive</span></td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light-brand" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-light-brand text-danger"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="feather-trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-sm bg-soft-info text-info rounded">
                                                    <i class="feather-book-open"></i>
                                                </div>
                                                <span class="fw-semibold">Quran Studies</span>
                                            </div>
                                        </td>
                                        <td><span class="text-muted fs-12">Tafseer and Quran sciences</span></td>
                                        <td><span class="badge bg-soft-primary text-primary">22</span></td>
                                        <td><span class="badge bg-soft-success text-success">Active</span></td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light-brand" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-light-brand text-danger"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="feather-trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
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
@endsection