@extends('layouts.app')

@section('body')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-white">
                <i class="fas fa-file-alt mr-2"></i>
                Internship Applications
            </h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">Application List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="font-weight-bold">Student</th>
                            <th class="font-weight-bold">Company</th>
                            <th class="font-weight-bold">Title</th>
                            <th class="font-weight-bold" width="200">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $application)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($application->student->full_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $application->student->full_name }}</div>
                                            <small class="text-muted">{{ $application->student->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $application->company->name }}</div>
                                    <small class="text-muted">{{ $application->company->location }}</small>
                                </td>
                                <td>{{ $application->internshipOpportunity->title }}</td>
                                <td>
                                    <form action="{{ route('supervisor.application.approve', $application->id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <select name="status" class="custom-select custom-select-sm border-0 rounded" style="width: 140px; background-color: {{ $application->status === 0 ? '#ffeeba' : ($application->status === 1 ? '#c3e6cb' : '#f5c6cb') }}" onchange="this.form.submit()">
                                            <option value="0" {{ $application->status === 0 ? 'selected' : '' }} class="bg-white">Pending</option>
                                            <option value="1" {{ $application->status === 1 ? 'selected' : '' }} class="bg-white">Accepted</option>
                                            <option value="2" {{ $application->status === 2 ? 'selected' : '' }} class="bg-white">Rejected</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-file-alt fa-2x mb-3"></i>
                                        <p class="mb-0">No applications to review.</p>
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