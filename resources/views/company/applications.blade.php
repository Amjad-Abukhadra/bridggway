@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    Applications for Your Internship
                </h2>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Application List</h6>
            </div>
            
            <div class="card-body">
                @if ($applications->isEmpty())
                    <div class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-clipboard-list fa-2x mb-3"></i>
                            <p class="mb-0">No applications received yet.</p>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="font-weight-bold" style="width: 5%">#</th>
                                    <th class="font-weight-bold" style="width: 25%">Student Name</th>
                                    <th class="font-weight-bold" style="width: 35%">Internship Title</th>
                                    <th class="font-weight-bold" style="width: 20%">Status</th>
                                    <th class="font-weight-bold" style="width: 15%">Applied On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>
                                            <span class="font-weight-medium">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                                    {{ strtoupper(substr($application->student->full_name ?? 'N/A', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">{{ $application->student->full_name ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $application->student->email ?? 'No email' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-briefcase text-primary mr-2"></i>
                                                <span>{{ $application->internshipOpportunity->title ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @switch($application->status)
                                                @case(0)
                                                    <span class="badge badge-warning px-3 py-2">
                                                        <i class="fas fa-clock mr-1"></i> Pending
                                                    </span>
                                                    @break
                                                @case(1)
                                                    <span class="badge badge-success px-3 py-2">
                                                        <i class="fas fa-check mr-1"></i> Accepted
                                                    </span>
                                                    @break
                                                @case(2)
                                                    <span class="badge badge-danger px-3 py-2">
                                                        <i class="fas fa-times mr-1"></i> Rejected
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="badge badge-secondary px-3 py-2">
                                                        <i class="fas fa-question mr-1"></i> Unknown
                                                    </span>
                                            @endswitch
                                        </td>
                                        <td class="align-middle text-muted">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            {{ $application->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .badge {
            font-size: 0.85rem;
            font-weight: 500;
        }
    </style>
    @endpush
@endsection
