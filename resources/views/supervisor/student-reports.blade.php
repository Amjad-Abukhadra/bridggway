@extends('layouts.app')

@section('body')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="text-white mb-0">
                <i class="fas fa-clipboard-list mr-2"></i>
                Reports for {{ $student->full_name }}
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
                <span class="badge badge-white px-3">{{ $student->st_department }}</span>
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
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Reports Submitted</small>
                            <span class="font-weight-bold">{{ $reports->count() }} Reports</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @forelse ($reports->groupBy('week_number') as $week => $weekReports)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Week {{ $week }}</h6>
                    <span class="badge badge-light text-primary px-3">{{ $weekReports->count() }} Reports</span>
                </div>
            </div>
            <div class="card-body p-0">
                @foreach ($weekReports as $report)
                    <div class="report-item p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="font-weight-bold text-primary mb-3">
                                        <i class="fas fa-tasks mr-2"></i>
                                        Tasks Completed
                                    </h6>
                                    <p class="text-muted mb-0">{{ $report->task }}</p>
                                </div>
                                
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-3">
                                        <i class="fas fa-tools mr-2"></i>
                                        Tools Used
                                    </h6>
                                    <p class="text-muted mb-0">{{ $report->tools }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="bg-light rounded p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold text-primary mb-1">Hours Worked</h6>
                                            <p class="text-muted small mb-0">This week's contribution</p>
                                        </div>
                                        <span class="badge badge-primary px-3">{{ $report->number_of_hours }} hrs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <div class="rounded-circle bg-light mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="fas fa-clipboard fa-2x text-primary"></i>
                </div>
                <h5 class="font-weight-bold text-primary">No Reports Available</h5>
                <p class="text-muted mb-0">This student hasn't submitted any reports yet.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection 