@extends('layouts.app')

@section('body')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white">
                    <i class="fas fa-building mr-2"></i>
                    Company Profile
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
                <form id="profileForm" action="{{ route('company.profile.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left Column: Profile Image + Upload -->
                        <div class="col-md-3 d-flex flex-column align-items-center">
                            <div class="mb-3 text-center">
                                @if ($company->profile_image)
                                    <img src="{{ asset('storage/company_images/' . $company->profile_image) . '?v=' . time() }}"
                                         alt="Profile Image"
                                         class="rounded-circle shadow-sm"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center"
                                         style="width: 150px; height: 150px;">
                                        <i class="fas fa-building fa-3x text-white"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 text-center">
                                <input type="file" id="profile_image" name="profile_image" accept="image/*"
                                       style="display: none;"
                                       onchange="document.getElementById('profileForm').submit();">
                                <button type="button" class="btn btn-outline-primary"
                                        onclick="document.getElementById('profile_image').click();">
                                    <i class="fas fa-camera mr-1"></i>
                                    Change Photo
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Text Inputs -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Company Name</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name', $company->name ?? '') }}" 
                                           placeholder="Enter your company name">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Location</label>
                                    <input type="text" class="form-control" name="location"
                                           value="{{ old('location', $company->location ?? '') }}"
                                           placeholder="Enter company location">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Industry Type</label>
                                    <input type="text" class="form-control" name="type"
                                           value="{{ old('type', $company->type ?? '') }}" 
                                           placeholder="Enter industry type">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Contact Information</label>
                                    <input type="text" class="form-control" name="contact_info"
                                           value="{{ old('contact_info', $company->contact_info ?? '') }}"
                                           placeholder="Enter contact details (email, phone, website)">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="font-weight-bold">Company Description</label>
                                <textarea class="form-control" name="description" rows="5"
                                          placeholder="Tell us about your company...">{{ old('description', $company->description ?? '') }}</textarea>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save mr-1"></i>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
