

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="text-center mb-10 sm:mb-12">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">Find Great Companies</h1>
                <p class="mt-3 text-lg sm:text-xl text-indigo-100">Discover companies that match your career goals</p>
            </div>
            
            <!-- Search Form -->
            <div class="mt-8 max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-6 sm:p-8">
                <form action="<?php echo e(route('companies.index')); ?>" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                        <!-- Company Name or Keywords -->
                        <div class="md:col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Company Name / Keywords</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="<?php echo e(request('search')); ?>"
                                       class="block w-full pl-10 pr-3 py-2.5 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="e.g., Tech Solutions, Marketing Agency">
                            </div>
                        </div>

                        <!-- Industry -->
                        <div>
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                            <select name="industry" 
                                    id="industry"
                                    class="block w-full py-2.5 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Industries</option>
                                <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e((string) $industry); ?>" <?php echo e(request('industry') == (string) $industry ? 'selected' : ''); ?>>
                                        <?php echo e((string) $industry); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                     <!-- Search Button & Clear -->
                    <div class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-end gap-3 sm:gap-4">
                         <?php if(request()->anyFilled(['search', 'industry'])): ?>
                            <a href="<?php echo e(route('companies.index')); ?>" 
                               class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors order-last sm:order-first"> 
                                <i class="fas fa-times mr-2"></i>
                                Clear
                            </a>
                        <?php endif; ?>
                        <button type="submit" 
                                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <i class="fas fa-search mr-2"></i>
                            Search Companies
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Company Listings -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        
        <!-- Active Filters Display -->
        <?php
            $activeFilters = collect(request()->query())->except(['page'])->filter();
        ?>
        <?php if($activeFilters->isNotEmpty()): ?>
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm font-medium text-gray-700">Active Filters:</span>
                    <?php $__currentLoopData = $activeFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            <?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>: <?php echo e($value); ?>

                            <a href="<?php echo e(route('companies.index', request()->except($key))); ?>" class="ml-1.5 flex-shrink-0 text-indigo-600 hover:text-indigo-400">
                                <span class="sr-only">Remove filter</span>
                                <i class="fas fa-times-circle"></i>
                            </a>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('companies.index')); ?>" class="ml-2 text-sm text-indigo-600 hover:underline">Clear All</a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Results Count -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow flex items-center justify-between">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-900"><?php echo e($companies->total()); ?> Companies Found</h2>
            
        </div>

        <!-- Company Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden flex flex-col"> 
                    <!-- Logo & Header -->
                    <div class="p-6 flex flex-col items-center text-center border-b border-gray-100">
                        <div class="h-20 w-20 sm:h-24 sm:w-24 mb-4 flex items-center justify-center">
                             <?php if($company->logo_url): ?>
                                <img src="<?php echo e($company->logo_url); ?>" 
                                     alt="<?php echo e($company->name); ?>" 
                                     class="h-full w-full object-contain rounded-md">
                            <?php else: ?>
                                <div class="h-full w-full bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center shadow-inner">
                                    <i class="fas fa-building text-4xl text-indigo-400"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                            <a href="<?php echo e(route('companies.show', $company)); ?>">
                                <?php echo e($company->name); ?>

                            </a>
                        </h3>
                        <?php if($company->is_verified): ?>
                            <span class="inline-flex items-center text-xs font-medium text-blue-600 mt-1" title="Verified Company">
                                <i class="fas fa-check-circle mr-1"></i> Verified
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Details -->
                    <div class="p-6 flex-grow space-y-4 text-sm">
                         <?php if($company->industry): ?>
                            <div class="flex items-center text-gray-600" title="Industry">
                                <i class="fas fa-industry text-gray-400 w-5 text-center mr-3"></i>
                                <span class="truncate"><?php echo e((string) $company->industry); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex items-center text-gray-600" title="Active Job Postings">
                            <i class="fas fa-briefcase text-gray-400 w-5 text-center mr-3"></i>
                            <span class="truncate"><?php echo e($company->jobs_count); ?> <?php echo e(Str::plural('Active Job', $company->jobs_count)); ?></span>
                        </div>

                        <?php if($company->headquarters): ?>
                            <div class="flex items-center text-gray-600" title="Headquarters">
                                <i class="fas fa-map-marker-alt text-gray-400 w-5 text-center mr-3"></i>
                                <span class="truncate"><?php echo e($company->headquarters); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->description): ?>
                            <div class="pt-3 border-t border-gray-100">
                                <p class="text-gray-500 line-clamp-3">
                                    <?php echo e($company->description); ?>

                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                     <!-- Footer Button -->
                     <div class="bg-gray-50 px-6 py-4 mt-auto border-t border-gray-100">
                         <a href="<?php echo e(route('companies.show', $company)); ?>" 
                           class="block w-full text-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            View Details
                        </a>
                     </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                 <div class="col-span-full text-center py-16 bg-white rounded-lg shadow">
                    <div class="text-gray-500">
                        <div class="w-16 h-16 mx-auto rounded-full bg-indigo-50 flex items-center justify-center mb-4">
                            <i class="fas fa-building text-3xl text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900">No companies found matching your criteria</h3>
                        <p class="mt-2 text-base">Try adjusting your search filters or browse all companies.</p>
                        <div class="mt-6">
                            <a href="<?php echo e(route('companies.index')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Clear all filters and view all companies
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            <?php echo e($companies->appends(request()->query())->links()); ?> 
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/companies/index.blade.php ENDPATH**/ ?>