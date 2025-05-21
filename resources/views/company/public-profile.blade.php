@extends('layouts.app')

@section('body')
    <div class="container mt-5 text-white" style="max-width: 800px;">
        {{-- Profile Header --}}
        <div class="text-center  rounded-lg shadow p-5 mb-4">
            <img src="{{ asset('storage/company_images/' . $company->profile_image) }}" 
                alt="{{ $company->name }}"
                class="rounded-circle shadow-sm border border-white mb-4" 
                style="width: 140px; height: 140px; object-fit: cover;"
                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($company->name) }}&size=140&background=FF6B6B&color=fff'">
            <h2 class="text-white mb-2">{{ $company->name }}</h2>
            <p class="text-white-50 mb-0">{{ $company->type }}</p>
        </div>

        {{-- Company Info --}}
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded p-2 mr-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h6 class="text-secondary text-uppercase mb-0">Location</h6>
                        </div>
                        <p class="h5 text-white mb-0">{{ $company->location }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded p-2 mr-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h6 class="text-secondary text-uppercase mb-0">Contact Info</h6>
                        </div>
                        <p class="h5 text-white mb-0">{{ $company->contact_info }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- About Section --}}
        <div class="card shadow-sm border-0 bg-dark mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded p-2 mr-3">
                        <i class="fas fa-building"></i>
                    </div>
                    <h6 class="text-secondary text-uppercase mb-0">About Us</h6>
                </div>
                <p class="text-white mb-0">{{ $company->description }}</p>
            </div>
        </div>

        {{-- Internship List --}}
        <div class="card shadow-sm border-0 bg-dark">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded p-2 mr-3">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h5 class="text-white mb-0">Available Internships</h5>
                </div>

                @forelse($company->internshipOpportunities as $internship)
                    <div class="d-flex align-items-center p-3 mb-2 bg-dark border border-secondary rounded">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-3" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-1">{{ $internship->title }}</h6>
                            <small class="text-white-50">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ \Carbon\Carbon::parse($internship->start_time)->format('M d') }} - 
                                {{ \Carbon\Carbon::parse($internship->end_time)->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open text-white-50 fa-2x mb-3"></i>
                        <p class="text-white-50 mb-0">No internships posted yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
