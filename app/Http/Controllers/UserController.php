<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirect based on user role
        $user = auth()->user();
        if ($user->role === 'college') {
            return redirect()->route('home');
        } elseif ($user->role === 'student') {
            return redirect()->route('internships');
        } elseif ($user->role === 'company') {
            return redirect()->route('company.profile');
        } elseif ($user->role === 'supervisor') {
            return redirect()->route('supervisor.profile');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized role.']);
        }
    }

    return back()->withErrors([
        'email' => 'Invalid email or password.',
    ])->onlyInput('email');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // -------- Your existing create functions --------
    public function createStudent()
    {
        $this->createUser('student');
        return redirect()->route('home')->with('success', 'Student created successfully!');
    }

    public function createCompany(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $admin = auth()->user();

    $user = new User();
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->role = 'company'; // Automatically set
    $user->college_id = $admin->college_id;
    $user->save();

    return redirect()->route('home')->with('success', 'Company created successfully!');
}


    public function createSupervisor()
    {
        $this->createUser('supervisor');
        return redirect()->route('home')->with('success', 'Supervisor created successfully!');
    }

    private function createUser($role)
    {
        $admin = auth()->user();

        $email = $role . '_' . Str::random(5) . '@example.com';
        $password = Str::random(8);

        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->college_id = $admin->college_id;
        $user->save();

        
    }
    public function dashboard()
    {
        return view('college.home'); // <-- This is what was missing
    }
}
