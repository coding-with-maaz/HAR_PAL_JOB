

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="<?php echo e(route('employer.applications.index')); ?>" class="text-indigo-600 hover:text-indigo-900">
            ← Back to Applications
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800"><?php echo e($application->jobPosting->title); ?></h1>
                    <p class="text-gray-600">Applied by <?php echo e($application->applicant?->name ?? 'Unknown Applicant'); ?></p>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                        <?php if($application->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                        <?php elseif($application->status === 'reviewed'): ?> bg-blue-100 text-blue-800
                        <?php elseif($application->status === 'shortlisted'): ?> bg-green-100 text-green-800
                        <?php elseif($application->status === 'rejected'): ?> bg-red-100 text-red-800
                        <?php elseif($application->status === 'hired'): ?> bg-purple-100 text-purple-800
                        <?php endif; ?>">
                        <?php echo e(ucfirst($application->status)); ?>

                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Applicant Information</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="mb-2"><span class="font-medium">Name:</span> <?php echo e($application->applicant?->name ?? 'Unknown Applicant'); ?></p>
                        <p class="mb-2"><span class="font-medium">Email:</span> <?php echo e($application->applicant?->email ?? 'No email provided'); ?></p>
                        <p class="mb-2"><span class="font-medium">Phone:</span> <?php echo e($application->phone ?? 'Not provided'); ?></p>
                        <p class="mb-2"><span class="font-medium">Applied Date:</span> <?php echo e($application->created_at->format('M d, Y')); ?></p>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Application Details</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="mb-2"><span class="font-medium">Cover Letter:</span></p>
                        <p class="text-gray-700"><?php echo e($application->cover_letter ?? 'No cover letter provided'); ?></p>
                    </div>
                </div>
            </div>

            <?php if($application->resume_path): ?>
                <div class="mt-6">
                    <a href="<?php echo e(route('applications.download-resume', $application)); ?>" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Download Resume
                    </a>
                </div>
            <?php endif; ?>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Update Application Status</h2>
                <form action="<?php echo e(route('employer.applications.update-status', $application)); ?>" method="POST" class="flex items-center gap-4">
                    <?php echo csrf_field(); ?>
                    <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="pending" <?php echo e($application->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="reviewed" <?php echo e($application->status === 'reviewed' ? 'selected' : ''); ?>>Reviewed</option>
                        <option value="shortlisted" <?php echo e($application->status === 'shortlisted' ? 'selected' : ''); ?>>Shortlisted</option>
                        <option value="rejected" <?php echo e($application->status === 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                        <option value="hired" <?php echo e($application->status === 'hired' ? 'selected' : ''); ?>>Hired</option>
                    </select>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/employer/applications/show.blade.php ENDPATH**/ ?>