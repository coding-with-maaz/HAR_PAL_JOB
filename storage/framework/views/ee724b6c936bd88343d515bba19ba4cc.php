

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Apply for: <?php echo e($jobPosting->title); ?></h1>
                <div class="mt-2 text-gray-500">
                    <?php echo e($jobPosting->company->name); ?> • <?php echo e($jobPosting->location); ?>

                </div>
                <?php if($jobPosting->application_deadline): ?>
                    <div class="mt-2 text-sm text-gray-500">
                        Application Deadline: <?php echo e($jobPosting->application_deadline->format('F j, Y')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <form action="<?php echo e(route('jobs.submit-application', $jobPosting)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Contact Information -->
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h2>
                    <div class="space-y-4">
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo e(old('phone', auth()->user()->phone)); ?>"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter your phone number">
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Resume Upload -->
                <div>
                    <label for="resume" class="block text-sm font-medium text-gray-700">Resume *</label>
                    <div class="mt-1">
                        <input type="file" name="resume" id="resume" required
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                               accept=".pdf,.doc,.docx">
                    </div>
                    <p class="mt-1 text-sm text-gray-500">PDF, DOC, or DOCX up to 2MB</p>
                    <?php $__errorArgs = ['resume'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php $__env->startPush('scripts'); ?>
                <script>
                    function validateFile(input) {
                        const fileError = document.getElementById('fileError');
                        const file = input.files[0];
                        
                        if (file) {
                            // Check file size (2MB)
                            if (file.size > 2 * 1024 * 1024) {
                                fileError.textContent = 'File size must be less than 2MB';
                                fileError.classList.remove('hidden');
                                input.value = '';
                                return;
                            }
                            
                            // Check file type
                            const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                            if (!validTypes.includes(file.type)) {
                                fileError.textContent = 'Please upload a PDF, DOC, or DOCX file';
                                fileError.classList.remove('hidden');
                                input.value = '';
                                return;
                            }
                            
                            fileError.classList.add('hidden');
                        }
                    }
                </script>
                <?php $__env->stopPush(); ?>

                <!-- Cover Letter -->
                <div>
                    <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover Letter *</label>
                    <div class="mt-1">
                        <textarea name="cover_letter" id="cover_letter" rows="6" required
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Write a cover letter explaining why you are a good fit for this position..."><?php echo e(old('cover_letter')); ?></textarea>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Minimum 50 characters</p>
                    <?php $__errorArgs = ['cover_letter'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Additional Questions -->
                <?php if($jobPosting->additional_questions): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Additional Questions</label>
                        <div class="mt-4 space-y-4">
                            <?php $__currentLoopData = json_decode($jobPosting->additional_questions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700"><?php echo e($question); ?></label>
                                    <div class="mt-1">
                                        <textarea name="additional_questions[<?php echo e($index); ?>]" rows="3"
                                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                  required><?php echo e(old("additional_questions.$index")); ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="<?php echo e(route('jobs.show', $jobPosting)); ?>" 
                       class="mr-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/applications/create.blade.php ENDPATH**/ ?>