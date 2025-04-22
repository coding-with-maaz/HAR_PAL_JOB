@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Apply for: {{ $jobPosting->title }}</h1>
                <div class="mt-2 text-gray-500">
                    {{ $jobPosting->company->name }} • {{ $jobPosting->location }}
                </div>
                @if($jobPosting->application_deadline)
                    <div class="mt-2 text-sm text-gray-500">
                        Application Deadline: {{ $jobPosting->application_deadline->format('F j, Y') }}
                    </div>
                @endif
            </div>

            <form action="{{ route('jobs.submit-application', $jobPosting) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Contact Information -->
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h2>
                    <div class="space-y-4">
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter your phone number">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Resume Upload -->
                <div>
                    <label for="resume" class="block text-sm font-medium text-gray-700">Resume *</label>
                    <div class="mt-1">
                        <input type="file" name="resume" id="resume" required
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                               accept=".pdf,.doc,.docx">
                    </div>
                    <p class="mt-1 text-sm text-gray-500">PDF, DOC, or DOCX up to 2MB</p>
                    @error('resume')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @push('scripts')
                <script>
                    function validateFile(input) {
                        const fileError = document.getElementById('fileError');
                        const file = input.files[0];
                        
                        if (file) {
                            // Check file size (2MB)
                            if (file.size > 2 * 1024 * 1024) {
                                fileError.textContent = 'File size must be less than 2MB';
                                fileError.classList.remove('hidden');
                                input.value = '';
                                return;
                            }
                            
                            // Check file type
                            const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                            if (!validTypes.includes(file.type)) {
                                fileError.textContent = 'Please upload a PDF, DOC, or DOCX file';
                                fileError.classList.remove('hidden');
                                input.value = '';
                                return;
                            }
                            
                            fileError.classList.add('hidden');
                        }
                    }
                </script>
                @endpush

                <!-- Cover Letter -->
                <div>
                    <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover Letter *</label>
                    <div class="mt-1">
                        <textarea name="cover_letter" id="cover_letter" rows="6" required
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Write a cover letter explaining why you are a good fit for this position...">{{ old('cover_letter') }}</textarea>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Minimum 50 characters</p>
                    @error('cover_letter')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Questions -->
                @if($jobPosting->additional_questions)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Additional Questions</label>
                        <div class="mt-4 space-y-4">
                            @foreach(json_decode($jobPosting->additional_questions) as $index => $question)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $question }}</label>
                                    <div class="mt-1">
                                        <textarea name="additional_questions[{{ $index }}]" rows="3"
                                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                  required>{{ old("additional_questions.$index") }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="{{ route('jobs.show', $jobPosting) }}" 
                       class="mr-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 