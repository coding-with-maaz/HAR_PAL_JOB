<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteSettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApplicationController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Job Routes
Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', [JobPostingController::class, 'index'])->name('index');
    Route::get('/create', [JobPostingController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/', [JobPostingController::class, 'store'])->name('store')->middleware('auth');
    Route::get('/category/{department}', [JobPostingController::class, 'categoryJobs'])->name('category');
    Route::get('/{jobPosting}', [JobPostingController::class, 'show'])->name('show');
    Route::get('/{jobPosting}/edit', [JobPostingController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/{jobPosting}', [JobPostingController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/{jobPosting}', [JobPostingController::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{department}', [CategoryController::class, 'show'])->name('categories.show');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{tag:slug}', [BlogController::class, 'tag'])->name('blog.tag');

// Employer Dashboard Routes
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Employer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\Employer\DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Employer\DashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Job Posting Routes
    Route::resource('jobs', App\Http\Controllers\Employer\JobPostingController::class);
    Route::patch('jobs/{job}/toggle', [App\Http\Controllers\Employer\JobPostingController::class, 'toggle'])->name('jobs.toggle');
    
    // Company Profile Routes
    Route::resource('company', App\Http\Controllers\Employer\CompanyController::class);
    
    // Application Management Routes
    Route::get('applications', [App\Http\Controllers\Employer\ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [App\Http\Controllers\Employer\ApplicationController::class, 'show'])->name('applications.show');
    Route::post('applications/{application}/update-status', [App\Http\Controllers\Employer\ApplicationController::class, 'updateStatus'])->name('applications.update-status');
});

Route::middleware(['auth'])->group(function () {
    // Job Posting Management
    Route::get('/jobs/create', [JobPostingController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobPostingController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{jobPosting}/edit', [JobPostingController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{jobPosting}', [JobPostingController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{jobPosting}', [JobPostingController::class, 'destroy'])->name('jobs.destroy');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job Application
    Route::get('/jobs/{jobPosting:slug}/apply', [JobApplicationController::class, 'create'])->name('jobs.apply');
    Route::post('/jobs/{jobPosting:slug}/apply', [JobApplicationController::class, 'store'])->name('jobs.submit-application');
    Route::get('/applications/{jobApplication}/resume', [JobApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    Route::get('/applications/{application}/success', [JobApplicationController::class, 'success'])->name('applications.success');

    // Company Management
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    // Admin Routes
    Route::middleware([\App\Http\Middleware\CheckRole::class.':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Users Management
        Route::resource('users', UserController::class);
        
        // Companies Management
        Route::resource('companies', CompanyController::class);
        Route::patch('companies/{company}/approve', [App\Http\Controllers\Admin\CompanyController::class, 'approve'])->name('companies.approve');
        Route::patch('companies/{company}/reject', [App\Http\Controllers\Admin\CompanyController::class, 'reject'])->name('companies.reject');
        
        // Jobs Management
        Route::resource('jobs', App\Http\Controllers\Admin\JobController::class);
        Route::patch('jobs/{job}/toggle', [App\Http\Controllers\Admin\JobController::class, 'toggle'])->name('jobs.toggle');
        
        // Categories Management
        Route::resource('categories', CategoryController::class);

        // Applications Management
        Route::resource('applications', ApplicationController::class);
    });

    // Admin Website Settings Routes
    Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/settings', [WebsiteSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [WebsiteSettingsController::class, 'update'])->name('settings.update');
    });
});

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

Route::get('/mobile-app', function () {
    return view('mobile-app');
})->name('mobile-app');

Route::get('/check-role', function () {
    if (auth()->check()) {
        $user = auth()->user();
        dd([
            'authenticated' => true,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->roles->pluck('slug')->toArray(),
            'has_admin_role' => $user->hasRole('admin')
        ]);
    }
    return 'Not authenticated';
})->middleware('auth');
