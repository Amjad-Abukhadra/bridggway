@php
    use Illuminate\Support\Facades\Auth;

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



<nav id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header d-flex align-items-center">
        <div class="title">
            <h1 class="h5">
                {{ $user->college_name ?? $user->company_name ?? $user->full_name ?? $user->name ?? $user->email ?? 'User' }}
            </h1>
            <p class="text-muted text-sm">{{ ucfirst($type ?? 'guest') }}</p>
        </div>
    </div>

    <span class="heading">Main</span>
    <ul class="list-unstyled">

        {{-- Company Navigation --}}
        @if($type === 'company')
            <li class="{{ request()->is('company/profile') ? 'active' : '' }}">
                <a href="{{ url('/company/profile') }}"><i class="fa fa-user-circle"></i> Profile</a>
            </li>
            <li class="{{ request()->is('company/post') ? 'active' : '' }}">
                <a href="{{ url('/company/post') }}"><i class="fa fa-file"></i> Post</a>
            </li>
            <li class="{{ request()->is('company/applications') ? 'active' : '' }}">
                <a href="{{ url('/company/applications') }}"><i class="fa fa-bar-chart"></i> Applications</a>
            </li>
            <li class="{{ request()->is('company/feedback') ? 'active' : '' }}">
                <a href="{{ url('/company/feedback') }}"><i class="fa fa-comments"></i> Feedback</a>
            </li>

        {{-- College Navigation --}}
        @elseif($type === 'college')
            <li class="{{ request()->routeIs('college.home') ? 'active' : '' }}">
                <a href="{{ route('college.home') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="{{ request()->routeIs('college.assign') ? 'active' : '' }}">
                <a href="{{ route('college.assign') }}"><i class="fa fa-user"></i> Assign</a>
            </li>

        {{-- Student Navigation --}}
        @elseif($type === 'student')
            <li class="{{ request()->routeIs('student.profile') ? 'active' : '' }}">
                <a href="{{ route('student.profile') }}"><i class="fa fa-user-circle"></i> Profile</a>
            </li>
            <li class="{{ request()->routeIs('student.applications') ? 'active' : '' }}">
                <a href="{{ route('student.applications') }}"><i class="fa fa-file-alt"></i> Applications</a>
            </li>
            <li class="{{ request()->routeIs('student.internships') ? 'active' : '' }}">
                <a href="{{ route('student.internships') }}"><i class="fa fa-briefcase"></i> Internships</a>
            </li>

        {{-- Supervisor Navigation --}}
        @elseif($type === 'supervisor')
            <li class="{{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}">
                <a href="{{ route('supervisor.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="{{ request()->routeIs('supervisor.students') ? 'active' : '' }}">
                <a href="{{ route('supervisor.students') }}">
                    <i class="fas fa-users"></i> Students
                </a>
            </li>
            <li class="{{ request()->routeIs('supervisor.applications') ? 'active' : '' }}">
                <a href="{{ route('supervisor.applications') }}">
                    <i class="fas fa-file-alt"></i> Applications
                </a>
            </li>
        @endif

        <!-- Logout -->
        @if($user)
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        @endif

    </ul>
</nav>
