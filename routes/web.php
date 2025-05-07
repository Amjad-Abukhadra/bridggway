<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;


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

// ✅ College Routes (protected by role middleware using session 'auth_type')
Route::middleware(['role:college'])->group(function () {
    Route::get('/home', [CollegeController::class, 'home'])->name('college.home');
    Route::post('/college/update-status', [UserController::class, 'updateStatus'])->name('college.updateStatus');
    Route::get('/assign', [UserController::class, 'showAssignForm'])->name('college.assign');
    Route::post('/college/assign', [UserController::class, 'store'])->name('assign.store');

    Route::post('/college/user/create-student', [UserController::class, 'createStudent'])->name('user.createStudent');
    Route::post('/college/user/create-supervisor', [UserController::class, 'createSupervisor'])->name('user.createSupervisor');
});

// 🔵 Company Routes
Route::middleware(['role:company'])->group(function () {
    Route::get('/company/profile', [CompanyController::class, 'profile'])->name('company.profile'); // ✅ ADD THIS
    Route::post('/company/profile/save', [CompanyController::class, 'saveProfile'])->name('company.profile.save');

    Route::get('/company/post', [InternshipController::class, 'showPost'])->name('internship.post');
    Route::post('/company/post/save', [InternshipController::class, 'savePost'])->name('internship.post.save');

    Route::get('/company/applications', [CompanyController::class, 'application'])->name('company.application');
    Route::get('/company/feedback', [CompanyController::class, 'feedback'])->name('company.feedback');
});



// 🟢 Supervisor Routes
Route::middleware(['role:supervisor'])->group(function () {
    Route::get('/supervisor/dashboard', [UserController::class, 'supervisorDashboard'])->name('supervisor.dashboard');
    // Add more supervisor routes as needed
});
// student routes
Route::middleware(['role:student'])->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student/internships', [StudentController::class, 'internships'])->name('student.internships');
    Route::get('/student/application', [StudentController::class, 'applications'])->name('student.applications');
    Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');

});
