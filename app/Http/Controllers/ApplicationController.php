<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\InternshipOpportunity;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        $internship = InternshipOpportunity::with('company')->findOrFail($id);

        // Check if student has a supervisor assigned
        if (is_null($student->super_id)) {
            return back()->with('error', 'You must be assigned a supervisor before applying for an internship.');
        }

        // Check if student has any pending or accepted applications
        $existingApplications = Application::where('std_id', $student->id)
            ->whereIn('status', [0, 1]) // 0 = pending, 1 = accepted
            ->first();

        if ($existingApplications) {
            return back()->with('error', 'You cannot apply for another internship until your existing application is rejected.');
        }

        // Prevent duplicate applications for the same internship
        $duplicateApplication = Application::where('std_id', $student->id)
            ->where('internship_id', $internship->id)
            ->where('status', '!=', 2) // not rejected
            ->first();

        if ($duplicateApplication) {
            return back()->with('warning', 'You have already applied for this internship.');
        }

        // Create the application
        Application::create([
            'std_id'        => $student->id,
            'comp_id'       => $internship->company_id,
            'internship_id' => $internship->id,
            'super_id'      => $student->super_id,
            'status'        => 0, // pending
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function applications()
    {
        $student = Auth::guard('student')->user();

        $applications = Application::with(['internshipOpportunity', 'company', 'supervisor'])
            ->where('std_id', $student->id)
            ->get();
        return view('student.application', compact('applications'));
    }
}
