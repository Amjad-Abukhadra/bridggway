@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2>
                    <i class="fas fa-user-tie mr-2"></i>
                    Supervisor Profile
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
                <form action="{{ route('supervisor.profile.update') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Email Address</label>
                            <input type="email" 
                                   class="form-control" 
                                   value="{{ $supervisor->email }}" 
                                   readonly>
                            <small class="text-muted">Email cannot be changed</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Full Name</label>
                            <input type="text" 
                                   name="full_name" 
                                   class="form-control @error('full_name') is-invalid @enderror" 
                                   value="{{ old('full_name', $supervisor->full_name) }}"
                                   placeholder="Enter your full name"
                                   required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Department</label>
                            <input type="text" 
                                   name="department" 
                                   class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department', $supervisor->super_department) }}"
                                   placeholder="Enter your department"
                                   required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">College</label>
                            <input type="text" 
                                   class="form-control"
                                   value="{{ $supervisor->college->college_name ?? 'Not Assigned' }}"
                                   readonly>
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
@endsection 