<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function profile()
    {
        $student = Student::with('supervisor')->where('id', Auth::guard('student')->id())->firstOrFail();
        return view('student.profile', compact('student'));
    }


    public function updateProfile(Request $request)
    {
        /** @var \App\Models\Student $student */
        $student = Auth::guard('student')->user();

        if (!$student) {
            return redirect()->route('login')->withErrors(['auth' => 'Please log in again.']);
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'st_department' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:0,4.00',
        ]);


        $data = [
            'full_name' => $request->full_name,
            'st_department' => $request->st_department,
            'gpa' => $request->gpa,
        ];


        $student->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }
    public function internships()
    {
        return view('student.internships');
    }
}
