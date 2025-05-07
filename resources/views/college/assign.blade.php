@extends('layouts.app')

@section('body')
<div class="container">
  <h2 class="mb-4">Assign Student to Supervisor</h2>



  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('assign.store') }}">
    @csrf

    <!-- Student Dropdown -->
    <div class="form-group mb-3">
      <label for="student_id">Select Student</label>
      <select name="student_id" id="student_id" class="form-control" required>
        <option value="" disabled selected>-- Choose a student --</option>
        @foreach ($students as $student)
          <option value="{{ $student->id }}"> ({{ $student->email }})</option>
        @endforeach
      </select>
    </div>

    <!-- Supervisor Dropdown -->
    <div class="form-group mb-4">
      <label for="supervisor_id">Select Supervisor</label>
      <select name="super_id" id="super_id" class="form-control" required>
        <option value="" disabled selected>-- Choose a supervisor --</option>
        @foreach ($supervisors as $supervisor)
          <option value="{{ $supervisor->id }}"> ({{ $supervisor->email }})</option>
        @endforeach
      </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Assign</button>
  </form>
</div>
@endsection
