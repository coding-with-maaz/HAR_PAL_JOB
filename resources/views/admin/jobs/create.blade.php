@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Create New Job</h1>
            <p class="mt-2 text-sm text-gray-600">Fill in the details below to create a new job posting.</p>
        </div>
        <a href="{{ route('admin.jobs.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-200 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Jobs
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8 rounded-md">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-red-800 font-medium">Please correct the following errors:</h3>
            </div>
            <ul class="ml-5 list-disc text-sm text-red-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">Job Details</h2>
            <p class="text-sm text-gray-600">* Required fields</p>
        </div>

        <form action="{{ route('admin.jobs.store') }}" method="POST" class="p-6 space-y-8">
            @csrf
            
            <!-- Basic Information Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Selection -->
                    <div>
                        <label for="company_id" class="block text-sm font-medium text-gray-700 required-field">Company *</label>
                        <div class="mt-1">
                            <select name="company_id" id="company_id" required 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Job Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 required-field">Job Title *</label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="e.g., Senior Software Engineer">
                        </div>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 required-field">Location *</label>
                        <div class="mt-1">
                            <input type="text" name="location" id="location" value="{{ old('location') }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="e.g., New York, NY">
                        </div>
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                        <div class="mt-1">
                            <input type="text" name="department" id="department" value="{{ old('department') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="e.g., Engineering">
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 required-field">Category *</label>
                        <div class="mt-1">
                            <select name="category_id" id="category_id" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Details Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Job Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Employment Type -->
                    <div>
                        <label for="employment_type" class="block text-sm font-medium text-gray-700 required-field">Employment Type *</label>
                        <div class="mt-1">
                            <select name="employment_type" id="employment_type" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="full-time" {{ old('employment_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                <option value="part-time" {{ old('employment_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="temporary" {{ old('employment_type') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label for="experience_level" class="block text-sm font-medium text-gray-700 required-field">Experience Level *</label>
                        <div class="mt-1">
                            <select name="experience_level" id="experience_level" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="mid-level" {{ old('experience_level') == 'mid-level' ? 'selected' : '' }}>Mid Level</option>
                                <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                                <option value="executive" {{ old('experience_level') == 'executive' ? 'selected' : '' }}>Executive Level</option>
                            </select>
                        </div>
                    </div>

                    <!-- Salary Range -->
                    <div>
                        <label for="salary_range" class="block text-sm font-medium text-gray-700">Salary Range</label>
                        <div class="mt-1">
                            <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="e.g. 50000-75000 (numbers only, no currency symbols)">
                        </div>
                    </div>

                    <!-- Application Deadline -->
                    <div>
                        <label for="application_deadline" class="block text-sm font-medium text-gray-700">Application Deadline</label>
                        <div class="mt-1">
                            <input type="date" name="application_deadline" id="application_deadline" value="{{ old('application_deadline') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Job Description & Requirements</h3>
                
                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 required-field">Job Description *</label>
                    <p class="mt-1 text-sm text-gray-500">Provide a detailed description of the job role and its responsibilities.</p>
                    <div class="mt-2">
                        <textarea name="description" id="description" rows="4" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Requirements -->
                <div class="mb-6">
                    <label for="requirements" class="block text-sm font-medium text-gray-700">Requirements</label>
                    <p class="mt-1 text-sm text-gray-500">List the key requirements for this position (separate with commas)</p>
                    <div class="mt-2">
                        <textarea name="requirements" id="requirements" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="e.g., 5+ years experience, Bachelor's degree, Strong communication skills">{{ old('requirements') }}</textarea>
                    </div>
                </div>

                <!-- Responsibilities -->
                <div class="mb-6">
                    <label for="responsibilities" class="block text-sm font-medium text-gray-700 required-field">Responsibilities *</label>
                    <p class="mt-1 text-sm text-gray-500">Detail the key responsibilities of this position</p>
                    <div class="mt-2">
                        <textarea name="responsibilities" id="responsibilities" rows="4" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('responsibilities') }}</textarea>
                    </div>
                </div>

                <!-- Skills Required -->
                <div class="mb-6">
                    <label for="skills_required" class="block text-sm font-medium text-gray-700 required-field">Skills Required *</label>
                    <p class="mt-1 text-sm text-gray-500">List the required skills and qualifications (separate with commas)</p>
                    <div class="mt-2">
                        <textarea name="skills_required" id="skills_required" rows="3" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="e.g., PHP, Laravel, MySQL, JavaScript">{{ old('skills_required') }}</textarea>
                    </div>
                </div>

                <!-- Benefits -->
                <div>
                    <label for="benefits" class="block text-sm font-medium text-gray-700 required-field">Benefits *</label>
                    <p class="mt-1 text-sm text-gray-500">List the benefits offered with this position (separate with commas)</p>
                    <div class="mt-2">
                        <textarea name="benefits" id="benefits" rows="3" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="e.g., Health insurance, 401(k), Flexible hours">{{ old('benefits') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Job Settings -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Job Settings</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_remote" id="is_remote" value="1" {{ old('is_remote') ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_remote" class="ml-3">
                            <span class="block text-sm font-medium text-gray-700">Remote Work Available</span>
                            <span class="block text-sm text-gray-500">Check if this position allows remote work</span>
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-3">
                            <span class="block text-sm font-medium text-gray-700">Featured Job</span>
                            <span class="block text-sm text-gray-500">Featured jobs appear prominently in search results</span>
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-3">
                            <span class="block text-sm font-medium text-gray-700">Active Job Posting</span>
                            <span class="block text-sm text-gray-500">Inactive jobs won't appear in search results</span>
                        </label>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 required-field">Status *</label>
                        <div class="mt-1">
                            <select name="status" id="status" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <button type="button" onclick="window.location.href='{{ route('admin.jobs.index') }}'"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Job
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .required-field::after {
        content: " *";
        color: #EF4444;
    }
</style>
@endsection 