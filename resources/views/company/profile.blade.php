@extends('layouts.app')
@section('body')
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column: Icons on the top-left -->
            <div class="col-md-3 d-flex flex-column align-items-start ms-0">
                <i class="fa-regular fa-user fa-7x mb-3"></i>
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-regular fa-square-plus fa-3x me-2"></i>
                    <button class="btn btn-secondary">Add</button>
                </div>
            </div>

            <!-- Right Column: Form Inputs and Description -->
            <div class="col-md-9">
                <form action="{{route('company.profile.save')}}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- First and second inputs beside each other -->
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Name</strong></span>
                                <input type="text" class="form-control form-control-lg" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="name"  placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Location</strong></span>
                                <input type="text" class="form-control form-control-lg" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="location" placeholder="Enter Location">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Type</strong></span>
                                <input type="text" class="form-control form-control-lg" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="type"  placeholder="Enter Type">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Contact Info</strong></span>
                                <input type="text" class="form-control form-control-lg" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="contact_info"  placeholder="Enter Contact Inof">
                            </div>
                        </div>
                    </div>

                    <!-- Description under the icons and bigger -->
                    <div class="mb-3 w-100">
                        <label for="largeDescription" class="form-label"><strong>Description</strong></label>
                        <!-- Custom width applied here -->
                        <textarea class="form-control custom-width" id="largeDescription" name="description" rows="10" 
                         style="font-size: 1rem;"  placeholder="Enter Description"></textarea>
                    </div>

                    <!-- Save Button under the description -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection


