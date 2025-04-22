

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

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Job Posting</h1>
        <a href="<?php echo e(route('admin.jobs.show', $job)); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Job
        </a>
    </div>

    <form action="<?php echo e(route('admin.jobs.update', $job)); ?>" method="POST" class="space-y-6" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Job Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Update the job posting details.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                            <input type="text" name="title" id="title" value="<?php echo e(old('title', $job->title)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo e(old('description', $job->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="requirements" class="block text-sm font-medium text-gray-700">Requirements</label>
                            <textarea name="requirements" id="requirements" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo e(old('requirements', $job->requirements)); ?></textarea>
                            <?php $__errorArgs = ['requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="responsibilities" class="block text-sm font-medium text-gray-700">Responsibilities</label>
                            <textarea name="responsibilities" id="responsibilities" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo e(old('responsibilities', $job->responsibilities)); ?></textarea>
                            <?php $__errorArgs = ['responsibilities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="<?php echo e(old('location', $job->location)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                            <select name="employment_type" id="employment_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="full-time" <?php echo e(old('employment_type', $job->employment_type) == 'full-time' ? 'selected' : ''); ?>>Full-time</option>
                                <option value="part-time" <?php echo e(old('employment_type', $job->employment_type) == 'part-time' ? 'selected' : ''); ?>>Part-time</option>
                                <option value="contract" <?php echo e(old('employment_type', $job->employment_type) == 'contract' ? 'selected' : ''); ?>>Contract</option>
                                <option value="temporary" <?php echo e(old('employment_type', $job->employment_type) == 'temporary' ? 'selected' : ''); ?>>Temporary</option>
                                <option value="internship" <?php echo e(old('employment_type', $job->employment_type) == 'internship' ? 'selected' : ''); ?>>Internship</option>
                            </select>
                            <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="experience_level" class="block text-sm font-medium text-gray-700">Experience Level</label>
                            <select name="experience_level" id="experience_level" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="entry" <?php echo e(old('experience_level', $job->experience_level) == 'entry' ? 'selected' : ''); ?>>Entry Level</option>
                                <option value="mid" <?php echo e(old('experience_level', $job->experience_level) == 'mid' ? 'selected' : ''); ?>>Mid Level</option>
                                <option value="senior" <?php echo e(old('experience_level', $job->experience_level) == 'senior' ? 'selected' : ''); ?>>Senior Level</option>
                                <option value="executive" <?php echo e(old('experience_level', $job->experience_level) == 'executive' ? 'selected' : ''); ?>>Executive Level</option>
                            </select>
                            <?php $__errorArgs = ['experience_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                            <div class="mt-1">
                                <input type="text" name="department" id="department" value="<?php echo e(old('department', $job->department)); ?>"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="e.g., Engineering">
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 required-field">Category *</label>
                            <div class="mt-1">
                                <select name="category_id" id="category_id" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select a category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $job->category_id) == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="salary_min" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                            <input type="number" name="salary_min" id="salary_min" value="<?php echo e(old('salary_min', $job->salary_min)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['salary_min'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="salary_max" class="block text-sm font-medium text-gray-700">Maximum Salary</label>
                            <input type="number" name="salary_max" id="salary_max" value="<?php echo e(old('salary_max', $job->salary_max)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['salary_max'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="skills_required" class="block text-sm font-medium text-gray-700">Skills Required (comma-separated)</label>
                            <input type="text" name="skills_required" id="skills_required" value="<?php echo e(old('skills_required', implode(', ', json_decode($job->skills_required)))); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['skills_required'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="benefits" class="block text-sm font-medium text-gray-700">Benefits (comma-separated)</label>
                            <input type="text" name="benefits" id="benefits" value="<?php echo e(old('benefits', implode(', ', json_decode($job->benefits)))); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['benefits'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="application_deadline" class="block text-sm font-medium text-gray-700">Application Deadline</label>
                            <input type="date" name="application_deadline" id="application_deadline" value="<?php echo e(old('application_deadline', $job->application_deadline->format('Y-m-d'))); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <?php $__errorArgs = ['application_deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-center">
                                <input type="checkbox" name="remote_allowed" id="remote_allowed" <?php echo e(old('remote_allowed', $job->remote_allowed) ? 'checked' : ''); ?> class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remote_allowed" class="ml-2 block text-sm text-gray-900">Remote Work Allowed</label>
                            </div>
                            <?php $__errorArgs = ['remote_allowed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', $job->is_active) ? 'checked' : ''); ?>

                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-3">
                                    <span class="block text-sm font-medium text-gray-700">Active Job Posting</span>
                                    <span class="block text-sm text-gray-500">Inactive jobs won't appear in search results</span>
                                </label>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 required-field">Status *</label>
                                <div class="mt-1">
                                    <select name="status" id="status" required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="active" <?php echo e(old('status', $job->status) == 'active' ? 'selected' : ''); ?>>Active</option>
                                        <option value="inactive" <?php echo e(old('status', $job->status) == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">SEO Settings</h3>
                    <p class="mt-1 text-sm text-gray-500">Optimize your job posting for search engines.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="<?php echo e(old('meta_title', $job->meta_title)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">Recommended length: 50-60 characters</p>
                            <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo e(old('meta_description', $job->meta_description)); ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Recommended length: 150-160 characters</p>
                            <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="<?php echo e(old('meta_keywords', $job->meta_keywords)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">Separate keywords with commas</p>
                            <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="og_title" class="block text-sm font-medium text-gray-700">Open Graph Title</label>
                            <input type="text" name="og_title" id="og_title" value="<?php echo e(old('og_title', $job->og_title)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">Title for social media sharing</p>
                            <?php $__errorArgs = ['og_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="og_description" class="block text-sm font-medium text-gray-700">Open Graph Description</label>
                            <textarea name="og_description" id="og_description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo e(old('og_description', $job->og_description)); ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Description for social media sharing</p>
                            <?php $__errorArgs = ['og_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="og_image" class="block text-sm font-medium text-gray-700">Open Graph Image</label>
                            <div class="mt-1 flex items-center">
                                <input type="file" name="og_image" id="og_image" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <?php if($job->og_image): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('storage/' . $job->og_image)); ?>" alt="Current OG Image" class="h-20 w-20 object-cover rounded">
                                </div>
                            <?php endif; ?>
                            <p class="mt-1 text-sm text-gray-500">Recommended size: 1200x630 pixels</p>
                            <?php $__errorArgs = ['og_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="canonical_url" class="block text-sm font-medium text-gray-700">Canonical URL</label>
                            <input type="text" name="canonical_url" id="canonical_url" value="<?php echo e(old('canonical_url', $job->canonical_url)); ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">The preferred URL for this page</p>
                            <?php $__errorArgs = ['canonical_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <label for="robots" class="block text-sm font-medium text-gray-700">Robots Meta Tag</label>
                            <select name="robots" id="robots" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="index,follow" <?php echo e(old('robots', $job->robots) == 'index,follow' ? 'selected' : ''); ?>>Index, Follow</option>
                                <option value="noindex,follow" <?php echo e(old('robots', $job->robots) == 'noindex,follow' ? 'selected' : ''); ?>>No Index, Follow</option>
                                <option value="index,nofollow" <?php echo e(old('robots', $job->robots) == 'index,nofollow' ? 'selected' : ''); ?>>Index, No Follow</option>
                                <option value="noindex,nofollow" <?php echo e(old('robots', $job->robots) == 'noindex,nofollow' ? 'selected' : ''); ?>>No Index, No Follow</option>
                            </select>
                            <?php $__errorArgs = ['robots'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-span-6">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" <?php echo e(old('is_featured', $job->is_featured) ? 'checked' : ''); ?> class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-900">Feature this job on homepage</label>
                            </div>
                            <?php $__errorArgs = ['is_featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="<?php echo e(route('admin.jobs.show', $job)); ?>" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Job
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/admin/jobs/edit.blade.php ENDPATH**/ ?>