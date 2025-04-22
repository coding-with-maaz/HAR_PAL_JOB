@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>

            <!-- Stats Overview -->
            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] }}</div>
                                        @if($stats['today_users'] > 0)
                                            <div class="ml-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    +{{ $stats['today_users'] }} today
                                                </span>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.users.index') }}" class="font-medium text-blue-700 hover:text-blue-900">View all users</a>
                            </div>
                        </div>
                    </div>

                <!-- Total Companies -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Companies</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_companies'] }}</div>
                                        @if($stats['pending_companies'] > 0)
                                            <div class="ml-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    {{ $stats['pending_companies'] }} pending
                                                </span>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.companies.index') }}" class="font-medium text-blue-700 hover:text-blue-900">Manage companies</a>
                            </div>
                        </div>
                    </div>

                <!-- Total Jobs -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Jobs</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_jobs'] }}</div>
                                        <div class="ml-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $stats['active_jobs'] }} active
                                            </span>
                                            @if($stats['today_jobs'] > 0)
                                                <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    +{{ $stats['today_jobs'] }} today
                                                </span>
                                            @endif
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.jobs.index') }}" class="font-medium text-blue-700 hover:text-blue-900">View all jobs</a>
                            </div>
                        </div>
                    </div>

                <!-- Total Applications -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Applications</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_applications'] }}</div>
                                        @if($stats['today_applications'] > 0)
                                            <div class="ml-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    +{{ $stats['today_applications'] }} today
                                                </span>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.applications.index') }}" class="font-medium text-blue-700 hover:text-blue-900">View all applications</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Monthly Analytics Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Monthly Analytics</h3>
                    <div class="mt-4" style="height: 300px;">
                        <canvas id="analyticsChart"></canvas>
                    </div>
                </div>

                <!-- Top Categories -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Top Job Categories</h3>
                    <div class="mt-4">
                        <ul class="divide-y divide-gray-200">
                            @foreach($topCategories as $category)
                                <li class="py-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-gray-900">{{ $category->name }}</span>
                                    </div>
                                    <div class="ml-3 flex items-center">
                                        <div class="w-32 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $category->percentage }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $category->percentage }}%</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Job Status Distribution -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Job Status Distribution</h3>
                    <div class="mt-4" style="height: 300px;">
                        <canvas id="jobStatusChart"></canvas>
                    </div>
                </div>

                <!-- Company Status Distribution -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Company Status Distribution</h3>
                    <div class="mt-4" style="height: 300px;">
                        <canvas id="companyStatusChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
            <div class="mt-8">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach($recentActivities as $activity)
                            <li class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity['message'] }}</p>
                                        @if(isset($activity['company']))
                                            <p class="text-sm text-gray-500">{{ $activity['company'] }}</p>
                                        @endif
                                        @if(isset($activity['applicant']))
                                            <p class="text-sm text-gray-500">Applicant: {{ $activity['applicant'] }}</p>
                                        @endif
                                        @if(isset($activity['status']))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if($activity['status'] === 'active' || $activity['status'] === 'approved') bg-green-100 text-green-800
                                                @elseif($activity['status'] === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($activity['status']) }}
                                                    </span>
                                        @endif
                                                </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $activity['date']->diffForHumans() }}
                                            </div>
                                        </div>
                                    </li>
                        @endforeach
                            </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Analytics Chart
    const analyticsCtx = document.getElementById('analyticsChart').getContext('2d');
    const jobsData = @json($monthlyJobs);
    const applicationsData = @json($monthlyApplications);
    
    new Chart(analyticsCtx, {
        type: 'line',
        data: {
            labels: jobsData.map(item => item.month),
            datasets: [
                {
                    label: 'Job Postings',
                    data: jobsData.map(item => item.count),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Applications',
                    data: applicationsData.map(item => item.count),
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Job Status Distribution Chart
    const jobStatusCtx = document.getElementById('jobStatusChart').getContext('2d');
    const jobStatusData = @json($jobStatusDistribution);
    
    new Chart(jobStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [jobStatusData['active'], jobStatusData['inactive']],
                backgroundColor: ['rgb(16, 185, 129)', 'rgb(239, 68, 68)']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Company Status Distribution Chart
    const companyStatusCtx = document.getElementById('companyStatusChart').getContext('2d');
    const companyStatusData = @json($companyStatusDistribution);
    
    new Chart(companyStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Rejected'],
            datasets: [{
                data: [companyStatusData['approved'], companyStatusData['pending'], companyStatusData['rejected']],
                backgroundColor: ['rgb(16, 185, 129)', 'rgb(234, 179, 8)', 'rgb(239, 68, 68)']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endpush
@endsection 