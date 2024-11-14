<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobCandidateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        Route::middleware('can:apply job')->group(function() {
            Route::get('my-applications', [DashboardController::class, 'my-applications'])->name('my.applications');
            Route::get('my-applications/{job_candidate}', [DashboardController::class, 'my_application_details'])->name('my.application.details');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::middleware('can:manage categories')->group(function () {
            Route::resource('categories', CategoryController::class);
        });

        Route::middleware('can:manage company')->group(function () {
            Route::resource('company', CompanyController::class);
        });
        
        Route::middleware('can:manage jobs')->group(function () {
            Route::resource('company_jobs', CompanyJobController::class);
        });
        
        Route::middleware('can:manage applicants')->group(function () {
            Route::resource('job_candidates', JobCandidateController::class);
            Route::get('/candidate/{job_candidate}/resume/download', [JobCandidateController::class, 
            'download_file'])->name('download_resume');
        });
        

    });

});

require __DIR__.'/auth.php';
