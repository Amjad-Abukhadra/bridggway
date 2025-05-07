@extends('layouts.app')

@section('body')
<div class="container mt-4">

    {{-- 🔔 Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔘 Action Buttons --}}
    <div class="d-flex justify-content-between mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createStudentModal">
            + Create Student
        </button>

        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createSupervisorModal">
            + Create Supervisor
        </button>
    </div>

    {{-- 🧑‍🎓 Student Section --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Manage Student Accounts
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->email }}</td>
                            <td>
                                <span class="badge badge-{{ $student->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $student->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('college.updateStatus') }}" method="POST" class="form-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="student">
                                    <input type="hidden" name="id" value="{{ $student->id }}">
                                    <select name="status" class="form-control mr-2">
                                        <option value="1" {{ $student->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $student->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 🧑‍🏫 Supervisor Section --}}
<div class="card mb-4">
  <div class="card-header bg-secondary text-white">
      <strong>Manage Supervisor Accounts</strong>
  </div>
  <div class="card-body p-0">
      <table class="table table-striped table-hover mb-0">
          <thead>
              <tr>
                  <th>Email</th>
                  <th>Status</th>
                  <th style="width: 200px">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($supervisors as $supervisor)
                  <tr>
                      <td>{{ $supervisor->email }}</td>
                      <td>
                          <span class="badge badge-{{ $supervisor->status == 1 ? 'secondary' : 'light' }}">
                              {{ $supervisor->status == 1 ? 'Active' : 'Inactive' }}
                          </span>
                      </td>
                      <td>
                          <form action="{{ route('college.updateStatus') }}" method="POST" class="form-inline">
                              @csrf
                              <input type="hidden" name="type" value="supervisor">
                              <input type="hidden" name="id" value="{{ $supervisor->id }}">
                              <select name="status" class="form-control mr-2">
                                  <option value="1" {{ $supervisor->status == 1 ? 'selected' : '' }}>Active</option>
                                  <option value="0" {{ $supervisor->status == 0 ? 'selected' : '' }}>Inactive</option>
                              </select>
                              <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>

    {{-- 🏢 Company Section --}}
    <div class="card mb-5">
        <div class="card-header bg-dark text-white">
            Manage Company Accounts
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->email }}</td>
                            <td>
                                <span class="badge badge-{{ $company->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $company->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('college.updateStatus') }}" method="POST" class="form-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="company">
                                    <input type="hidden" name="id" value="{{ $company->id }}">
                                    <select name="status" class="form-control mr-2">
                                        <option value="1" {{ $company->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $company->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-dark">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Create Student Modal -->
<div class="modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="createStudentLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ route('user.createStudent') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createStudentLabel">Create Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="student-email">Email</label>
            <input type="email" class="form-control" name="email" id="student-email" required>
          </div>
          <div class="form-group">
            <label for="student-password">Password</label>
            <input type="password" class="form-control" name="password" id="student-password" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Create Supervisor Modal -->
<div class="modal fade" id="createSupervisorModal" tabindex="-1" role="dialog" aria-labelledby="createSupervisorLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ route('user.createSupervisor') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createSupervisorLabel">Create Supervisor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="supervisor-email">Email</label>
            <input type="email" class="form-control" name="email" id="supervisor-email" required>
          </div>
          <div class="form-group">
            <label for="supervisor-password">Password</label>
            <input type="password" class="form-control" name="password" id="supervisor-password" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
