<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Protected Routes - Only after login
Route::middleware(['auth'])->group(function () {
    
    // College Dashboard
    Route::get('/home', [UserController::class, 'dashboard'])->name('home');

    // College Admin creates users
    Route::post('/user/create-student', [UserController::class, 'createStudent'])->name('user.createStudent');
    Route::post('/user/create-company', [UserController::class, 'createCompany'])->name('user.createCompany');
    Route::post('/user/create-supervisor', [UserController::class, 'createSupervisor'])->name('user.createSupervisor');

    // Company Profile Management
    Route::get('/profile', [CompanyController::class, 'showProfile'])->name('company.profile'); // Show profile form
    Route::post('/profile/save', [CompanyController::class, 'saveProfile'])->name('company.profile.save'); // Save profile form

    // Company Internship Management
    Route::get('/post', [InternshipController::class, 'showPost'])->name('internship.post'); // Show internship post form
    Route::post('/post/save', [InternshipController::class, 'savePost'])->name('internship.post.save'); // Save internship post
});
