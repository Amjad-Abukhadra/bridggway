@extends('layouts.app')

@section('body')
    <style>
        .page-header {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E8E 100%);
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .internship-card {
            border: none;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .internship-card:hover {
            transform: translateY(-5px);
        }

        .internship-image-container {
            /* 16:9 Aspect Ratio */
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .internship-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            object-position: center;
        }

        .company-logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
        }

        .badge-custom {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .btn-apply {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E8E 100%);
            border: none;
            padding: 0.8rem 2rem;
            color: white;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        .company-name {
            color: #a74040;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .company-name:hover {
            color: #FF6B6B;
        }
    </style>

    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="bg-white p-3 rounded-circle">
                        <i class="fas fa-briefcase text-danger fa-2x"></i>
                    </div>
                </div>
                <div class="col">
                    <h1 class="text-white mb-0 fw-bold">Available Internships</h1>
                    <p class="text-white-50 mb-0">Find your perfect internship opportunity</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success border-0 rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning border-0 rounded-4 mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('warning') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger border-0 rounded-4 mb-4">
                <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="row">
            @forelse($internships as $internship)
                <div class="col-md-6 col-lg-4">
                    <div class="card internship-card shadow-sm rounded-4">
                        @if ($internship->photo)
                            <div class="internship-image-container rounded-top-4">
                                <img src="{{ asset('storage/internship_photos/' . $internship->photo) }}" class="internship-image"
                                    alt="Internship Image">
                            </div>
                        @endif

                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/company_images/' . $internship->company->profile_image) }}"
                                    class="company-logo me-3" alt="{{ $internship->company->name }}"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($internship->company->name) }}&color=FF6B6B&background=FFF5F5'">
                                <div>
                                    <a href="{{ route('company.profile.view', $internship->company->id) }}"
                                        class="text-decoration-none">
                                        <h6 class="company-name fw-bold mb-1">{{ $internship->company->name }}</h6>
                                    </a>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($internship->created_at)->diffForHumans() }}
                                    </small>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-3">{{ $internship->title }}</h5>

                            <p class="text-muted mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                {{ Str::limit($internship->description, 100) }}
                            </p>

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-danger text-white badge-custom">
                                    <i class="far fa-calendar-alt me-1 text-white"></i>
                                    {{ \Carbon\Carbon::parse($internship->start_time)->format('M d') }} -
                                    {{ \Carbon\Carbon::parse($internship->end_time)->format('M d, Y') }}
                                </span>
                            </div>


                            <div class="d-flex justify-content-between align-items-center">
                                <div class="small text-muted">
                                    <i class="fas fa-clipboard-list me-1"></i>
                                    {{ $internship->requirements }}
                                </div>
                                <form action="{{ route('internship.apply', $internship->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-apply">
                                        Apply Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <div class="bg-danger bg-opacity-10 text-danger d-inline-block p-4 rounded-circle">
                                <i class="fas fa-briefcase fa-3x"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">No Internships Available</h3>
                        <p class="text-muted">Check back later for new opportunities!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
