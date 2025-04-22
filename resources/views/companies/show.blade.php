@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Company Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10">
            <div class="px-6 py-8 sm:px-10 sm:py-12">
                <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <div class="h-24 w-24 sm:h-32 sm:w-32 rounded-lg bg-gradient-to-br {{ $logoGradient }} flex items-center justify-center shadow-md">
                            @if($company->logo_url && !Str::startsWith($company->logo_url, 'data:image/svg+xml'))
                                <img src="{{ $company->logo_url }}" alt="{{ $company->name }} Logo" class="h-full w-full object-contain rounded-lg p-2">
                            @else
                                <!-- Fallback for SVG or missing logo -->
                                <span class="text-4xl sm:text-5xl font-bold text-white">{{ strtoupper(substr($company->name, 0, 1)) }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Details -->
                    <div class="flex-1 min-w-0">
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 truncate flex items-center gap-2">
                            {{ $company->name }}
                            @if($company->is_verified)
                                <i class="fas fa-check-circle text-blue-500 text-xl sm:text-2xl" title="Verified Company"></i>
                            @endif
                        </h1>
                        @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer"
                           class="mt-2 inline-flex items-center text-base text-indigo-600 hover:text-indigo-800 transition-colors duration-200 group">
                            <i class="fas fa-globe mr-1.5 text-gray-400 group-hover:text-indigo-600"></i>
                            {{ $company->website }}
                            <i class="fas fa-external-link-alt ml-1.5 text-xs text-gray-400 group-hover:text-indigo-500"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($company->social_links)
            <div class="mt-4 flex space-x-4">
                @if(isset($company->social_links['linkedin']))
                    <a href="{{ $company->social_links['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition-colors duration-200">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>
                @endif
                @if(isset($company->social_links['twitter']))
                    <a href="{{ $company->social_links['twitter'] }}" target="_blank" class="text-gray-400 hover:text-blue-400 transition-colors duration-200">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                @endif
                @if(isset($company->social_links['facebook']))
                    <a href="{{ $company->social_links['facebook'] }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition-colors duration-200">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                @endif
            </div>
        @endif

        <!-- Company Info -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">About {{ $company->name }}</h2>
            <div class="prose max-w-none">
                {!! nl2br(e($company->description)) !!}
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($company->industry)
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                            <i class="fas fa-industry text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Industry</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $company->industry }}</p>
                        </div>
                    </div>
                @endif

                @if($company->company_size)
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Company Size</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $company->company_size }}</p>
                        </div>
                    </div>
                @endif

                @if($company->founded_year)
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Founded</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $company->founded_year }}</p>
                        </div>
                    </div>
                @endif

                @if($company->headquarters)
                    <div class="flex items-start">
                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Headquarters</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $company->headquarters }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Active Job Postings -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-briefcase text-indigo-600 mr-2"></i>
                    Active Job Postings
                </h2>
                <span class="text-sm text-gray-500 flex items-center">
                    <i class="fas fa-hashtag mr-1"></i>
                    {{ $company->active_jobs_count }} jobs
                </span>
            </div>

            @if($company->jobs->isEmpty())
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-briefcase text-4xl"></i>
                    </div>
                    <p class="text-gray-500">No active job postings at the moment.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($company->jobs as $job)
                        <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                            <h3 class="text-lg font-medium">
                                <a href="{{ route('jobs.show', $job) }}" class="text-indigo-600 hover:text-indigo-800">
                                    {{ $job->title }}
                                </a>
                            </h3>
                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                <span class="flex items-center">
                                    <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                                        <i class="fas fa-map-marker-alt text-blue-600 text-xs"></i>
                                    </div>
                                    {{ $job->location }}
                                </span>
                                @if($job->remote_allowed)
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center text-green-600">
                                        <div class="h-6 w-6 rounded-full bg-green-100 flex items-center justify-center mr-2">
                                            <i class="fas fa-laptop-house text-green-600 text-xs"></i>
                                        </div>
                                        Remote
                                    </span>
                                @endif
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <div class="h-6 w-6 rounded-full bg-indigo-100 flex items-center justify-center mr-2">
                                        <i class="fas fa-clock text-indigo-600 text-xs"></i>
                                    </div>
                                    {{ $job->employment_type }}
                                </span>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <div class="flex space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 flex items-center">
                                        <i class="fas fa-user-graduate mr-1"></i>
                                        {{ $job->experience_level }}
                                    </span>
                                    @if($job->department)
                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 flex items-center">
                                            <i class="fas fa-building mr-1"></i>
                                            {{ $job->department }}
                                        </span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500 flex items-center">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $job->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 