@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-indigo-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1512941937669-90a541b46d4c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Mobile app hero">
            <div class="absolute inset-0 bg-indigo-800 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Download Our Mobile App</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">
                Get instant access to job opportunities, company profiles, and career resources right at your fingertips.
            </p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Why Download Our App?
                </h2>
                <div class="mt-8 space-y-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-900">Instant Job Alerts</h3>
                            <p class="mt-2 text-gray-500">Get notified immediately when new jobs matching your preferences are posted.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-900">Easy Application Process</h3>
                            <p class="mt-2 text-gray-500">Apply to jobs with just a few taps using our streamlined application process.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-900">Offline Access</h3>
                            <p class="mt-2 text-gray-500">Save job listings and company profiles for offline viewing.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 lg:mt-0">
                <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                    <div class="px-6 py-8">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-gray-900">Download Now</h3>
                            <p class="mt-2 text-gray-600">Available on the Google Play Store</p>
                        </div>
                        <div class="mt-8 flex justify-center">
                            <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                <svg class="h-8 w-8 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.523 15.3414c-.5511 0-1.0001.449-1.0001 1s.449 1 1.0001 1c.551 0 1-.449 1-1s-.449-1-1-1zm-11.046 0c-.551 0-1 .449-1 1s.449 1 1 1h1c.551 0 1-.449 1-1v-3.5h-2v2.5zm5.523-8.3414c-3.584 0-6.5 2.916-6.5 6.5 0 3.584 2.916 6.5 6.5 6.5s6.5-2.916 6.5-6.5c0-3.584-2.916-6.5-6.5-6.5zm0 12c-3.032 0-5.5-2.468-5.5-5.5s2.468-5.5 5.5-5.5 5.5 2.468 5.5 5.5-2.468 5.5-5.5 5.5zm0-9.5c-2.206 0-4 1.794-4 4h1c0-1.654 1.346-3 3-3v-1zm0 2c-1.103 0-2 .897-2 2h1c0-.551.449-1 1-1v-1z"/>
                                </svg>
                                Download on Google Play
                            </a>
                        </div>
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-500">Version 1.0.0 • 10MB</p>
                            <p class="mt-2 text-sm text-gray-500">Requires Android 6.0 or higher</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Screenshots Section -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">App Screenshots</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a541b46d4c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="App screenshot 1" class="w-full h-auto">
                </div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a541b46d4c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="App screenshot 2" class="w-full h-auto">
                </div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a541b46d4c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="App screenshot 3" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 