@extends('layouts.app')

@section('body')
<style>
.progress-circle {
    width: 120px;
    height: 120px;
    background: conic-gradient(
        #4e73df {{ $student->resume ?? 0 }}%,
        #eaecf4 {{ $student->resume ?? 0 }}%
    );
    border-radius: 50%;
    position: relative;
}

.progress-circle::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    background: #fff;
    border-radius: 50%;
}

.progress-circle .progress-value {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
    font-size: 24px;
    color: #4e73df;
    z-index: 1;
}
</style>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-primary">
                    <i class="fas fa-user-graduate mr-2"></i>
                    Student Profile
                </h2>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Profile Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column: Progress Circle -->
                    <div class="col-md-3 text-center mb-4">
                        <h6 class="font-weight-bold text-white mb-3">Internship Progress</h6>
                        <div class="d-flex justify-content-center">
                            <div class="progress-circle">
                                <div class="progress-value">
                                    {{ $student->resume ?? 0 }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Form -->
                    <div class="col-md-9">
                        <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Full Name</label>
                                    <input type="text" name="full_name" class="form-control"
                                        value="{{ old('full_name', $student->full_name ?? '') }}" 
                                        placeholder="Enter your full name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Department</label>
                                    <input type="text" name="st_department" class="form-control"
                                        value="{{ old('st_department', $student->st_department ?? '') }}" 
                                        placeholder="Enter your department" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">GPA</label>
                                    <input type="number" name="gpa" step="0.01" class="form-control"
                                        value="{{ old('gpa', $student->gpa ?? '') }}" 
                                        placeholder="Enter your GPA" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Supervisor</label>
                                    <div class="form-control bg-light">
                                        @if(optional($student->supervisor)->full_name)
                                            <i class="fas fa-user-tie text-primary mr-2"></i>
                                            {{ $student->supervisor->full_name }}
                                        @else
                                            <i class="fas fa-user-slash text-muted mr-2"></i>
                                            Not assigned yet
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save mr-1"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
