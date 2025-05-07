<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function profile() {
        $company = Auth::guard('company')->user();
        return view('company.profile', compact('company'));
    }
    
    public function post() {
        return view('company.post');
    }
    
    public function application() {
        return view('company.applications');
    }
    
    public function feedback() {
        return view('company.feedback');
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

    // Prepare update data
    $data = [
        'name' => $request->name,
        'location' => $request->location,
        'type' => $request->type,
        'contact_info' => $request->contact_info,
        'description' => $request->description,
    ];

    // Handle image upload
    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/company_images', $filename);

        // Delete old image if exists
        if (!empty($company->profile_image) && Storage::exists('public/company_images/' . $company->profile_image)) {
            Storage::delete('public/company_images/' . $company->profile_image);
        }

        // Add image to update data
        $data['profile_image'] = $filename;
    }

    $company->update($data);

    return back()->with('success', 'Profile updated successfully!');
}

    


    

}
