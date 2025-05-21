<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternshipOpportunity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class InternshipController extends Controller
{
    public function showPost()
    {
        return view('company.post');
    }



    public function savePost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'requirements' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Prepare the data array
        $data = [
            'title' => $validated['title'],
            'requirements' => $validated['requirements'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'description' => $validated['description'],
            'company_id' => Auth::guard('company')->id(),
        ];

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the file
            $image->storeAs('public/internship_photos', $filename);

            // ✅ Save the relative path to DB (must include folder)
            $data['photo'] = 'internship_photos/' . $filename;
        }

        // Save to database
        InternshipOpportunity::create($data);

        return redirect()->route('internship.post')->with('success', 'Internship posted successfully!');
    }



    public function internships()
    {
        $today = Carbon::today();

        $internships = InternshipOpportunity::with('company')
            ->whereDate('start_time', '<=', $today)
            ->whereDate('end_time', '>=', $today)
            ->latest()
            ->get();

        return view('student.internships', compact('internships'));
    }
}
