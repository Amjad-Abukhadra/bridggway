<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SupervisorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🟢 Public Routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Add public company profile view route
Route::get('/company/profile/view/{id}', [CompanyController::class, 'show'])->name('company.profile.view');

// ✅ College Routes (protected by role middleware using session 'auth_type')
Route::middleware(['role:college'])->group(function () {
    Route::get('college/home', [CollegeController::class, 'home'])->name('college.home');
    Route::post('/college/update-status', [UserController::class, 'updateStatus'])->name('college.updateStatus');
    Route::get('college/assign', [UserController::class, 'showAssignForm'])->name('college.assign');
    Route::post('/college/assign', [UserController::class, 'store'])->name('assign.store');

    Route::post('/college/user/create-student', [UserController::class, 'createStudent'])->name('user.createStudent');
    Route::post('/college/user/create-supervisor', [UserController::class, 'createSupervisor'])->name('user.createSupervisor');
});

// 🔵 Company Routes
Route::middleware(['role:company'])->group(function () {
    Route::get('/company/profile', [CompanyController::class, 'profile'])->name('company.profile');
    Route::post('/company/profile/save', [CompanyController::class, 'saveProfile'])->name('company.profile.save');

    Route::get('/company/post', [InternshipController::class, 'showPost'])->name('internship.post');
    Route::post('/company/post/save', [InternshipController::class, 'savePost'])->name('internship.post.save');

    Route::get('/company/applications', [CompanyController::class, 'applications'])->name('company.application');
    Route::get('/company/feedback', [CompanyController::class, 'feedback'])->name('company.feedback');
    Route::post('/company/feedback', [CompanyController::class, 'submitFeedback'])->name('company.feedback.submit');
    Route::post('/company/evaluate', [CompanyController::class, 'submitEvaluation'])->name('company.evaluate.submit');
});



// 🟢 Supervisor Routes
Route::middleware(['role:supervisor'])->group(function () {
    // Dashboard
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    
    // Students
    Route::get('/supervisor/students', [SupervisorController::class, 'students'])->name('supervisor.students');
    
    // Reports
    Route::get('/supervisor/reports', [SupervisorController::class, 'reports'])->name('supervisor.reports');
    Route::get('/supervisor/reports/{student}', [SupervisorController::class, 'studentReports'])->name('supervisor.student.reports');
    
    // Applications
    Route::get('/supervisor/applications', [SupervisorController::class, 'applications'])->name('supervisor.applications');
    Route::post('/supervisor/applications/{id}/approve', [SupervisorController::class, 'approveApplication'])->name('supervisor.application.approve');
    
    // Evaluations
    Route::get('/supervisor/evaluations', [SupervisorController::class, 'evaluations'])->name('supervisor.evaluations');
    Route::get('/supervisor/evaluations/{student}', [SupervisorController::class, 'studentEvaluation'])->name('supervisor.student.evaluation');
    
    // Profile
    Route::get('/supervisor/profile', [SupervisorController::class, 'profile'])->name('supervisor.profile');
    Route::post('/supervisor/profile', [SupervisorController::class, 'updateProfile'])->name('supervisor.profile.update');
});
// student routes
Route::middleware(['role:student'])->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student/internships', [InternshipController::class, 'internships'])->name('student.internships');
    Route::get('/student/application', [ApplicationController::class, 'applications'])->name('student.applications');
    Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');

    Route::post('/internship/{id}/apply', [ApplicationController::class, 'store'])
        ->name('internship.apply')
        ->middleware('auth:student');

    // Public route for viewing company profiles

});
