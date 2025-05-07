@extends('layouts.app')

@section('body')
<div class="container mt-4">
    <h2>Update Your Profile</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('student.profile.update') }}" method="POST">
        @csrf

        <div class="form-group mt-3">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $student->full_name?? '') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="st_department">Department</label>
            <input type="text" name="st_department" class="form-control" value="{{ old('st_department', $student->st_department?? '') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="gpa">GPA</label>
            <input type="number" name="gpa" step="0.01" class="form-control" value="{{ old('gpa', $student->gpa?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
    </form>
</div>
@endsection
