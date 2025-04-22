@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Application Details</h1>
        <div>
            <a href="{{ route('admin.applications.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Back to Applications
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Job Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Job Title</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->jobPosting->title }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Company</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->jobPosting->company->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Location</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->jobPosting->location }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Employment Type</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($application->jobPosting->employment_type) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Applicant Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Applicant Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->applicant->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->applicant->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Applied On</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Details -->
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Application Details</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status</label>
                        <p class="mt-1">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($application->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                    'bg-red-100 text-red-800') }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Cover Letter</label>
                        <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-900 whitespace-pre-line">{{ $application->cover_letter }}</p>
                        </div>
                    </div>
                    @if($application->resume_path)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Resume</label>
                            <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="mt-1 text-sm text-indigo-600 hover:text-indigo-900">
                                View Resume
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-end space-x-4">
                <form action="{{ route('admin.applications.destroy', $application) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this application?')">
                        Delete Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 