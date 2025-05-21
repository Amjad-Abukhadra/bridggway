@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white">
                    <i class="fas fa-users mr-2"></i>
                    Accepted Students
                </h2>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">Student List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="font-weight-bold">Name</th>
                                <th class="font-weight-bold">Email</th>
                                <th class="font-weight-bold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $application)
                                @php
                                    $student = $application->student;
                                    $reports = $student->reports->keyBy('week_number');
                                @endphp

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($student->full_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $student->full_name }}</div>
                                                <small class="text-muted">{{ $student->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-muted">{{ $student->email }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary mx-1 px-3" data-toggle="modal"
                                                data-target="#studentModal{{ $student->id }}">
                                                <i class="fas fa-file-alt mr-1"></i> Report
                                            </button>

                                            <button class="btn btn-sm btn-outline-info mx-1 px-3" data-toggle="modal"
                                                data-target="#evalModal{{ $student->id }}">
                                                <i class="fas fa-star mr-1"></i> Evaluate
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Report Modal --}}
                                @push('modals')
                                    <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="studentModalLabel{{ $student->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content bg-dark">
                                                <div class="modal-header bg-primary text-white py-3">
                                                    <h6 class="modal-title font-weight-bold m-0">
                                                        <i class="fas fa-file-alt mr-2"></i>
                                                        Weekly Report for {{ $student->full_name }}
                                                    </h6>
                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body bg-white">
                                                    <ul class="nav nav-pills mb-3 justify-content-center" id="weekTab{{ $student->id }}"
                                                        role="tablist">
                                                        @foreach (range(1, 6) as $week)
                                                            <li class="nav-item">
                                                                <a class="nav-link {{ $week == 1 ? 'active' : '' }}"
                                                                    id="tab{{ $student->id }}-{{ $week }}" data-toggle="pill"
                                                                    href="#content{{ $student->id }}-{{ $week }}" role="tab">
                                                                    Week {{ $week }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    <div class="tab-content" id="weekTabContent{{ $student->id }}">
                                                        @foreach (range(1, 6) as $week)
                                                            <div class="tab-pane fade {{ $week == 1 ? 'show active' : '' }}"
                                                                id="content{{ $student->id }}-{{ $week }}" role="tabpanel">
                                                                <form action="{{ route('company.feedback.submit') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden"
                                                                        name="entries[{{ $student->id }}][{{ $week }}][student_id]"
                                                                        value="{{ $student->id }}">
                                                                    <input type="hidden"
                                                                        name="entries[{{ $student->id }}][{{ $week }}][week_number]"
                                                                        value="{{ $week }}">

                                                                    <div class="card shadow-sm">
                                                                        <div class="card-body">
                                                                            <h6 class="font-weight-bold mb-3">Week {{ $week }} Report</h6>

                                                                            <div class="form-group">
                                                                                <label>Task</label>
                                                                                <input type="text"
                                                                                    name="entries[{{ $student->id }}][{{ $week }}][task]"
                                                                                    value="{{ $reports[$week]->task ?? '' }}"
                                                                                    class="form-control" placeholder="Enter task description">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Tools/Equipment Used</label>
                                                                                <input type="text"
                                                                                    name="entries[{{ $student->id }}][{{ $week }}][tools]"
                                                                                    value="{{ $reports[$week]->tools ?? '' }}"
                                                                                    class="form-control" placeholder="Enter tools used">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Hours</label>
                                                                                <input type="number"
                                                                                    name="entries[{{ $student->id }}][{{ $week }}][hours]"
                                                                                    value="{{ $reports[$week]->number_of_hours ?? '' }}"
                                                                                    class="form-control" placeholder="Enter hours"
                                                                                    min="1" max="40">
                                                                            </div>

                                                                            <div class="text-right">
                                                                                <button type="submit" class="btn btn-primary btn-sm px-4">
                                                                                    <i class="fas fa-save mr-1"></i>
                                                                                    Save Week {{ $week }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endpush

                                {{-- Evaluation Modal --}}
                                @push('modals')
                                    @php
                                        $latestReport = $student->reports()
                                            ->where('comp_id', auth()->guard('company')->id())
                                            ->latest()
                                            ->first();
                                    @endphp
                                    <div class="modal fade" id="evalModal{{ $student->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="evalModalLabel{{ $student->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white py-3">
                                                    <h6 class="modal-title font-weight-bold m-0">
                                                        <i class="fas fa-star mr-2"></i>
                                                        Final Evaluation for {{ $student->full_name }}
                                                    </h6>
                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('company.evaluate.submit') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    
                                                    <div class="modal-body">
                                                        <div class="alert alert-info">
                                                            <i class="fas fa-info-circle mr-2"></i>
                                                            This is the final evaluation for the student's internship performance.
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0">
                                                                <thead>
                                                                    <tr class="bg-light">
                                                                        <th class="align-middle font-weight-bold text-dark" style="width: 30%">Criteria</th>
                                                                        <th class="text-center text-dark" colspan="5">Rating</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $criteria = [
                                                                            'Performance Level' => 'performance_level',
                                                                            'Responsibility' => 'responsibility',
                                                                            'Punctuality' => 'punctuality',
                                                                            'Accuracy in Work' => 'accuracy_in_work',
                                                                            'Teamwork' => 'teamwork',
                                                                            'Adaptability' => 'adaptability',
                                                                            'Skill Acquisition Speed' => 'skill_acquisition_speed',
                                                                            'Overall Completion' => 'overall_completion',
                                                                        ];
                                                                        
                                                                        $ratings = [
                                                                            'excellent' => ['label' => 'Excellent', 'class' => 'success'],
                                                                            'very_good' => ['label' => 'Very Good', 'class' => 'info'],
                                                                            'good' => ['label' => 'Good', 'class' => 'primary'],
                                                                            'acceptable' => ['label' => 'Acceptable', 'class' => 'warning'],
                                                                            'weak' => ['label' => 'Weak', 'class' => 'danger']
                                                                        ];
                                                                    @endphp

                                                                    @foreach ($criteria as $criterionLabel => $criterionField)
                                                                        <tr>
                                                                            <td class="align-middle">
                                                                                <div class="font-weight-medium">{{ $criterionLabel }}</div>
                                                                                <small class="text-muted">Rate the student's {{ strtolower($criterionLabel) }}</small>
                                                                            </td>
                                                                            <td class="align-middle" colspan="5">
                                                                                <div class="d-flex justify-content-between px-2">
                                                                                    @foreach ($ratings as $rating => $info)
                                                                                        <div class="custom-control custom-radio">
                                                                                            <input type="radio"
                                                                                                class="custom-control-input"
                                                                                                id="{{ $criterionField }}_{{ $rating }}_{{ $student->id }}"
                                                                                                name="evaluation[{{ $criterionField }}]"
                                                                                                value="{{ $rating }}"
                                                                                                {{ $latestReport && $latestReport->$criterionField === $rating ? 'checked' : '' }}
                                                                                                required>
                                                                                            <label class="custom-control-label text-{{ $info['class'] }}" 
                                                                                                for="{{ $criterionField }}_{{ $rating }}_{{ $student->id }}">
                                                                                                {{ $info['label'] }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            <i class="fas fa-times mr-1"></i> Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-primary px-4">
                                                            <i class="fas fa-save mr-1"></i> Submit Evaluation
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endpush
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-user-slash fa-2x mb-3"></i>
                                            <p class="mb-0">No accepted students found.</p>
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

    {{-- Output all modals here after the table --}}
    @stack('modals')

    @push('styles')
    <style>
        .custom-control-input:checked ~ .custom-control-label::before {
            border-color: #4e73df;
            background-color: #4e73df;
        }
        
        .nav-pills .nav-link.active {
            background-color: #4e73df;
        }
    </style>
    @endpush
@endsection
