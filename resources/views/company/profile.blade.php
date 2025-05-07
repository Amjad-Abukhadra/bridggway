@extends('layouts.app')

@section('body')
<div class="container mt-4">
    <div class="row">
        <!-- Left Column: Profile Image + Add Button -->
        <div class="col-md-3 d-flex flex-column align-items-start">
            <div class="mb-3">
                @if($company->profile_image)
                    <img src="{{ asset('storage/company_images/' . $company->profile_image) }}"
                         alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                @else
                    <i class="fa-regular fa-user fa-7x text-muted mb-3"></i>
                @endif
            </div>

            <!-- Add Button to Trigger File Picker -->
            <div class="d-flex align-items-center mb-3">
                <i class="fa-regular fa-square-plus fa-3x me-2"></i>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile_image').click();">
                    Add 
                </button>
            </div>
        </div>

        <!-- Right Column: Profile Form -->
        <div class="col-md-9">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="profileForm" action="{{ route('company.profile.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hidden File Input Triggered by Add Button -->
                <input type="file" id="profile_image" name="profile_image" accept="image/*" style="display: none;" onchange="document.getElementById('profileForm').submit();">

                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><strong>Name</strong></span>
                            <input type="text" class="form-control form-control-lg" name="name"
                                value="{{ old('name', $company->name ?? '') }}"
                                placeholder="Enter Name">
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><strong>Location</strong></span>
                            <input type="text" class="form-control form-control-lg" name="location"
                                value="{{ old('location', $company->location ?? '') }}"
                                placeholder="Enter Location">
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><strong>Type</strong></span>
                            <input type="text" class="form-control form-control-lg" name="type"
                                value="{{ old('type', $company->type ?? '') }}"
                                placeholder="Enter Type">
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><strong>Contact Info</strong></span>
                            <input type="text" class="form-control form-control-lg" name="contact_info"
                                value="{{ old('contact_info', $company->contact_info ?? '') }}"
                                placeholder="Enter Contact Info">
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="largeDescription" class="form-label"><strong>Description</strong></label>
                    <textarea class="form-control" id="largeDescription" name="description" rows="6"
                        style="font-size: 1rem;" placeholder="Enter Description">{{ old('description', $company->description ?? '') }}</textarea>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
