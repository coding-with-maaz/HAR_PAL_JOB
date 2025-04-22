@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="text-center mb-10 sm:mb-12">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">Browse Job Categories</h1>
                <p class="mt-3 text-lg sm:text-xl text-indigo-100">Find jobs by department or field</p>
            </div>
            
            <!-- Search Form (Simplified for categories) -->
            <div class="mt-8 max-w-3xl mx-auto bg-white rounded-lg shadow-xl p-6 sm:p-8">
                <form action="{{ route('search.index') }}" method="GET" class="space-y-4">
                    <input type="hidden" name="type" value="jobs">
                    
                    <div>
                        <label for="department-search" class="block text-sm font-medium text-gray-700 mb-1">Search Categories or Keywords</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="search"
                                   id="department-search"
                                   value="{{ request('search') }}"
                                   class="block w-full pl-10 pr-3 py-2.5 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="e.g., Software Engineer, Marketing Manager, Design">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200 flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <i class="fas fa-search mr-2"></i>
                            Search Jobs
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('search.index', ['type' => 'jobs', 'department' => $category->department]) }}" 
                   class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden flex flex-col p-6 hover:border-indigo-300 border border-transparent">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 rounded-lg flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100 group-hover:from-indigo-200 group-hover:to-purple-200 transition-all duration-200">
                            <i class="fas {{ 
                                match(strtolower($category->department)) {
                                    'technology' => 'fa-laptop-code',
                                    'it' => 'fa-microchip',
                                    'software' => 'fa-code',
                                    'development' => 'fa-code',
                                    'marketing' => 'fa-bullhorn',
                                    'sales' => 'fa-chart-line',
                                    'customer service' => 'fa-headset',
                                    'support' => 'fa-life-ring',
                                    'finance' => 'fa-coins',
                                    'accounting' => 'fa-calculator',
                                    'human resources' => 'fa-users',
                                    'hr' => 'fa-users',
                                    'administration' => 'fa-tasks',
                                    'legal' => 'fa-balance-scale',
                                    'education' => 'fa-graduation-cap',
                                    'healthcare' => 'fa-heartbeat',
                                    'medical' => 'fa-hospital',
                                    'design' => 'fa-pencil-ruler',
                                    'creative' => 'fa-paint-brush',
                                    'engineering' => 'fa-cogs',
                                    'manufacturing' => 'fa-industry',
                                    'operations' => 'fa-cog',
                                    'project management' => 'fa-clipboard-list',
                                    'research' => 'fa-microscope',
                                    'writing' => 'fa-pen',
                                    'content' => 'fa-file-alt',
                                    'data' => 'fa-database',
                                    'analytics' => 'fa-chart-bar',
                                    'security' => 'fa-shield-alt',
                                    'consulting' => 'fa-comments',
                                    'real estate' => 'fa-home',
                                    'construction' => 'fa-hard-hat',
                                    'hospitality' => 'fa-concierge-bell',
                                    'retail' => 'fa-shopping-cart',
                                    'transportation' => 'fa-truck',
                                    'logistics' => 'fa-shipping-fast',
                                    default => 'fa-briefcase'
                                }
                            }} text-2xl text-indigo-600"></i>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            {{ $category->job_count }} {{ Str::plural('job', $category->job_count) }}
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors duration-200 flex-grow">{{ $category->department }}</h3>
                    <p class="text-sm text-indigo-600 group-hover:text-indigo-700 font-medium mt-auto pt-2 inline-flex items-center">
                        View Jobs <i class="fas fa-arrow-right ml-1.5 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </p>
                </a>
            @empty
                 <div class="col-span-full text-center py-16 bg-white rounded-lg shadow">
                    <div class="text-gray-500">
                        <div class="w-16 h-16 mx-auto rounded-full bg-indigo-50 flex items-center justify-center mb-4">
                            <i class="fas fa-layer-group text-3xl text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900">No categories found</h3>
                        <p class="mt-2 text-base">Please check back later or contact support.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 