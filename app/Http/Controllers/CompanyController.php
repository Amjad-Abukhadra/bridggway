<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use App\Models\Report;

class CompanyController extends Controller
{
    public function profile()
    {
        $company = Auth::guard('company')->user();
        return view('company.profile', compact('company'));
    }

    public function post()
    {
        return view('company.post');
    }

    public function application()
    {
        return view('company.applications');
    }

    public function feedback()
    {
        $companyId = auth()->guard('company')->id(); // current logged-in company

        // Get all accepted applications for this company
        $applications = Application::with('student')
            ->where('comp_id', $companyId)
            ->where('status', 1) // accepted
            ->get();

        return view('company.feedback', compact('applications'));
    }

    public function saveProfile(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var \App\Models\Company $company */
        $company = Auth::guard('company')->user();

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'type' => $request->type,
            'contact_info' => $request->contact_info,
            'description' => $request->description,
        ];

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/company_images', $filename);
            $data['profile_image'] =  $filename;
        }

        $company->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function applications()
    {
        $company = Auth::guard('company')->user();

        $applications = Application::with(['student', 'internshipOpportunity'])
            ->where('comp_id', $company->id)
            ->get();

        return view('company.applications', compact('applications'));
    }

    public function show($id)
    {
        $company = Company::with('internshipOpportunities')->findOrFail($id);
        return view('company.public-profile', compact('company'));
    }

    public function submitFeedback(Request $request)
    {
        foreach ($request->entries as $studentId => $weeks) {
            // 🔍 Get supervisor ID for this student
            $supervisorId = \App\Models\Student::find($studentId)?->super_id;

            foreach ($weeks as $weekData) {
                Report::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'week_number' => $weekData['week_number'],
                        'comp_id' => Auth::guard('company')->id(),
                    ],
                    [
                        'task' => $weekData['task'],
                        'tools' => $weekData['tools'],
                        'number_of_hours' => $weekData['hours'],
                        'super_id' => $supervisorId, // ✅ required to prevent error
                    ]
                );
            }
        }

        return back()->with('success', 'All weekly reports saved successfully.');
    }

    public function submitEvaluation(Request $request)
    {
        $studentId = $request->student_id;
        $evaluations = $request->evaluation;

        // Create a new report for final evaluation with week_number = 0
        $updateData = [
            'student_id' => $studentId,
            'comp_id' => Auth::guard('company')->id(),
            'week_number' => 0, // This indicates it's a final evaluation
            'super_id' => \App\Models\Student::find($studentId)?->super_id
        ];

        // Add evaluation data directly from the form
        foreach ($evaluations as $field => $rating) {
            $updateData[$field] = $rating;
        }

        // Create or update the final evaluation report
        Report::updateOrCreate(
            [
                'student_id' => $studentId,
                'comp_id' => Auth::guard('company')->id(),
                'week_number' => 0
            ],
            $updateData
        );

        return back()->with('success', 'Final evaluation submitted successfully.');
    }
}
