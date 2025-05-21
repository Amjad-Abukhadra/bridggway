@extends('layouts.app')

@section('body')
    <div class="container-fluid mt-4">
        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-white">College Dashboard</h1>
            <div>
                <button type="button" class="btn btn-primary d-flex align-items-center mr-2 float-right" data-toggle="modal" data-target="#createStudentModal">
                    <i class="fas fa-user-graduate mr-2"></i> Create Student
                </button>
                <button type="button" class="btn btn-info d-flex align-items-center float-right" data-toggle="modal" data-target="#createSupervisorModal">
                    <i class="fas fa-chalkboard-teacher mr-2"></i> Create Supervisor
                </button>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            {{-- Student Section --}}
            <div class="col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user-graduate mr-2"></i>
                            Student Accounts Management
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="align-middle">
                                                <i class="fas fa-envelope text-primary mr-2"></i>
                                                {{ $student->email }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-pill badge-{{ $student->status == 1 ? 'success' : 'secondary' }}">
                                                    <i class="fas fa-{{ $student->status == 1 ? 'check' : 'times' }} mr-1"></i>
                                                    {{ $student->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('college.updateStatus') }}" method="POST"
                                                    class="d-flex align-items-center">
                                                    @csrf
                                                    <input type="hidden" name="type" value="student">
                                                    <input type="hidden" name="id" value="{{ $student->id }}">
                                                    <select name="status" class="form-control form-control-sm mr-2">
                                                        <option value="1" {{ $student->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $student->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-sync-alt mr-1"></i> Update
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Supervisor Section --}}
            <div class="col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-info py-3">
                        <h6 class="m-0 font-weight-bold "style="color: #0dcaf0;">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                            Supervisor Accounts Management
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supervisors as $supervisor)
                                        <tr>
                                            <td class="align-middle">
                                                <i class="fas fa-envelope text-info mr-2"></i>
                                                {{ $supervisor->email }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-pill badge-{{ $supervisor->status == 1 ? 'success' : 'secondary' }}">
                                                    <i class="fas fa-{{ $supervisor->status == 1 ? 'check' : 'times' }} mr-1"></i>
                                                    {{ $supervisor->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('college.updateStatus') }}" method="POST"
                                                    class="d-flex align-items-center">
                                                    @csrf
                                                    <input type="hidden" name="type" value="supervisor">
                                                    <input type="hidden" name="id" value="{{ $supervisor->id }}">
                                                    <select name="status" class="form-control form-control-sm mr-2">
                                                        <option value="1" {{ $supervisor->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $supervisor->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-info">
                                                        <i class="fas fa-sync-alt mr-1"></i> Update
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Company Section --}}
            <div class="col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-dark py-3">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-building mr-2"></i>
                            Company Accounts Management
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td class="align-middle">
                                                <i class="fas fa-envelope text-dark mr-2"></i>
                                                {{ $company->email }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-pill badge-{{ $company->status == 1 ? 'success' : 'secondary' }}">
                                                    <i class="fas fa-{{ $company->status == 1 ? 'check' : 'times' }} mr-1"></i>
                                                    {{ $company->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('college.updateStatus') }}" method="POST"
                                                    class="d-flex align-items-center">
                                                    @csrf
                                                    <input type="hidden" name="type" value="company">
                                                    <input type="hidden" name="id" value="{{ $company->id }}">
                                                    <select name="status" class="form-control form-control-sm mr-2">
                                                        <option value="1" {{ $company->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $company->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-dark">
                                                        <i class="fas fa-sync-alt mr-1"></i> Update
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals remain unchanged --}}
    <!-- Create Student Modal -->
    <div class="modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="createStudentLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('user.createStudent') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="createStudentLabel">
                            <i class="fas fa-user-graduate mr-2"></i>
                            Create Student Account
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="student-email">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="student-email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="student-password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" id="student-password" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Create Account
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Supervisor Modal -->
    <div class="modal fade" id="createSupervisorModal" tabindex="-1" role="dialog"
        aria-labelledby="createSupervisorLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('user.createSupervisor') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="createSupervisorLabel">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                            Create Supervisor Account
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="supervisor-email">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="supervisor-email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="supervisor-password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" id="supervisor-password" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save mr-1"></i> Create Account
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
