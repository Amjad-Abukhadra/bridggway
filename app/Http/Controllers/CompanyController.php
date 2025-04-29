<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Show the company profile form (GET request)
    public function showProfile()
    {
        return view('company.profile');
    }

    // Handle company profile saving (POST request)
    public function saveProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|string',
            'contact_info' => 'required|string',
            'description' => 'required|string',
        ]);

        Company::create($validated);

        return redirect()->route('company.profile')->with('success', 'Company profile created successfully!');
    }
}
