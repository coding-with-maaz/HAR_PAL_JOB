

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <?php if(session('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        <?php echo e(session('success')); ?>

                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!$company): ?>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Your company profile is not found. Please contact support if you believe this is an error.
                    </p>
                </div>
            </div>
        </div>
    <?php elseif($company->status === 'pending'): ?>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Your company profile is pending approval. Once approved, you'll be able to post jobs and manage applications.
                    </p>
                </div>
            </div>
        </div>
    <?php elseif($company->status === 'rejected'): ?>
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">
                        Your company profile has been rejected. Please contact support for more information.
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($company && $company->status === 'approved'): ?>
        <!-- Company Profile Summary -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Company Profile</h2>
                    <a href="<?php echo e(route('employer.company.edit', $company)); ?>" class="text-indigo-600 hover:text-indigo-900">
                        <span class="text-sm">Edit Profile</span>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900"><?php echo e($company->name); ?></h3>
                        <p class="mt-1 text-sm text-gray-500"><?php echo e($company->description); ?></p>
                        <div class="mt-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Verified Company
                            </span>
                        </div>
                    </div>
                    <div>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Industry</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($company->industry); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Company Size</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($company->company_size); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Founded</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($company->founded_year); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($company->headquarters); ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Total Jobs</h3>
                <p class="text-3xl font-bold text-indigo-600"><?php echo e($stats['total_jobs']); ?></p>
                <div class="mt-2">
                    <a href="<?php echo e(route('employer.jobs.index')); ?>" class="text-sm text-indigo-600 hover:text-indigo-900">View all jobs →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Active Jobs</h3>
                <p class="text-3xl font-bold text-green-600"><?php echo e($stats['active_jobs']); ?></p>
                <div class="mt-2">
                    <a href="<?php echo e(route('employer.jobs.create')); ?>" class="text-sm text-green-600 hover:text-green-900">Post new job →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Total Applications</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($stats['total_applications']); ?></p>
                <div class="mt-2">
                    <a href="<?php echo e(route('employer.applications.index')); ?>" class="text-sm text-blue-600 hover:text-blue-900">View all applications →</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700">Pending Applications</h3>
                <p class="text-3xl font-bold text-yellow-600"><?php echo e($stats['pending_applications']); ?></p>
                <div class="mt-2">
                    <a href="<?php echo e(route('employer.applications.index', ['status' => 'pending'])); ?>" class="text-sm text-yellow-600 hover:text-yellow-900">Review applications →</a>
                </div>
            </div>
        </div>

        <!-- Recent Job Postings -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Job Postings</h2>
                    <a href="<?php echo e(route('employer.jobs.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Post New Job
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if($recent_jobs->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $recent_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900"><?php echo e($job->title); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo e($job->applications_count ?? 0); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($job->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                <?php echo e($job->is_active ? 'Active' : 'Inactive'); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo e($job->created_at->format('M d, Y')); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="<?php echo e(route('employer.jobs.edit', $job)); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">No job postings yet.</p>
                        <a href="<?php echo e(route('employer.jobs.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Post Your First Job
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Applications</h2>
                    <a href="<?php echo e(route('employer.applications.index')); ?>" class="text-indigo-600 hover:text-indigo-900">
                        <span class="text-sm">View all applications →</span>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if($recent_applications->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $recent_applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo e($application->applicant?->name ?? 'Unknown Applicant'); ?>

                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo e($application->applicant?->email ?? 'No email provided'); ?>

                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo e($application->jobPosting->title); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?php if($application->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                                <?php elseif($application->status === 'interviewed'): ?> bg-blue-100 text-blue-800
                                                <?php elseif($application->status === 'hired'): ?> bg-green-100 text-green-800
                                                <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                                                <?php echo e(ucfirst($application->status)); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo e($application->created_at->format('M d, Y')); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="<?php echo e(route('employer.applications.show', $application)); ?>" class="text-indigo-600 hover:text-indigo-900">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-4">No applications yet.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/employer/dashboard.blade.php ENDPATH**/ ?>