

<?php $__env->startSection('content'); ?>
<div class="bg-white">
    <!-- Search Section -->
    <div class="bg-indigo-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white sm:text-4xl"><?php echo e($department); ?> Jobs</h1>
                <p class="mt-3 text-xl text-indigo-100">Find the best <?php echo e($department); ?> job opportunities</p>
            </div>
            
             <!-- <form action="<?php echo e(route('jobs.category', $department)); ?>" method="GET" class="mt-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4"> -->
                    <!-- Job Title or Keywords -->
                    <!-- <div class="md:col-span-4">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="<?php echo e(request('search')); ?>"
                                   class="block w-full pl-10 pr-3 py-3 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="Job title or keywords">
                        </div>
                    </div> -->

                    <!-- Location -->
                    <!-- <div class="md:col-span-3">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="location" 
                                   value="<?php echo e(request('location')); ?>"
                                   class="block w-full pl-10 pr-3 py-3 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="City, state, or remote">
                        </div>
                    </div> -->

                    <!-- Employment Type -->
                    <!-- <div class="md:col-span-2">
                        <select name="employment_type" 
                                class="block w-full py-3 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Types</option>
                            <option value="full-time" <?php echo e(request('employment_type') == 'full-time' ? 'selected' : ''); ?>>Full-time</option>
                            <option value="part-time" <?php echo e(request('employment_type') == 'part-time' ? 'selected' : ''); ?>>Part-time</option>
                            <option value="contract" <?php echo e(request('employment_type') == 'contract' ? 'selected' : ''); ?>>Contract</option>
                            <option value="internship" <?php echo e(request('employment_type') == 'internship' ? 'selected' : ''); ?>>Internship</option>
                        </select>
                    </div> -->

                    <!-- Remote Filter -->
                    <!-- <div class="md:col-span-2">
                        <select name="remote" 
                                class="block w-full py-3 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All</option>
                            <option value="remote" <?php echo e(request('remote') == 'remote' ? 'selected' : ''); ?>>Remote Only</option>
                            <option value="hybrid" <?php echo e(request('remote') == 'hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                            <option value="onsite" <?php echo e(request('remote') == 'onsite' ? 'selected' : ''); ?>>On-site</option>
                        </select>
                    </div> -->

                    <!-- Search Button -->
                    <!-- <div class="md:col-span-1">
                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Search
                        </button>
                    </div>
                </div> -->

                <!-- Additional Filters -->
                <div class="mt-4 flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="posted_today" 
                               id="posted_today" 
                               value="1" 
                               <?php echo e(request('posted_today') ? 'checked' : ''); ?>

                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="posted_today" class="ml-2 text-sm text-white">Posted Today</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="easy_apply" 
                               id="easy_apply" 
                               value="1" 
                               <?php echo e(request('easy_apply') ? 'checked' : ''); ?>

                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="easy_apply" class="ml-2 text-sm text-white">Easy Apply</label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Job Listings -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Categories Section -->
        <?php if(isset($categories) && $categories->isNotEmpty()): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Popular Categories</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('jobs.category', $category->department)); ?>" 
                           class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 <?php echo e($category->department === $department ? 'ring-2 ring-indigo-500' : ''); ?>">
                            <h3 class="text-lg font-semibold text-gray-900"><?php echo e($category->department); ?></h3>
                            <p class="mt-2 text-sm text-gray-500"><?php echo e($category->job_count); ?> jobs available</p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Featured Companies Section -->
        <?php if(isset($featuredCompanies) && $featuredCompanies->isNotEmpty()): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Featured Companies</h2>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <?php $__currentLoopData = $featuredCompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('companies.show', $company)); ?>" 
                           class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 text-center">
                            <?php if($company->logo): ?>
                                <img src="<?php echo e(asset('storage/' . $company->logo)); ?>" 
                                     alt="<?php echo e($company->name); ?>" 
                                     class="h-16 w-16 object-contain mx-auto mb-2">
                            <?php else: ?>
                                <div class="h-16 w-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <span class="text-2xl font-bold text-indigo-600">
                                        <?php echo e(substr($company->name, 0, 1)); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                            <h3 class="text-sm font-medium text-gray-900"><?php echo e($company->name); ?></h3>
                            <p class="text-xs text-gray-500"><?php echo e($company->job_postings_count); ?> jobs</p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Active Filters -->
        <?php if(request()->anyFilled(['search', 'location', 'employment_type', 'remote', 'posted_today', 'easy_apply'])): ?>
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Active Filters:</h3>
                <div class="flex flex-wrap gap-2">
                    <?php if(request('search')): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Search: <?php echo e(request('search')); ?>

                            <a href="<?php echo e(request()->except('search')); ?>" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if(request('location')): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Location: <?php echo e(request('location')); ?>

                            <a href="<?php echo e(request()->except('location')); ?>" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if(request('employment_type')): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Type: <?php echo e(ucfirst(request('employment_type'))); ?>

                            <a href="<?php echo e(request()->except('employment_type')); ?>" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if(request('remote')): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Remote: <?php echo e(ucfirst(request('remote'))); ?>

                            <a href="<?php echo e(request()->except('remote')); ?>" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if(request('posted_today')): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Posted Today
                            <a href="<?php echo e(request()->except('posted_today')); ?>" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if(request('easy_apply')): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Easy Apply
                            <a href="<?php echo e(request()->except('easy_apply')); ?>" class="ml-2 text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Results Count -->
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900"><?php echo e($jobs->total()); ?> <?php echo e($department); ?> Jobs Found</h2>
            <div class="flex items-center">
                <label for="sort" class="mr-2 text-sm text-gray-600">Sort by:</label>
                <select name="sort" 
                        id="sort" 
                        onchange="window.location.href = this.value"
                        class="text-sm border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'newest'])); ?>" 
                            <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>
                        Newest First
                    </option>
                    <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'salary'])); ?>"
                            <?php echo e(request('sort') == 'salary' ? 'selected' : ''); ?>>
                        Salary
                    </option>
                </select>
            </div>
        </div>

        <!-- Job List -->
        <div class="space-y-6">
            <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start">
                        <?php if($job->company && $job->company->logo): ?>
                            <img src="<?php echo e(asset('storage/' . $job->company->logo)); ?>" 
                                 alt="<?php echo e($job->company->name); ?>" 
                                 class="h-16 w-16 object-contain rounded">
                        <?php else: ?>
                            <div class="h-16 w-16 bg-indigo-100 rounded flex items-center justify-center">
                                <span class="text-2xl font-bold text-indigo-600">
                                    <?php echo e($job->company ? substr($job->company->name, 0, 1) : '?'); ?>

                                </span>
                            </div>
                        <?php endif; ?>

                        <div class="ml-6 flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    <a href="<?php echo e(route('jobs.show', $job)); ?>" class="hover:text-indigo-600">
                                        <?php echo e($job->title); ?>

                                    </a>
                                </h3>
                                <div class="flex items-center space-x-4">
                                    <button class="text-gray-400 hover:text-indigo-600">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                    <span class="text-sm text-gray-500">
                                        <?php echo e($job->created_at->diffForHumans()); ?>

                                    </span>
                                </div>
                            </div>

                            <div class="mt-2">
                                <?php if($job->company): ?>
                                    <a href="<?php echo e(route('companies.show', $job->company)); ?>" 
                                       class="text-gray-700 hover:text-indigo-600">
                                        <?php echo e($job->company->name); ?>

                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="mt-4 flex items-center space-x-4 text-sm text-gray-500">
                                <?php if($job->location): ?>
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                        <?php echo e($job->location); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if($job->employment_type): ?>
                                    <div class="flex items-center">
                                        <i class="fas fa-briefcase mr-2 text-gray-400"></i>
                                        <?php echo e(ucfirst($job->employment_type)); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if($job->salary_min && $job->salary_max): ?>
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                        $<?php echo e(number_format($job->salary_min)); ?> - $<?php echo e(number_format($job->salary_max)); ?>

                                    </div>
                                <?php endif; ?>
                                <div class="flex items-center">
                                    <i class="fas fa-eye mr-2 text-gray-400"></i>
                                    <?php echo e(number_format($job->views_count)); ?> views
                                </div>
                                <?php if($job->easy_apply): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-bolt mr-1"></i>
                                        Easy Apply
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if($job->formatted_skills_required): ?>
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700">Required Skills:</h4>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <?php $__currentLoopData = $job->formatted_skills_required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <?php echo e($skill); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($job->formatted_benefits): ?>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $job->formatted_benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            <?php echo e($benefit); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-12">
                    <div class="text-gray-500">
                        <i class="fas fa-search text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900">No <?php echo e($department); ?> jobs found</h3>
                        <p class="mt-1">Try adjusting your search filters or explore other categories</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            <?php echo e($jobs->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/jobs/category.blade.php ENDPATH**/ ?>