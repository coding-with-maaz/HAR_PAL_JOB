@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Search Section -->
    <div class="bg-indigo-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white sm:text-4xl">Search Results</h1>
                <p class="mt-3 text-xl text-indigo-100">Search for jobs and companies</p>
            </div>
            
            <form action="{{ route('search.index') }}" method="GET" class="mt-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Search Type -->
                    <div class="md:col-span-2">
                        <select name="type" 
                                class="block w-full py-3 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="all" {{ $type === 'all' ? 'selected' : '' }}>All</option>
                            <option value="jobs" {{ $type === 'jobs' ? 'selected' : '' }}>Jobs</option>
                            <option value="companies" {{ $type === 'companies' ? 'selected' : '' }}>Companies</option>
                        </select>
                    </div>

                    <!-- Search Keywords -->
                    <div class="md:col-span-4">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ $searchTerm }}"
                                   class="block w-full pl-10 pr-3 py-3 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="Search jobs, companies, or keywords">
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="md:col-span-3">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="location" 
                                   value="{{ request('location') }}"
                                   class="block w-full pl-10 pr-3 py-3 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="City, state, or remote">
                        </div>
                    </div>

                    <!-- Employment Type (Only show when type is jobs) -->
                    <div class="md:col-span-2 {{ $type !== 'companies' ? '' : 'hidden' }}">
                        <select name="employment_type" 
                                class="block w-full py-3 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Types</option>
                            <option value="full-time" {{ request('employment_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ request('employment_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ request('employment_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ request('employment_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="md:col-span-1">
                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Search
                        </button>
                    </div>
                </div>

                <!-- Additional Filters for Jobs -->
                @if($type !== 'companies')
                <div class="mt-4 flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="posted_today" 
                               id="posted_today" 
                               value="1" 
                               {{ request('posted_today') ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="posted_today" class="ml-2 text-sm text-white">Posted Today</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="easy_apply" 
                               id="easy_apply" 
                               value="1" 
                               {{ request('easy_apply') ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="easy_apply" class="ml-2 text-sm text-white">Easy Apply</label>
                    </div>
                    <div class="flex items-center">
                        <select name="remote" 
                                class="text-sm border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Work Type</option>
                            <option value="remote" {{ request('remote') == 'remote' ? 'selected' : '' }}>Remote Only</option>
                            <option value="hybrid" {{ request('remote') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="onsite" {{ request('remote') == 'onsite' ? 'selected' : '' }}>On-site</option>
                        </select>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Categories Section -->
        @if(isset($categories) && $categories->isNotEmpty() && ($type === 'all' || $type === 'jobs'))
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Popular Categories</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($categories as $category)
                        <a href="{{ route('jobs.category', $category->department) }}" 
                           class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $category->department }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $category->job_count }} jobs available</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Active Filters -->
        @if(request()->anyFilled(['search', 'location', 'employment_type', 'remote', 'posted_today', 'easy_apply', 'industry']))
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Active Filters:</h3>
                <div class="flex flex-wrap gap-2">
                    @if($searchTerm)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Search: {{ $searchTerm }}
                            <a href="{{ request()->except('search') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('location'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Location: {{ request('location') }}
                            <a href="{{ request()->except('location') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('employment_type'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Type: {{ ucfirst(request('employment_type')) }}
                            <a href="{{ request()->except('employment_type') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('remote'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Remote: {{ ucfirst(request('remote')) }}
                            <a href="{{ request()->except('remote') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('posted_today'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Posted Today
                            <a href="{{ request()->except('posted_today') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('easy_apply'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Easy Apply
                            <a href="{{ request()->except('easy_apply') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('industry'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Industry: {{ request('industry') }}
                            <a href="{{ request()->except('industry') }}" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <!-- Results Count and Sort -->
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">
                @if($type === 'all')
                    {{ $jobs->total() + $companies->total() }} Results Found
                @elseif($type === 'jobs')
                    {{ $jobs->total() }} Jobs Found
                @else
                    {{ $companies->total() }} Companies Found
                @endif
            </h2>
            @if($type !== 'companies')
                <div class="flex items-center">
                    <label for="sort" class="mr-2 text-sm text-gray-600">Sort by:</label>
                    <select name="sort" 
                            id="sort" 
                            onchange="window.location.href = this.value"
                            class="text-sm border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" 
                                {{ request('sort') == 'newest' ? 'selected' : '' }}>
                            Newest First
                        </option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'salary']) }}"
                                {{ request('sort') == 'salary' ? 'selected' : '' }}>
                            Salary
                        </option>
                    </select>
                </div>
            @endif
        </div>

        <!-- Job Results -->
        @if($type === 'all' || $type === 'jobs')
            <div class="space-y-6">
                @forelse($jobs as $job)
                    <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-start">
                            @if($job->company && $job->company->logo)
                                <img src="{{ asset('storage/' . $job->company->logo) }}" 
                                     alt="{{ $job->company->name }}" 
                                     class="h-16 w-16 object-contain rounded">
                            @else
                                <div class="h-16 w-16 bg-indigo-100 rounded flex items-center justify-center">
                                    <span class="text-2xl font-bold text-indigo-600">
                                        {{ $job->company ? substr($job->company->name, 0, 1) : '?' }}
                                    </span>
                                </div>
                            @endif

                            <div class="ml-6 flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        <a href="{{ route('jobs.show', $job) }}" class="hover:text-indigo-600">
                                            {{ $job->title }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center space-x-4">
                                        <button class="text-gray-400 hover:text-indigo-600">
                                            <i class="far fa-bookmark"></i>
                                        </button>
                                        <span class="text-sm text-gray-500">
                                            {{ $job->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    @if($job->company)
                                        <a href="{{ route('companies.show', $job->company) }}" 
                                           class="text-gray-700 hover:text-indigo-600">
                                            {{ $job->company->name }}
                                        </a>
                                    @endif
                                </div>

                                <div class="mt-4 flex items-center space-x-4 text-sm text-gray-500">
                                    @if($job->location)
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                            {{ $job->location }}
                                        </div>
                                    @endif
                                    @if($job->employment_type)
                                        <div class="flex items-center">
                                            <i class="fas fa-briefcase mr-2 text-gray-400"></i>
                                            {{ ucfirst($job->employment_type) }}
                                        </div>
                                    @endif
                                    @if($job->salary_min && $job->salary_max)
                                        <div class="flex items-center">
                                            <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                            ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                        </div>
                                    @endif
                                    @if($job->easy_apply)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-bolt mr-1"></i>
                                            Easy Apply
                                        </span>
                                    @endif
                                </div>

                                @if($job->formatted_skills_required)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-700">Required Skills:</h4>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach($job->formatted_skills_required as $skill)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $skill }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($job->formatted_benefits)
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        @foreach($job->formatted_benefits as $benefit)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ $benefit }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    @if($type === 'jobs')
                        <div class="text-center py-12">
                            <div class="text-gray-500">
                                <i class="fas fa-search text-4xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900">No jobs found</h3>
                                <p class="mt-1">Try adjusting your search filters or explore other categories</p>
                            </div>
                        </div>
                    @endif
                @endforelse

                @if($jobs->isNotEmpty())
                    <div class="mt-8">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        @endif

        <!-- Company Results -->
        @if($type === 'all' || $type === 'companies')
            <div class="space-y-6 {{ $type === 'all' && $jobs->isNotEmpty() ? 'mt-12' : '' }}">
                @if($type === 'all' && $jobs->isNotEmpty())
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Companies</h2>
                @endif

                @forelse($companies as $company)
                    <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-start">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" 
                                     alt="{{ $company->name }}" 
                                     class="h-16 w-16 object-contain rounded">
                            @else
                                <div class="h-16 w-16 bg-indigo-100 rounded flex items-center justify-center">
                                    <span class="text-2xl font-bold text-indigo-600">
                                        {{ substr($company->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif

                            <div class="ml-6 flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        <a href="{{ route('companies.show', $company) }}" class="hover:text-indigo-600">
                                            {{ $company->name }}
                                        </a>
                                    </h3>
                                    <span class="text-sm text-gray-500">
                                        {{ $company->job_postings_count }} active jobs
                                    </span>
                                </div>

                                @if($company->industry)
                                    <div class="mt-2 text-sm text-gray-600">
                                        <i class="fas fa-industry mr-2"></i>
                                        {{ $company->industry }}
                                    </div>
                                @endif

                                @if($company->description)
                                    <p class="mt-4 text-gray-600">
                                        {{ Str::limit($company->description, 200) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    @if($type === 'companies')
                        <div class="text-center py-12">
                            <div class="text-gray-500">
                                <i class="fas fa-building text-4xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900">No companies found</h3>
                                <p class="mt-1">Try adjusting your search criteria</p>
                            </div>
                        </div>
                    @endif
                @endforelse

                @if($companies->isNotEmpty())
                    <div class="mt-8">
                        {{ $companies->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection 