@extends('layouts.app')

@section('body')
<br>
<div class="container">
    <form action="{{ route('internship.post.save') }}" method="POST">
        @csrf <!-- CSRF Token for security -->
        
        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
        </div>
        
        <!-- Photo Upload -->
        <div class="photo-upload">
            <div class="plus-icon">+ Add photo</div>
            <br>
        </div>
        
        <!-- Requirements -->
        <div class="form-group">
            <label for="contact-info">Requirements</label>
            <input type="text" class="form-control" id="contact-info" name="requirements" placeholder="Enter Requirements">
        </div>
        
        <!-- Start and End Date Inputs in the Same Line -->
        <div class="form-group row">
            <div class="col-md-6">
                <label for="start-time">Start Date</label>
                <input type="date" class="form-control" id="start-date" name="start_time" >
            </div>
            <div class="col-md-6">
                <label for="end-time">End Date</label>
                <input type="date" class="form-control" id="end-date" name="end_time">
            </div>
        </div>
        
        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description"></textarea>
        </div>
        
        <!-- Publish Button -->
        <div class="publish-button-container">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
