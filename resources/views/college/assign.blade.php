@extends('layouts.app')

@section('body')
<div class="container mt-4">

    <!-- Header Section -->
    <div class="bg-info text-white rounded p-4 mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-check fa-2x mr-3"></i>
            <div>
                <h2 class="mb-1 font-weight-bold">Assign Student to Supervisor</h2>
                <p class="mb-0 text-light">Manage department-specific internship supervision</p>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Assignment Form -->
    <form method="POST" action="{{ route('assign.store') }}">
        @csrf

        <!-- Department -->
        <div class="form-group">
            <label for="department" class="font-weight-bold">Select Department</label>
            <select id="department" class="form-control" required>
                <option value="">-- Choose department --</option>
                <option value="CS">CS</option>
                <option value="CIS">CIS</option>
                <option value="DS">DS</option>
                <option value="AI">AI</option>
                <option value="BIT">BIT</option>
            </select>
        </div>

        <!-- Student -->
        <div class="form-group">
            <label for="student_id" class="font-weight-bold">Select Student</label>
            <select name="student_id" id="student_id" class="form-control" required disabled>
                <option value="">-- Choose a student --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" data-dept="{{ $student->st_department }}">
                        {{ $student->email }} ({{ $student->st_department }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Supervisor -->
        <div class="form-group">
            <label for="super_id" class="font-weight-bold">Select Supervisor</label>
            <select name="super_id" id="super_id" class="form-control" required disabled>
                <option value="">-- Choose a supervisor --</option>
                @foreach ($supervisors as $supervisor)
                    <option value="{{ $supervisor->id }}" data-dept="{{ $supervisor->super_department }}">
                        {{ $supervisor->email }} ({{ $supervisor->super_department }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-info font-weight-bold px-4 py-2 rounded-pill" id="assign-btn" disabled>
            <i class="fas fa-paper-plane mr-1"></i> Assign
        </button>
    </form>
</div>

<!-- Script -->
<script>
    const departmentSelect = document.getElementById('department');
    const studentSelect = document.getElementById('student_id');
    const supervisorSelect = document.getElementById('super_id');
    const assignBtn = document.getElementById('assign-btn');

    departmentSelect.addEventListener('change', function () {
        const selectedDept = this.value.toLowerCase();

        studentSelect.disabled = false;
        supervisorSelect.disabled = false;

        studentSelect.querySelectorAll('option').forEach(option => {
            const dept = option.getAttribute('data-dept');
            option.hidden = dept && dept.toLowerCase() !== selectedDept;
        });
        studentSelect.value = "";

        supervisorSelect.querySelectorAll('option').forEach(option => {
            const dept = option.getAttribute('data-dept');
            option.hidden = dept && dept.toLowerCase() !== selectedDept;
        });
        supervisorSelect.value = "";

        assignBtn.disabled = true;
    });

    [studentSelect, supervisorSelect].forEach(select => {
        select.addEventListener('change', () => {
            assignBtn.disabled = !(studentSelect.value && supervisorSelect.value);
        });
    });
</script>
@endsection
