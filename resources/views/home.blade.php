@extends('layouts.app')

@section('content')
<!-- Enhanced Hero Section -->
<div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6bTAgMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTIwIDBjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6bS0yMCAyMGMwLTIuMjEgMS43OS00IDQtNHM0IDEuNzkgNCA0LTEuNzkgNC00IDQtNC0xLjc5LTQtNHptLTIwIDBjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6bTIwIDBjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00eiIvPjwvZz48L2c+PC9zdmc+')]"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
        <div class="text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                Find Your Dream Job
                <span class="block mt-2 text-indigo-200">With Leading Companies</span>
            </h1>
            <p class="mt-6 max-w-lg sm:max-w-xl lg:max-w-2xl mx-auto text-lg sm:text-xl text-indigo-100">
                Discover thousands of job opportunities with all the information you need.
                Your future career starts here.
            </p>
            <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('jobs.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 border border-transparent text-base sm:text-lg font-medium rounded-lg text-indigo-700 bg-white hover:bg-indigo-50 transition duration-150 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-search mr-2 sm:mr-3"></i> Browse Jobs
                </a>
                <a href="{{ route('companies.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 border border-2 border-white text-base sm:text-lg font-medium rounded-lg text-white hover:bg-white hover:text-indigo-700 transition duration-150 ease-in-out">
                    <i class="fas fa-building mr-2 sm:mr-3"></i> Explore Companies
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                        <i class="fas fa-briefcase text-2xl sm:text-3xl text-indigo-600"></i>
                    </div>
                    <div class="ml-4 sm:ml-5">
                        <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $totalJobs }}</div>
                        <div class="mt-1 text-sm sm:text-base font-medium text-gray-500">Available Jobs</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                        <i class="fas fa-building text-2xl sm:text-3xl text-purple-600"></i>
                    </div>
                    <div class="ml-4 sm:ml-5">
                        <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $totalCompanies }}</div>
                        <div class="mt-1 text-sm sm:text-base font-medium text-gray-500">Companies</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3">
                        <i class="fas fa-users text-2xl sm:text-3xl text-pink-600"></i>
                    </div>
                    <div class="ml-4 sm:ml-5">
                        <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $totalUsers }}</div>
                        <div class="mt-1 text-sm sm:text-base font-medium text-gray-500">Active Users</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Jobs Section -->
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 sm:py-16 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Featured Jobs</h2>
                <p class="mt-1 text-base sm:text-lg text-gray-500">Discover your next career opportunity</p>
            </div>
            <a href="{{ route('jobs.index') }}" 
               class="inline-flex items-center px-5 py-2.5 sm:px-6 sm:py-3 border border-transparent rounded-lg shadow-sm text-sm sm:text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 whitespace-nowrap">
                <i class="fas fa-search mr-2"></i>
                Browse All Jobs
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($featuredJobs as $job)
                @if($job->status === 'active' && $job->company && $job->company->status === 'approved')
                    <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden flex flex-col">
                        <!-- New/Featured Tags -->
                        <div class="absolute top-3 right-3 sm:top-4 sm:right-4 flex flex-col gap-1.5 sm:gap-2 z-10">
                            @if($job->created_at->isToday())
                                <span class="inline-flex items-center px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-clock mr-1"></i> New
                                </span>
                            @endif
                            @if($job->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </span>
                            @endif
                        </div>
                        
                        <div class="p-5 sm:p-6 flex-grow">
                            <!-- Company Logo & Job Title -->
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-sm group-hover:shadow">
                                        <i class="fas fa-building text-white text-lg sm:text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200 truncate">
                                        <a href="{{ route('jobs.show', $job) }}">
                                            {{ $job->title }}
                                        </a>
                                    </h3>
                                    <div class="mt-1 flex items-center">
                                        <span class="text-xs sm:text-sm font-medium text-gray-600 truncate">
                                            {{ $job->company->name }}
                                        </span>
                                        @if($job->company->is_verified)
                                            <span class="ml-1.5 inline-flex items-center">
                                                <i class="fas fa-check-circle text-blue-500 text-xs sm:text-sm" title="Verified Company"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Job Details -->
                            <div class="mt-4 grid grid-cols-1 gap-2 sm:gap-3">
                                <div class="flex items-center text-xs sm:text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt text-gray-400 w-4 text-center mr-2"></i>
                                    <span class="truncate">{{ $job->location }}</span>
                                    @if($job->remote_allowed)
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 whitespace-nowrap">
                                            <i class="fas fa-laptop-house mr-1"></i> Remote
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center text-xs sm:text-sm text-gray-500">
                                    <i class="fas fa-briefcase text-gray-400 w-4 text-center mr-2"></i>
                                    <span class="truncate">{{ $job->employment_type }}</span>
                                </div>
                                <div class="flex items-center text-xs sm:text-sm text-gray-500">
                                    <i class="fas fa-user-graduate text-gray-400 w-4 text-center mr-2"></i>
                                    <span class="truncate">{{ $job->experience_level ?: 'Not specified' }}</span>
                                </div>
                            </div>

                            @if($job->salary_range)
                                <div class="mt-4 flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2 sm:px-4 sm:py-3">
                                    <div class="flex items-center text-xs sm:text-sm">
                                        <i class="fas fa-money-bill-wave text-gray-400 mr-2"></i>
                                        <span class="font-medium text-gray-900">{{ $job->salary_range }}</span>
                                    </div>
                                    @if($job->salary_is_negotiable)
                                        <span class="text-xs text-gray-500 whitespace-nowrap">Negotiable</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="bg-gray-50 px-5 sm:px-6 py-3 sm:py-4 border-t border-gray-100 mt-auto">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div class="flex items-center space-x-3 sm:space-x-4">
                                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1 sm:mr-1.5"></i>
                                        {{ $job->created_at->diffForHumans() }}
                                    </div>
                                    @if($job->applications_count)
                                        <div class="flex items-center text-xs sm:text-sm text-gray-500">
                                            <i class="fas fa-users mr-1 sm:mr-1.5"></i>
                                            {{ $job->applications_count }} {{ Str::plural('applicant', $job->applications_count) }}
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('jobs.show', $job) }}" 
                                   class="inline-flex items-center justify-center px-3 py-1.5 sm:px-4 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-lg text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 w-full sm:w-auto whitespace-nowrap">
                                    View Details
                                    <i class="fas fa-arrow-right ml-1.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @if($featuredJobs->isEmpty())
            <div class="text-center py-12 sm:py-16">
                <div class="text-gray-500">
                    <i class="fas fa-briefcase text-3xl sm:text-4xl mb-3 sm:mb-4"></i>
                    <h3 class="text-base sm:text-lg font-medium text-gray-900">No jobs available</h3>
                    <p class="mt-1 text-sm sm:text-base">Check back later for new opportunities</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Categories Section -->
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-12 sm:py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Popular Categories</h2>
            <p class="mt-3 sm:mt-4 text-base sm:text-lg text-gray-500 max-w-xl mx-auto">
                Browse jobs by category to find the perfect match for your skills
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 sm:gap-6">
            @foreach($categories as $category)
                <a href="{{ route('search.index', ['type' => 'jobs', 'department' => $category->department]) }}"
                   class="group bg-white p-5 sm:p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="h-12 w-12 sm:h-14 sm:w-14 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition-colors duration-200">
                            @if($category->icon)
                                <i class="{{ $category->icon }} text-xl sm:text-2xl text-indigo-600"></i>
                            @else
                                <i class="fas {{ match($category->department) {
                                    'Technology' => 'fa-laptop-code',
                                    'Marketing' => 'fa-bullhorn',
                                    'Sales' => 'fa-chart-line',
                                    'Design' => 'fa-pencil-ruler',
                                    'Finance' => 'fa-coins',
                                    'HR' => 'fa-users',
                                    'Engineering' => 'fa-cogs',
                                    'Operations' => 'fa-cog',
                                    default => 'fa-briefcase'
                                } }} text-xl sm:text-2xl text-indigo-600"></i>
                            @endif
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium bg-indigo-100 text-indigo-800">
                            {{ $category->job_count }}
                        </span>
                    </div>
                    <h3 class="text-base sm:text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-200 truncate">
                        {{ $category->department }}
                    </h3>
                    <p class="mt-1.5 sm:mt-2 text-xs sm:text-sm text-gray-500">Browse all {{ $category->department }} jobs</p>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured Companies Section -->
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 sm:py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Featured Companies</h2>
            <p class="mt-3 sm:mt-4 text-base sm:text-lg text-gray-500 max-w-xl mx-auto">
                Discover companies actively hiring on our platform
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 sm:gap-6">
            @foreach($featuredCompanies as $company)
                @if($company->status === 'approved')
                    <a href="{{ route('companies.show', $company) }}"
                       class="group bg-white p-5 sm:p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col items-center">
                        <div class="flex items-center justify-center mb-3 sm:mb-4">
                            <div class="h-16 w-16 sm:h-20 sm:w-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:from-indigo-600 group-hover:to-purple-700 transition-colors duration-200">
                                <i class="fas fa-building text-white text-2xl sm:text-3xl"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="text-base sm:text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors duration-200 truncate">
                                {{ $company->name }}
                            </h3>
                            <div class="mt-2 flex flex-col sm:flex-row items-center justify-center space-y-1 sm:space-y-0 sm:space-x-3 text-xs sm:text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-briefcase mr-1 sm:mr-1.5"></i>
                                    {{ $company->job_postings_count }} {{ Str::plural('job', $company->job_postings_count) }}
                                </span>
                                @if($company->headquarters)
                                    <span class="flex items-center">
                                        <i class="fas fa-map-marker-alt mr-1 sm:mr-1.5"></i>
                                        {{ $company->headquarters }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection 