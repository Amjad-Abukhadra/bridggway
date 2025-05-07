<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternshipOpportunity;
use Illuminate\Support\Facades\Auth;


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

    // Handle photo upload
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/internship_photos', $filename);
        $data['photo'] = $filename;
    }

    // Save to database
    InternshipOpportunity::create($data);

    return redirect()->route('internship.post')->with('success', 'Internship posted successfully!');
}

}
