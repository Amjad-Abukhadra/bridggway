<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Report;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SupervisorController extends Controller
{
    public function dashboard()
    {
        $supervisor = Auth::guard('supervisor')->user();
        
        // Get assigned students count
        $studentsCount = Student::where('super_id', $supervisor->id)->count();
        
        // Get reports statistics (excluding final evaluations)
        $currentWeek = Carbon::now()->weekOfYear;
        $assignedStudents = Student::where('super_id', $supervisor->id)->get();
        $studentIds = $assignedStudents->pluck('id');
        
        $reportsSubmitted = Report::whereIn('student_id', $studentIds)
            ->where('week_number', '>', 0)
            ->where('week_number', $currentWeek)
            ->count();
        
        $reportsMissing = count($studentIds) - $reportsSubmitted;
        
        // Get evaluations count (students with final evaluation)
        $evaluationsCount = Report::whereIn('student_id', $studentIds)
            ->where('week_number', 0)
            ->whereNotNull('performance_level')
            ->whereNotNull('overall_completion')
            ->distinct('student_id')
            ->count('student_id');
        
        return view('supervisor.dashboard', compact(
            'studentsCount',
            'reportsSubmitted',
            'reportsMissing',
            'evaluationsCount'
        ));
    }

    public function students()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $students = Student::where('super_id', $supervisor->id)
            ->with(['reports'])
            ->get();
        
        // Get applications separately
        foreach ($students as $student) {
            $student->applicationCount = Application::where('std_id', $student->id)
                ->where('super_id', $supervisor->id)
                ->count();
        }
        
        return view('supervisor.students', compact('students'));
    }

    public function reports()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $students = Student::where('super_id', $supervisor->id)
            ->with(['reports' => function($query) {
                $query->where('week_number', '>', 0)
                      ->orderBy('week_number', 'desc');
            }])
            ->get();
        
        return view('supervisor.reports', compact('students'));
    }

    public function studentReports(Student $student)
    {
        // Verify the student belongs to this supervisor
        if ($student->super_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $reports = $student->reports()
            ->where('week_number', '>', 0)
            ->orderBy('week_number', 'desc')
            ->get();
        
        return view('supervisor.student-reports', compact('student', 'reports'));
    }

    public function applications()
    {
        $supervisor = Auth::guard('supervisor')->user();
        
        // Get applications only from students assigned to this supervisor
        $applications = Application::whereHas('student', function($query) use ($supervisor) {
            $query->where('super_id', $supervisor->id);
        })
        ->with(['student', 'company', 'internshipOpportunity'])
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('supervisor.applications', compact('applications'));
    }

    public function approveApplication(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        
        // Verify the student belongs to this supervisor
        if ($application->student->super_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $status = $request->input('status');
        $application->update(['status' => $status]);
        
        $statusText = $status == 0 ? 'pending' : ($status == 1 ? 'approved' : 'rejected');
        return back()->with('success', 'Application marked as ' . $statusText . ' successfully.');
    }

    public function evaluations()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $students = Student::where('super_id', $supervisor->id)
            ->get();
        
        // Get the latest evaluation for each student
        foreach ($students as $student) {
            $student->evaluation = Report::where('student_id', $student->id)
                ->whereNotNull('performance_level')
                ->whereNotNull('overall_completion')
                ->latest()
                ->first();
        }
        
        return view('supervisor.evaluations', compact('students'));
    }

    public function studentEvaluation(Student $student)
    {
        // Verify the student belongs to this supervisor
        if ($student->super_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $evaluation = Report::where('student_id', $student->id)
            ->whereNotNull('performance_level')
            ->whereNotNull('overall_completion')
            ->latest()
            ->first();
        
        return view('supervisor.student-evaluation', compact('student', 'evaluation'));
    }
}
