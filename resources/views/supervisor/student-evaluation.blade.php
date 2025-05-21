@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="text-white mb-0">
                    <i class="fas fa-star mr-2"></i>
                    Evaluation for {{ $student->full_name }}
                </h2>
                <a href="{{ route('supervisor.students') }}" class="btn btn-outline-light px-4">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Students
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white">Student Information</h6>
                    <span class="badge badge-primary px-3">{{ $student->st_department }}</span>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Email Address</small>
                                <span class="font-weight-bold">{{ $student->email }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Grade Point Average</small>
                                <span class="font-weight-bold">{{ number_format($student->gpa, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Total Reports</small>
                                <span class="font-weight-bold">{{ $student->reports->count() }} Reports</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Evaluation Status</small>
                                <span class="badge badge-{{ $evaluation ? 'success' : 'warning' }} px-3">
                                    {{ $evaluation ? 'Completed' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($evaluation)
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Performance Metrics
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Performance Level</h6>
                                            <small class="text-muted">Overall performance rating</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->performance_level) }}</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Responsibility</h6>
                                            <small class="text-muted">Task ownership and reliability</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->responsibility) }}</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Punctuality</h6>
                                            <small class="text-muted">Attendance and timeliness</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->punctuality) }}</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Accuracy in Work</h6>
                                            <small class="text-muted">Quality and precision</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->accuracy_in_work) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                Additional Metrics
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Teamwork</h6>
                                            <small class="text-muted">Collaboration and communication</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->teamwork) }}</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Adaptability</h6>
                                            <small class="text-muted">Flexibility and learning</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->adaptability) }}</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Skill Acquisition</h6>
                                            <small class="text-muted">Learning and growth rate</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->skill_acquisition_speed) }}</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Overall Completion</h6>
                                            <small class="text-muted">Task completion rate</small>
                                        </div>
                                        <span class="badge badge-success px-3">{{ ucfirst($evaluation->overall_completion) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="rounded-circle bg-light mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                    </div>
                    <h5 class="font-weight-bold text-primary">No Evaluation Available</h5>
                    <p class="text-muted mb-0">This student hasn't received an evaluation yet.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
