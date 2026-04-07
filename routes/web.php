<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AlumniDirectoryController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\NewsEventController;
use App\Http\Controllers\AdministrativeController;
use App\Http\Controllers\StudentServicesController;
use App\Http\Controllers\MentorshipController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Directory & News Routes
    Route::get('/alumni', [AlumniDirectoryController::class, 'index'])->name('alumni.index');
    Route::get('/news', [NewsEventController::class, 'index'])->name('news.index');

    // Job Portal Routes
    Route::get('/jobs', [JobPostingController::class, 'index'])->name('jobs.index');
    Route::delete('/jobs/{jobPosting}', [JobPostingController::class, 'destroy'])->name('jobs.destroy');

    // Mentorship Actions
    Route::post('/alumni/{alumni}/mentor', [MentorshipController::class, 'store'])->name('alumni.mentor.request');
    Route::get('/mentorship', [MentorshipController::class, 'index'])->name('mentorship.index');
    Route::patch('/mentorship/{mentorshipRequest}', [MentorshipController::class, 'update'])->name('mentorship.update');

    // Student Services (Results & File Status)
    Route::get('/my-services', [StudentServicesController::class, 'index'])->name('student.services');
    Route::get('/files/{file}/download', [StudentServicesController::class, 'downloadFile'])->name('files.download');

    // Alumni-only Job posting
    Route::middleware(['verified_alumni'])->group(function () {
        Route::get('/jobs/create', [JobPostingController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobPostingController::class, 'store'])->name('jobs.store');
    });

    // Admin-only Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/users/{user}/verify', [AdminController::class, 'verify'])->name('users.verify');
        
        // News Management
        Route::get('/news/create', [NewsEventController::class, 'create'])->name('news.create');
        Route::post('/news', [NewsEventController::class, 'store'])->name('news.store');
        Route::delete('/news/{newsEvent}', [NewsEventController::class, 'destroy'])->name('news.destroy');

        // File Tracking
        Route::get('/files', [AdministrativeController::class, 'indexFiles'])->name('files.index');
        Route::get('/files/create', [AdministrativeController::class, 'createFile'])->name('files.create');
        Route::post('/files', [AdministrativeController::class, 'storeFile'])->name('files.store');
        Route::patch('/files/{file}', [AdministrativeController::class, 'updateFile'])->name('files.update');

        // Exam Results
        Route::get('/results', [AdministrativeController::class, 'indexResults'])->name('results.index');
        Route::get('/results/create', [AdministrativeController::class, 'createResult'])->name('results.create');
        Route::post('/results', [AdministrativeController::class, 'storeResult'])->name('results.store');
    });

    // Alumni Pending Route
    Route::get('/alumni/pending', function () {
        return view('alumni.pending');
    })->name('alumni.pending');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
