@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('employer.applications.index') }}" class="text-indigo-600 hover:text-indigo-900">
            ← Back to Applications
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $application->jobPosting->title }}</h1>
                    <p class="text-gray-600">Applied by {{ $application->applicant?->name ?? 'Unknown Applicant' }}</p>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'reviewed') bg-blue-100 text-blue-800
                        @elseif($application->status === 'shortlisted') bg-green-100 text-green-800
                        @elseif($application->status === 'rejected') bg-red-100 text-red-800
                        @elseif($application->status === 'hired') bg-purple-100 text-purple-800
                        @endif">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Applicant Information</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="mb-2"><span class="font-medium">Name:</span> {{ $application->applicant?->name ?? 'Unknown Applicant' }}</p>
                        <p class="mb-2"><span class="font-medium">Email:</span> {{ $application->applicant?->email ?? 'No email provided' }}</p>
                        <p class="mb-2"><span class="font-medium">Phone:</span> {{ $application->phone ?? 'Not provided' }}</p>
                        <p class="mb-2"><span class="font-medium">Applied Date:</span> {{ $application->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Application Details</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="mb-2"><span class="font-medium">Cover Letter:</span></p>
                        <p class="text-gray-700">{{ $application->cover_letter ?? 'No cover letter provided' }}</p>
                    </div>
                </div>
            </div>

            @if($application->resume_path)
                <div class="mt-6">
                    <a href="{{ route('applications.download-resume', $application) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Download Resume
                    </a>
                </div>
            @endif

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Update Application Status</h2>
                <form action="{{ route('employer.applications.update-status', $application) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewed" {{ $application->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                        <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hired</option>
                    </select>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 