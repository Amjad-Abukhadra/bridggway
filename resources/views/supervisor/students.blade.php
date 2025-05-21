@extends('layouts.app')

@section('body')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-white">
                <i class="fas fa-users mr-2"></i>
                Assigned Students
            </h2>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">Student List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-white bg-primary font-weight-bold">Name</th>
                            <th class="text-white bg-primary font-weight-bold">Department</th>
                            <th class="text-white bg-primary font-weight-bold">GPA</th>
                            <th class="text-white bg-primary font-weight-bold">Reports</th>
                            <th class="text-white bg-primary font-weight-bold">Applications</th>
                            <th class="text-white bg-primary font-weight-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($student->full_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $student->full_name }}</div>
                                            <small class="text-muted">{{ $student->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $student->st_department }}</td>
                                <td>{{ number_format($student->gpa, 2) }}</td>
                                <td>
                                    <span class="badge badge-pill badge-info px-3">
                                        {{ $student->reports->where('week_number', '>', 0)->count() }} Reports
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-warning px-3">
                                        {{ $student->applicationCount }} Applications
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('supervisor.student.reports', $student) }}" 
                                           class="btn btn-sm btn-outline-primary py-1 px-3">
                                            <i class="fas fa-clipboard-list mr-1"></i>
                                            Reports
                                        </a>
                                        <a href="{{ route('supervisor.student.evaluation', $student) }}" 
                                           class="btn btn-sm btn-outline-info py-1 px-3">
                                            <i class="fas fa-star mr-1"></i>
                                            Evaluation
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-user-slash fa-2x mb-3"></i>
                                        <p>No students assigned yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection 