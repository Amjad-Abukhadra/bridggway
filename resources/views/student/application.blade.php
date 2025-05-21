@extends('layouts.app')

@section('body')
<div class="container mt-5">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-clipboard-list text-primary me-3 fa-2x"></i>
        <h3 class="ml-2">Your Internship Applications</h3>
    </div>

    @if($applications->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox text-muted mb-4 fa-3x"></i>
                <p class="mb-0 text-muted">You have not applied to any internships yet.</p>
            </div>
        </div>
    @else
        @foreach($applications as $application)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        @if($application->internshipOpportunity)
                            {{ $application->internshipOpportunity->title }}
                        @else
                            <em>Title Not Available</em>
                        @endif
                    </h5>
                </div>
                <div class="card-body py-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <p class="mb-4">
                                <i class="fas fa-building text-muted me-2"></i>
                                <strong>Company:</strong>
                                @if($application->company)
                                    {{ $application->company->name }}
                                @else
                                    <em>Not available</em>
                                @endif
                            </p>
                            <p class="mb-0">
                                <i class="far fa-calendar-alt text-muted me-2"></i>
                                <strong>Applied on:</strong>
                                {{ $application->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            @php
                                $statusData = match ($application->status) {
                                    0 => ['label' => 'Pending', 'class' => 'warning', 'icon' => 'clock'],
                                    1 => ['label' => 'Accepted', 'class' => 'success', 'icon' => 'check-circle'],
                                    2 => ['label' => 'Rejected', 'class' => 'danger', 'icon' => 'times-circle'],
                                    default => ['label' => 'Unknown', 'class' => 'secondary', 'icon' => 'question-circle'],
                                };
                            @endphp
                            <div class="d-flex align-items-center">
                                <span class="me-3"><strong>Status:</strong></span>
                                <span class="badge bg-{{ $statusData['class'] }} d-flex align-items-center py-2 px-3">
                                    <i class="fas fa-{{ $statusData['icon'] }} me-2"></i>
                                    {{ $statusData['label'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
