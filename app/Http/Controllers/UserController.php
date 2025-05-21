<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $guards = ['college', 'company', 'student', 'supervisor'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $user = Auth::guard($guard)->user();

                // Optional: handle inactive accounts
                if (isset($user->status) && $user->status == 0) {
                    Auth::guard($guard)->logout();
                    return back()->with('inactive', 'Your account is not activated yet.');
                }

                // Redirect based on guard
                return match ($guard) {
                    'college' => redirect()->route('college.home'),
                    'company' => redirect()->route('company.profile'),
                    'student' => redirect()->route('student.profile'),
                    'supervisor' => redirect()->route('supervisor.dashboard'),
                    default => redirect('/'),
                };
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // Check which guard is active and logout accordingly
        $guards = ['college', 'company', 'student', 'supervisor'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    // -------- Your existing create functions --------
    public function createStudent(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
        ]);
        Student::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
            'college_id' => 1
        ]);
        return back()->with('message', 'Supervisor created successfully.');
    }
    public function createSupervisor(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:supervisors,email',
            'password' => 'required|min:6',
        ]);

        Supervisor::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
            'college_id' => 1
        ]);

        return back()->with('message', 'Supervisor created successfully.');
    }


    public function dashboard()
    {
        return view('college.home');
    }

    public function showRegisterForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
        ]);

        return redirect()->route('login')->with('message', 'Registration submitted. Wait for college approval.');
    }
    public function showAssignForm()
    {
        $students = Student::all();
        $supervisors = Supervisor::all();

        return view('college.assign', compact('students', 'supervisors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'super_id' => 'required|exists:supervisors,id',
        ]);

        $student = \App\Models\Student::find($request->student_id);
        $student->super_id = $request->super_id;
        $student->save();

        return redirect()->back()->with('success', 'Student assigned to supervisor successfully!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'type' => 'required|in:student,supervisor,company',
            'id' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $models = [
            'student' => \App\Models\Student::class,
            'supervisor' => \App\Models\Supervisor::class,
            'company' => \App\Models\Company::class,
        ];

        $model = $models[$request->type];
        $user = $model::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'Status updated successfully.');
    }
}
