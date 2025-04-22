<?php $__env->startSection('content'); ?>

<div class="bg-gray-100 min-h-screen font-sans">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="text-center mb-10 sm:mb-12">
                <h1 class="text-4xl font-bold text-white sm:text-5xl tracking-tight">Available Jobs</h1>
                <p class="mt-3 text-lg sm:text-xl text-indigo-100">Browse through our latest job opportunities</p>
            </div>

            <!-- Search Form -->
            <div class="mt-8 max-w-5xl mx-auto bg-white rounded-xl shadow-xl p-6 sm:p-8">
                <form action="<?php echo e(route('jobs.index')); ?>" method="GET" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1.5">Keywords</label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="<?php echo e(request('search')); ?>"
                                       class="block w-full pl-11 pr-3 py-2.5 text-base border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="Job title, company, or skill">
                            </div>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       name="location" 
                                       id="location"
                                       value="<?php echo e(request('location')); ?>"
                                       class="block w-full pl-11 pr-3 py-2.5 text-base border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="City, State, or Zip">
                            </div>
                        </div>
                    </div>

                    
                     
                     
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 pt-4 border-t border-gray-100">
                            <div>
                                <label for="employment_type" class="block text-sm font-medium text-gray-700 mb-1.5">Employment Type</label>
                                <select name="employment_type" 
                                        id="employment_type"
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Any Type</option>
                                    <option value="full_time" <?php echo e(request('employment_type') == 'full_time' ? 'selected' : ''); ?>>Full Time</option>
                                    <option value="part_time" <?php echo e(request('employment_type') == 'part_time' ? 'selected' : ''); ?>>Part Time</option>
                                    <option value="contract" <?php echo e(request('employment_type') == 'contract' ? 'selected' : ''); ?>>Contract</option>
                                    <option value="internship" <?php echo e(request('employment_type') == 'internship' ? 'selected' : ''); ?>>Internship</option>
                                </select>
                            </div>
                            <div>
                                <label for="experience_level" class="block text-sm font-medium text-gray-700 mb-1.5">Experience Level</label>
                                <select name="experience_level" 
                                        id="experience_level"
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Any Level</option>
                                    <option value="entry" <?php echo e(request('experience_level') == 'entry' ? 'selected' : ''); ?>>Entry Level</option>
                                    <option value="intermediate" <?php echo e(request('experience_level') == 'intermediate' ? 'selected' : ''); ?>>Intermediate</option>
                                    <option value="senior" <?php echo e(request('experience_level') == 'senior' ? 'selected' : ''); ?>>Senior</option>
                                    <option value="executive" <?php echo e(request('experience_level') == 'executive' ? 'selected' : ''); ?>>Executive</option>
                                </select>
                            </div>
                            <div>
                                <label for="salary_range" class="block text-sm font-medium text-gray-700 mb-1.5">Salary Range</label>
                                <select name="salary_range" 
                                        id="salary_range"
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Any Range</option>
                                    <option value="0-30000" <?php echo e(request('salary_range') == '0-30000' ? 'selected' : ''); ?>>Under $30k</option>
                                    <option value="30000-50000" <?php echo e(request('salary_range') == '30000-50000' ? 'selected' : ''); ?>>$30k - $50k</option>
                                    <option value="50000-80000" <?php echo e(request('salary_range') == '50000-80000' ? 'selected' : ''); ?>>$50k - $80k</option>
                                    <option value="80000-100000" <?php echo e(request('salary_range') == '80000-100000' ? 'selected' : ''); ?>>$80k - $100k</option>
                                    <option value="100000+" <?php echo e(request('salary_range') == '100000+' ? 'selected' : ''); ?>>$100k+</option>
                                </select>
                            </div>
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-1.5">Department</label>
                                <select name="department" 
                                        id="department"
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">All Departments</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->department); ?>" <?php echo e(request('department') == $category->department ? 'selected' : ''); ?>>
                                            <?php echo e($category->department); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                     

                    <!-- Bottom Row: Checkboxes & Buttons -->
                    <div class="pt-4 border-t border-gray-100 flex flex-col lg:flex-row items-center justify-between gap-4">
                        <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="checkbox" 
                                       name="remote" 
                                       value="1" 
                                       <?php echo e(request('remote') ? 'checked' : ''); ?>

                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer focus:ring-offset-0">
                                <span class="ml-2 text-sm text-gray-700 group-hover:text-indigo-600">Remote OK</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="checkbox" 
                                       name="easy_apply" 
                                       value="1" 
                                       <?php echo e(request('easy_apply') ? 'checked' : ''); ?>

                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer focus:ring-offset-0">
                                <span class="ml-2 text-sm text-gray-700 group-hover:text-indigo-600">Easy Apply</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="checkbox" 
                                       name="posted_today" 
                                       value="1" 
                                       <?php echo e(request('posted_today') ? 'checked' : ''); ?>

                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer focus:ring-offset-0">
                                <span class="ml-2 text-sm text-gray-700 group-hover:text-indigo-600">Posted Today</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-3 w-full lg:w-auto flex-shrink-0">
                            <?php if(request()->anyFilled(['search', 'location', 'employment_type', 'experience_level', 'salary_range', 'department', 'remote', 'easy_apply', 'posted_today'])): ?>
                                <a href="<?php echo e(route('jobs.index')); ?>" 
                                   class="inline-flex items-center justify-center w-full lg:w-auto px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm">
                                    <i class="fas fa-times mr-1.5"></i>
                                    Clear
                                </a>
                            <?php endif; ?>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors transform hover:scale-[1.02]">
                                <i class="fas fa-search mr-2"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Active Filters Display -->
        <?php
            $activeFilters = collect(request()->query())->except(['page', 'sort'])->filter();
        ?>
        <?php if($activeFilters->isNotEmpty()): ?>
            <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm font-medium text-gray-700 mr-2">Active Filters:</span>
                    <?php $__currentLoopData = $activeFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                            <?php if($key === 'remote' || $key === 'easy_apply' || $key === 'posted_today'): ?>
                                <?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>

                            <?php else: ?>
                                <span class="font-semibold mr-1"><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>:</span> <?php echo e($value); ?>

                            <?php endif; ?>
                            <a href="<?php echo e(route('jobs.index', request()->except($key))); ?>" class="ml-1.5 flex-shrink-0 text-indigo-600 hover:text-indigo-400 opacity-75 hover:opacity-100" title="Remove filter">
                                <span class="sr-only">Remove filter</span>
                                <i class="fas fa-times-circle text-xs"></i>
                            </a>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('jobs.index')); ?>" class="ml-3 text-sm text-indigo-600 hover:underline font-medium">Clear All</a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Categories Section -->
        <?php if(isset($categories) && $categories->isNotEmpty() && !request('department')): ?>
            <div class="mb-10 sm:mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Popular Categories</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    <?php $__currentLoopData = $categories->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('jobs.index', array_merge(request()->query(), ['department' => $category->department]))); ?>" 
                           class="group bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex flex-col items-center text-center border border-gray-100 hover:border-indigo-200 transform hover:-translate-y-0.5">
                            <div class="h-12 w-12 rounded-lg flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100 group-hover:scale-105 transition-transform duration-200 mb-2">
                                <i class="fas <?php echo e(match(strtolower($category->department)) {
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
                                    }); ?> text-indigo-600 text-xl group-hover:text-indigo-700"></i>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors duration-200 mb-1 truncate w-full"><?php echo e($category->department); ?></h3>
                            <span class="text-xs font-medium text-gray-500"><?php echo e($category->job_count); ?> <?php echo e(Str::plural('job', $category->job_count)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Featured Companies Section (Simplified) -->
        <?php if(isset($featuredCompanies) && $featuredCompanies->isNotEmpty()): ?>
            <div class="mb-10 sm:mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Companies Hiring</h2>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                    <?php $__currentLoopData = $featuredCompanies->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('companies.show', $company)); ?>" 
                           class="group bg-white p-3 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 flex flex-col items-center text-center border border-gray-100 hover:border-indigo-200 transform hover:scale-105">
                            <div class="h-12 w-12 sm:h-16 sm:w-16 flex items-center justify-center mb-2 transition-transform duration-200 group-hover:scale-105">
                                <?php if($company->logo_url): ?>
                                    <img src="<?php echo e($company->logo_url); ?>" 
                                         alt="<?php echo e($company->name); ?>" 
                                         class="h-full w-full object-contain rounded-md">
                                <?php else: ?>
                                    <div class="h-full w-full bg-gradient-to-br from-indigo-100 to-purple-100 rounded-md flex items-center justify-center">
                                        <span class="text-xl sm:text-2xl font-bold text-indigo-600"><?php echo e(substr($company->name, 0, 1)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-xs sm:text-sm font-medium text-gray-700 group-hover:text-indigo-600 transition-colors duration-200 truncate w-full"><?php echo e($company->name); ?></h3>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Results Count and Sort -->
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-900 whitespace-nowrap"><?php echo e($jobs->total()); ?> Jobs Found</h2>
            <form action="<?php echo e(route('jobs.index', request()->except(['sort', 'page']))); ?>" method="GET" class="flex items-center w-full sm:w-auto"> 
                 
                 <?php $__currentLoopData = request()->except(['sort', 'page', '_token']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <label for="sort" class="mr-2 text-sm text-gray-600 whitespace-nowrap">Sort by:</label>
                <select name="sort" 
                        id="sort" 
                        onchange="this.form.submit()"
                        class="text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 w-full sm:w-auto shadow-sm"> 
                    <option value="newest" <?php echo e(request('sort', 'newest') == 'newest' ? 'selected' : ''); ?>>Newest First</option>
                    <option value="salary" <?php echo e(request('sort') == 'salary' ? 'selected' : ''); ?>>Salary</option>
                </select>
            </form>
        </div>

        <!-- Job List -->
        <div class="grid grid-cols-1 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden border border-gray-100 hover:border-indigo-200 flex flex-col md:flex-row">
                    <!-- Left Side: Logo/Icon -->
                    <div class="flex-shrink-0 p-5 sm:p-6 flex items-center justify-center md:w-32 bg-gradient-to-br from-indigo-50 to-purple-50 md:bg-gray-50 md:border-r border-gray-100">
                        <div class="h-16 w-16 sm:h-20 sm:w-20 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow duration-200">
                            <?php if($job->company && $job->company->logo_url): ?>
                                <img src="<?php echo e($job->company->logo_url); ?>" alt="<?php echo e($job->company->name); ?>" class="h-full w-full object-contain rounded-lg p-1">
                            <?php else: ?>
                                <i class="fas fa-building text-white text-2xl sm:text-3xl"></i>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Right Side: Details -->
                    <div class="flex-1 flex flex-col p-5 sm:p-6">
                        <div class="flex-grow mb-4">
                            <!-- Top Row: Title, Company, Tags -->
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-2 mb-3">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                                        <a href="<?php echo e(route('jobs.show', $job)); ?>" class="stretched-link"><?php echo e($job->title); ?></a>
                                    </h3>
                                    <?php if($job->company): ?>
                                        <a href="<?php echo e(route('companies.show', $job->company)); ?>" 
                                           class="mt-1 text-sm sm:text-base text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center group relative z-10">
                                            <span class="group-hover:underline"><?php echo e($job->company->name); ?></span>
                                            <?php if($job->company->is_verified): ?>
                                                <i class="fas fa-check-circle text-blue-500 text-xs sm:text-sm ml-1.5" title="Verified Company"></i>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-shrink-0 flex flex-wrap items-center gap-2 mt-2 sm:mt-0">
                                    <?php if($job->created_at->isToday()): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <i class="fas fa-clock mr-1"></i> New
                                        </span>
                                    <?php endif; ?>
                                    <?php if($job->is_featured): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            <i class="fas fa-star mr-1"></i> Featured
                                        </span>
                                    <?php endif; ?>
                                    <?php if($job->urgent): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            <i class="fas fa-fire mr-1"></i> Urgent
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Middle Row: Metadata -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-2 text-sm text-gray-600 mt-3">
                                <?php if($job->location): ?>
                                    <div class="flex items-center" title="Location">
                                        <i class="fas fa-map-marker-alt text-gray-400 w-4 text-center mr-1.5"></i>
                                        <span class="truncate"><?php echo e($job->location); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($job->employment_type): ?>
                                    <div class="flex items-center" title="Employment Type">
                                        <i class="fas fa-briefcase text-gray-400 w-4 text-center mr-1.5"></i>
                                        <span class="truncate"><?php echo e(ucfirst(str_replace('_', '-', $job->employment_type))); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($job->salary_range): ?>
                                    <div class="flex items-center" title="Salary Range">
                                        <i class="fas fa-money-bill-wave text-gray-400 w-4 text-center mr-1.5"></i>
                                        <span class="truncate"><?php echo e($job->salary_range); ?></span>
                                    </div>
                                <?php elseif($job->salary_min && $job->salary_max): ?>
                                    <div class="flex items-center" title="Salary Range">
                                        <i class="fas fa-money-bill-wave text-gray-400 w-4 text-center mr-1.5"></i>
                                        <span class="truncate">$<?php echo e(number_format($job->salary_min / 1000)); ?>k - $<?php echo e(number_format($job->salary_max / 1000)); ?>k</span>
                                    </div>
                                <?php endif; ?>
                                <?php if($job->experience_level): ?>
                                    <div class="flex items-center" title="Experience Level">
                                        <i class="fas fa-user-graduate text-gray-400 w-4 text-center mr-1.5"></i>
                                        <span class="truncate"><?php echo e(ucfirst($job->experience_level)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Skills -->
                            <?php if($job->formatted_skills_required): ?>
                                <div class="mt-3">
                                    <div class="flex flex-wrap gap-1.5">
                                        <?php $__currentLoopData = $job->formatted_skills_required->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                <?php echo e($skill); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($job->formatted_skills_required) > 5): ?>
                                            <span class="text-xs text-gray-500 italic ml-1">+<?php echo e(count($job->formatted_skills_required) - 5); ?> more</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Bottom Row: Actions -->
                        <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 mt-auto">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span title="Posted <?php echo e($job->created_at->format('M d, Y')); ?>" class="flex items-center">
                                    <i class="far fa-clock mr-1 text-gray-400"></i> 
                                    <?php echo e($job->created_at->diffForHumans()); ?>

                                </span>
                                <?php if($job->remote_allowed): ?>
                                    <span class="inline-flex items-center text-blue-600" title="Remote Allowed">
                                        <i class="fas fa-laptop-house mr-1"></i> Remote
                                    </span>
                                <?php endif; ?>
                                <?php if($job->easy_apply): ?>
                                    <span class="inline-flex items-center text-green-600" title="Easy Apply Available">
                                        <i class="fas fa-bolt mr-1"></i> Easy Apply
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center gap-3 relative z-10"> 
                                <button class="text-gray-400 hover:text-indigo-600 transition-colors duration-200 p-1 rounded-full hover:bg-indigo-50" title="Save Job">
                                    <span class="sr-only">Save Job</span>
                                    <i class="far fa-bookmark text-lg"></i>
                                </button>
                                <a href="<?php echo e(route('jobs.show', $job)); ?>"
                                   class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 whitespace-nowrap shadow-sm hover:shadow"> 
                                    View Details
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-16 bg-white rounded-lg shadow-md border border-gray-100"> 
                    <div class="text-gray-500">
                        <div class="w-16 h-16 mx-auto rounded-full bg-indigo-50 flex items-center justify-center mb-4">
                            <i class="fas fa-search text-3xl text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900">No jobs found matching your criteria</h3>
                        <p class="mt-2 text-base">Try adjusting your search filters or check back later.</p>
                        <div class="mt-6">
                            <a href="<?php echo e(route('jobs.index')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm"> 
                                Clear all filters and view all jobs
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            <?php echo e($jobs->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/jobs/index.blade.php ENDPATH**/ ?>