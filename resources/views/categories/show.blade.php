@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-indigo-600">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                {{ $department }} Jobs
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-indigo-100">
                {{ $jobCount }} {{ Str::plural('job', $jobCount) }} available in {{ $department }}
            </p>
        </div>
    </div>
</div>

<!-- Jobs List -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($jobs as $job)
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        @if($job->company->logo)
                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="h-12 w-12 rounded-full object-cover">
                        @else
                            <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-building text-gray-400 text-xl"></i>
                            </div>
                        @endif
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                <a href="{{ route('jobs.show', $job) }}" class="hover:text-indigo-600">
                                    {{ $job->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500">{{ $job->company->name }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $job->location }}</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="fas fa-briefcase mr-2"></i>
                            <span>{{ $job->employment_type }}</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock mr-2"></i>
                            <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
</div>
@endsection 