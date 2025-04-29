@extends('layouts.app')

@section('body')
<form method="POST" action="{{ route('user.createStudent') }}" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-primary">Create Student</button>
</form>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createCompanyModal">
    Create Company
  </button>
<form method="POST" action="{{ route('user.createSupervisor') }}" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-info">Create Supervisor</button>
</form>

<a href="#" class="btn btn-warning">Assign Supervisor to Student</a>

<!-- company modal start -->
<div class="modal fade" id="createCompanyModal" tabindex="-1" role="dialog" aria-labelledby="createCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" action="{{ route('user.createCompany') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createCompanyModalLabel">Create New Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
  
          <div class="modal-body">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
  
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
  
            <!-- Hidden Role Input -->
            <input type="hidden" name="role" value="company">
  
          </div>
  
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create Company</button>
          </div>
  
        </div>
      </form>
    </div>
  </div>
  <!-- company modal start -->


@endsection

