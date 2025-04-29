<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternshipOpportunity;

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
    ]);

    InternshipOpportunity::create([
        'title' => $validated['title'],
        'requirements' => $validated['requirements'],
        'start_time' => $validated['start_time'],
        'end_time' => $validated['end_time'],
        'description' => $validated['description'],
        'company_id' => auth()->user()->id, // 🔥 Automatically link to the logged-in company
    ]);

    return redirect()->route('internship.post')->with('success', 'Internship posted successfully!');
}
}
