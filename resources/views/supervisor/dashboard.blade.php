@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-white">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                    Supervisor Dashboard
                </h2>
            </div>
        </div>

        <div class="row">
            <!-- Students Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow h-100 py-2 border-left border-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-primary text-uppercase mb-1">
                                    Assigned Students</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $studentsCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Submitted Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow h-100 py-2 border-left border-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-success text-uppercase mb-1">
                                    Reports Submitted (This Week)</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $reportsSubmitted }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Missing Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow h-100 py-2 border-left border-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-warning text-uppercase mb-1">
                                    Reports Missing</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $reportsMissing }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Evaluations Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow h-100 py-2 border-left border-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-info text-uppercase mb-1">
                                    Total Evaluations</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $evaluationsCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('supervisor.students') }}" class="btn btn-block btn-outline-primary">
                                    <i class="fas fa-users mr-2"></i>View Students
                                </a>
                            </div>

                            <div class="col-md-3 mb-3">
                                <a href="{{ route('supervisor.applications') }}" class="btn btn-block btn-outline-warning">
                                    <i class="fas fa-file-alt mr-2"></i>Review Applications
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
