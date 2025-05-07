<!-- Sidebar Navigation -->
<nav id="sidebar">
  <!-- Sidebar Header -->
  @php
  $guards = ['company', 'college', 'student', 'supervisor'];
  $type = null;
  $user = null;

  foreach ($guards as $guard) {
    if (Auth::guard($guard)->check()) {
      $type = $guard;
      $user = Auth::guard($guard)->user();
      break;
    }
  }
@endphp

  <div class="sidebar-header d-flex align-items-center">
    <div class="title">
      <h1 class="h5">
        {{ $user->college_name ?? $user->company_name ?? $user->full_name ?? $user->name ?? $user->email ?? 'User' }}
      </h1>
      <p class="text-muted text-sm">{{ ucfirst($type) }}</p>
    </div>
  </div>

  <span class="heading">Main</span>
  <ul class="list-unstyled">
    @if($type === 'company')
      <li><a href="{{ url('/company/profile') }}"><i class="fa fa-user-circle"></i> PROFILE</a></li>
      <li><a href="{{ url('/company/post') }}"><i class="fa fa-file"></i> POST</a></li>
      <li><a href="{{ url('/company/applications') }}"><i class="fa fa-bar-chart"></i> APPLICATIONS</a></li>
      <li><a href="{{ url('/company/feedback') }}"><i class="fa fa-comments"></i> FEEDBACK</a></li>

    @elseif($type === 'college')
      <li><a href="{{ route('college.home') }}"><i class="fa fa-home"></i> HOME</a></li>
      <li><a href="{{ route('college.assign') }}"><i class="fa fa-user"></i> ASSIGN</a></li>

      @elseif($type === 'student')
      <li>
        <a href="{{ route('student.profile') }}">
          <i class="fa fa-user-circle"></i> Profile
        </a>
      </li>
      <li>
        <a href="{{ route('student.applications') }}">
          <i class="fa fa-file-alt"></i> Applications
        </a>
      </li>
      <li>
        <a href="{{ route('student.internships') }}">
          <i class="fa fa-briefcase"></i> Internships
        </a>
      </li>
    

    @elseif($type === 'supervisor')
      <li><a href="#"><i class="fa fa-user-graduate"></i> Supervisor Dashboard</a></li>
    @endif

    <!-- Logout -->
    <li>
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out-alt"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</nav>
