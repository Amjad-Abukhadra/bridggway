<header class="header">
    <nav class="navbar navbar-expand-lg">

        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header-->
                @php
                    use Illuminate\Support\Facades\Auth;

                    $guards = ['college', 'company', 'student', 'supervisor'];
                    $type = null;
                    $user = null;

                    foreach ($guards as $guard) {
                        if (Auth::guard($guard)->check()) {
                            $type = $guard;
                            $user = Auth::guard($guard)->user();
                            break;
                        }
                    }

                    $homeLink = match ($type) {
                        'company' => url('/company/profile'),
                        'college' => route('college.home'),
                        'student' => route('student.profile'),
                        'supervisor' => url('/supervisor/dashboard'),
                        default => '#',
                    };
                @endphp

                <a href="{{ $homeLink }}" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase">
                        <strong class="text-danger">Bridg</strong><strong>Way</strong>
                    </div>
                    <div class="brand-text brand-sm">
                        <strong class="text-primary">B</strong><strong>W</strong>
                    </div>
                </a>



                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>






    </nav>
</header>
