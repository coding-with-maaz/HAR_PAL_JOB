<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $websiteSettings->meta_title ?? config('app.name', 'Laravel') }}</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="{{ $websiteSettings->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $websiteSettings->meta_keywords ?? '' }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $websiteSettings->meta_title ?? config('app.name', 'Laravel') }}">
    <meta property="og:description" content="{{ $websiteSettings->meta_description ?? '' }}">
    @if(isset($websiteSettings->og_image))
        <meta property="og:image" content="{{ asset($websiteSettings->og_image) }}">
    @endif
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $websiteSettings->meta_title ?? config('app.name', 'Laravel') }}">
    <meta property="twitter:description" content="{{ $websiteSettings->meta_description ?? '' }}">
    @if(isset($websiteSettings->twitter_card_image))
        <meta property="twitter:image" content="{{ asset($websiteSettings->twitter_card_image) }}">
    @endif

    <!-- Favicon -->
    @if(isset($websiteSettings->favicon))
        <link rel="icon" type="image/x-icon" href="{{ asset($websiteSettings->favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Analytics -->
    @if(isset($websiteSettings->google_analytics_id))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $websiteSettings->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $websiteSettings->google_analytics_id }}');
        </script>
    @endif

    <!-- Google Site Verification -->
    @if(isset($websiteSettings->google_verification_code))
        <meta name="google-site-verification" content="{{ $websiteSettings->google_verification_code }}">
    @endif

    <!-- Bing Site Verification -->
    @if(isset($websiteSettings->bing_verification_code))
        <meta name="msvalidate.01" content="{{ $websiteSettings->bing_verification_code }}">
    @endif
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center">
                                @if(isset($websiteSettings->logo))
                                    <img src="{{ asset($websiteSettings->logo) }}" alt="{{ $websiteSettings->site_name ?? config('app.name', 'Laravel') }}" class="h-8 w-auto">
                                @else
                                    <span class="text-2xl font-bold text-indigo-600">
                                        {{ $websiteSettings->site_name ?? config('app.name', 'Laravel') }}
                                    </span>
                                @endif
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-home mr-2"></i> Home
                            </a>
                            <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-briefcase mr-2"></i> Jobs
                            </a>
                            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-list mr-2"></i> Categories
                            </a>
                            <a href="{{ route('companies.index') }}" class="{{ request()->routeIs('companies.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-building mr-2"></i> Companies
                            </a>
                            <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="fas fa-blog mr-2"></i> Blog
                            </a>
                            @auth
                                @if(Auth::user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                                    </a>
                                @endif
                                @if(Auth::user()->hasRole('employer'))
                                    @php
                                        $company = Auth::user()->company;
                                        $statusClass = $company ? match($company->status) {
                                            'approved' => 'text-green-600',
                                            'rejected' => 'text-red-600',
                                            default => 'text-yellow-600'
                                        } : 'text-gray-600';
                                    @endphp
                                    <a href="{{ route('employer.dashboard') }}" class="{{ request()->routeIs('employer.dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Employer Dashboard
                                        @if($company)
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $statusClass }}">
                                                {{ ucfirst($company->status) }}
                                            </span>
                                        @else
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                                No Company
                                            </span>
                                        @endif
                                    </a>
                                    @if($company && $company->status === 'approved')
                                        <a href="{{ route('employer.jobs.index') }}" class="{{ request()->routeIs('employer.jobs.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                            <i class="fas fa-list mr-2"></i> My Jobs
                                        </a>
                                        <a href="{{ route('employer.applications.index') }}" class="{{ request()->routeIs('employer.applications.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                            <i class="fas fa-file-alt mr-2"></i> Applications
                                        </a>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>

                    <!-- Right side -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        @auth
                            <div class="ml-3 relative" x-data="{ open: false }" @click.away="open = false">
                                <div>
                                    <button @click="open = !open" type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-600">
                                            <span class="text-sm font-medium leading-none text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </span>
                                    </button>
                                </div>
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                     role="menu" 
                                     aria-orientation="vertical" 
                                     aria-labelledby="user-menu-button" 
                                     tabindex="-1">
                                    @if(Auth::user()->hasRole('admin'))
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Admin Dashboard</a>
                                        <a href="{{ route('employer.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Employer Dashboard</a>
                                    @endif
                                    @if(Auth::user()->hasRole('employer'))
                                        @if($company && $company->status === 'approved')
                                            <a href="{{ route('employer.jobs.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">My Jobs</a>
                                            <a href="{{ route('employer.applications.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Applications</a>
                                        @endif
                                    @endif
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">Register</a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button x-data @click="$dispatch('toggle-mobile-menu')" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-data="{ open: false }" 
                 @toggle-mobile-menu.window="open = !open"
                 x-show="open"
                 class="sm:hidden" 
                 id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Home</a>
                    <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Jobs</a>
                    <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Categories</a>
                    <a href="{{ route('companies.index') }}" class="{{ request()->routeIs('companies.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Companies</a>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Blog</a>
                    @auth
                        @if(Auth::user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                            </a>
                        @endif
                        @if(Auth::user()->hasRole('employer'))
                            @php
                                $company = Auth::user()->company;
                                $statusClass = $company ? match($company->status) {
                                    'approved' => 'text-green-600',
                                    'rejected' => 'text-red-600',
                                    default => 'text-yellow-600'
                                } : 'text-gray-600';
                            @endphp
                            <a href="{{ route('employer.dashboard') }}" class="{{ request()->routeIs('employer.dashboard') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Employer Dashboard
                                @if($company)
                                    <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $statusClass }}">
                                        {{ ucfirst($company->status) }}
                                    </span>
                                @else
                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                        No Company
                                    </span>
                                @endif
                            </a>
                            @if($company && $company->status === 'approved')
                                <a href="{{ route('employer.jobs.index') }}" class="{{ request()->routeIs('employer.jobs.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                    <i class="fas fa-list mr-2"></i> My Jobs
                                </a>
                                <a href="{{ route('employer.applications.index') }}" class="{{ request()->routeIs('employer.applications.*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                    <i class="fas fa-file-alt mr-2"></i> Applications
                                </a>
                            @endif
                        @endif
                    @endauth
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    @auth
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600">
                                    <span class="text-sm font-medium leading-none text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </span>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Admin Dashboard</a>
                                <a href="{{ route('employer.dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Employer Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('employer'))
                                @if($company && $company->status === 'approved')
                                    <a href="{{ route('employer.jobs.index') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">My Jobs</a>
                                    <a href="{{ route('employer.applications.index') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Applications</a>
                                @endif
                            @endif
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">About</h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Company</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Careers</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Help Center</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Contact Us</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Terms of Service</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Cookie Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Connect</h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Twitter</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">Facebook</a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">LinkedIn</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <p class="text-base text-gray-400 text-center">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>
</html> 