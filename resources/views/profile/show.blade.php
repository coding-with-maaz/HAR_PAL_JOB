<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-edit mr-2"></i> Edit Profile
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Profile Header with Background -->
                <div class="relative h-48 bg-gradient-to-r from-indigo-500 to-purple-600">
                    <div class="absolute -bottom-16 left-8">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full bg-white p-1 shadow-lg">
                                <div class="w-full h-full rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                    <span class="text-5xl font-bold text-indigo-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                            </div>
                            <div class="absolute -top-2 -right-2 flex space-x-1">
                                @if($user->hasRole('admin'))
                                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                        Admin
                                    </span>
                                @endif
                                @if($user->hasRole('employer'))
                                    <span class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                        Employer
                                    </span>
                                @endif
                                @if(!$user->hasRole('admin') && !$user->hasRole('employer'))
                                    <span class="bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                        User
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="pt-20 pb-6 px-8">
                    <!-- User Info -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                            <p class="text-gray-600">{{ $user->email }}</p>
                        </div>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                            <p class="text-sm text-gray-500">
                                Member since {{ $user->created_at->format('F Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Statistics Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl shadow-sm border border-blue-100 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600 shadow-sm">
                                    <i class="fas fa-briefcase text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $user->jobApplications ? $user->jobApplications->count() : 0 }}</h3>
                                    <p class="text-sm text-gray-600">Job Applications</p>
                                </div>
                            </div>
                        </div>

                        @if($user->hasRole('employer') && $user->company)
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl shadow-sm border border-green-100 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600 shadow-sm">
                                    <i class="fas fa-clipboard-list text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $user->company->jobs()->where('is_active', true)->count() }}</h3>
                                    <p class="text-sm text-gray-600">Active Jobs</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-xl shadow-sm border border-purple-100 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600 shadow-sm">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $user->company->jobs()->with('applications')->get()->sum(function($job) { return $job->applications->count(); }) }}</h3>
                                    <p class="text-sm text-gray-600">Total Applications</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl shadow-sm border border-green-100 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600 shadow-sm">
                                    <i class="fas fa-calendar-check text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $user->created_at->diffForHumans() }}</h3>
                                    <p class="text-sm text-gray-600">Account Age</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Recent Activity Section -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-history text-indigo-500 mr-2"></i> Recent Activity
                        </h3>
                        <div class="space-y-4">
                            @if($user->jobApplications && $user->jobApplications->count() > 0)
                                <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-blue-100 hover:shadow-md transition-shadow duration-300">
                                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 shadow-sm">
                                        <i class="fas fa-paper-plane"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Applied for {{ $user->jobApplications->last()->jobPosting->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->jobApplications->last()->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($user->hasRole('employer') && $user->company && $user->company->jobs()->count() > 0)
                                <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl shadow-sm border border-green-100 hover:shadow-md transition-shadow duration-300">
                                    <div class="p-3 rounded-full bg-green-100 text-green-600 shadow-sm">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Posted job: {{ $user->company->jobs()->latest()->first()->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->company->jobs()->latest()->first()->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl shadow-sm border border-purple-100 hover:shadow-md transition-shadow duration-300">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600 shadow-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Joined {{ config('app.name') }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 