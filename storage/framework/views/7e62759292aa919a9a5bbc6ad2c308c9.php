

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
                    <p class="text-sm text-green-700"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900"><?php echo e($job->title); ?></h1>
            <div class="mt-2 flex items-center">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($job->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                    <?php echo e($job->is_active ? 'Active' : 'Inactive'); ?>

                </span>
                <span class="ml-2 text-sm text-gray-500">Posted <?php echo e($job->created_at->format('M d, Y')); ?></span>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo e(route('employer.jobs.edit', $job)); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="<?php echo e(route('employer.jobs.toggle', $job)); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z" />
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                    <?php echo e($job->is_active ? 'Deactivate' : 'Activate'); ?>

                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Job Details</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?php echo e($job->location); ?>

                        <?php if($job->remote_allowed): ?>
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Remote Available</span>
                        <?php endif; ?>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Employment Type</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo e(ucfirst($job->employment_type)); ?></dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Experience Level</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo e(ucfirst($job->experience_level)); ?></dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Department</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo e($job->department); ?></dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Salary Range</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?php if($job->salary_min && $job->salary_max): ?>
                            $<?php echo e(number_format($job->salary_min)); ?> - $<?php echo e(number_format($job->salary_max)); ?> per year
                        <?php else: ?>
                            Not specified
                        <?php endif; ?>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Application Deadline</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?php if($job->application_deadline): ?>
                            <?php echo e($job->application_deadline->format('M d, Y')); ?>

                        <?php else: ?>
                            Not specified
                        <?php endif; ?>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Job Description</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="prose max-w-none">
                <?php echo nl2br(e($job->description)); ?>

            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Requirements</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex flex-wrap gap-2">
                <?php if($job->requirements): ?>
                    <?php
                        $requirements = is_array(json_decode($job->requirements, true)) ? json_decode($job->requirements, true) : [$job->requirements];
                    ?>
                    <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <?php echo e($requirement); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-gray-500">No requirements listed</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if($job->responsibilities): ?>
    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Responsibilities</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="prose max-w-none">
                <?php echo nl2br(e($job->responsibilities)); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Skills Required</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex flex-wrap gap-2">
                <?php if($job->skills_required): ?>
                    <?php $__currentLoopData = json_decode($job->skills_required); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <?php echo e($skill); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-gray-500">No specific skills listed</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Benefits</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex flex-wrap gap-2">
                <?php if($job->benefits): ?>
                    <?php
                        $benefits = is_array(json_decode($job->benefits, true)) ? json_decode($job->benefits, true) : [$job->benefits];
                    ?>
                    <?php $__currentLoopData = $benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <?php echo e($benefit); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-gray-500">No benefits listed</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Applications</h3>
            <p class="mt-1 text-sm text-gray-500"><?php echo e($job->applications->count()); ?> total applications</p>
        </div>
        <div class="border-t border-gray-200">
            <?php if($job->applications->count() > 0): ?>
                <ul class="divide-y divide-gray-200">
                    <?php $__currentLoopData = $job->applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900"><?php echo e($application->user->name); ?></h4>
                                    <p class="text-sm text-gray-500">Applied <?php echo e($application->created_at->format('M d, Y')); ?></p>
                                </div>
                                <a href="<?php echo e(route('employer.applications.show', $application)); ?>" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View Application
                                </a>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <div class="px-4 py-5 sm:px-6 text-center">
                    <p class="text-sm text-gray-500">No applications received yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/employer/jobs/show.blade.php ENDPATH**/ ?>