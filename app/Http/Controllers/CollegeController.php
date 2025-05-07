<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function home()
{
    return view('college.home', [
        'students' => \App\Models\Student::all(),
        'supervisors' => \App\Models\Supervisor::all(),
        'companies' => \App\Models\Company::all(),
    ]);
}

public function assign()
{
    return view('college.assign'); 
}

}
