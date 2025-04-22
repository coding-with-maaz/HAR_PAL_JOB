@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Success Header -->
            <div class="bg-green-50 px-4 py-5 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Application Submitted Successfully!</h3>
                        <p class="mt-1 text-sm text-green-600">Your application has been received and is being processed.</p>
                    </div>
                </div>
            </div>

            <!-- Application Details -->
            <div class="px-4 py-5 sm:p-6">
                <div class="space-y-6">
                    <!-- Job Details -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Job Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Position</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobPosting->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Company</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobPosting->company->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Location</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->jobPosting->location }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Application Date</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application Status -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Application Status</h4>
                        <div class="flex items-center">
                            <span class="flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-yellow-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                            </span>
                            <span class="ml-2 text-sm font-medium text-gray-900">Pending Review</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Your application is currently under review by the employer. You will be notified once a decision has been made.</p>
                    </div>

                    <!-- Next Steps -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Next Steps</h4>
                        <ul class="list-disc list-inside space-y-2 text-sm text-gray-600">
                            <li>Monitor your email for updates on your application status</li>
                            <li>You can view your application status in your dashboard</li>
                            <li>Prepare for potential interviews by reviewing the job requirements</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-4 py-4 sm:px-6 bg-gray-50 flex justify-between">
                <a href="{{ route('jobs.show', $application->jobPosting) }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Job
                </a>
                <a href="{{ route('applications.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    View All Applications
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 