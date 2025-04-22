

<?php $__env->startSection('content'); ?>

<div class="bg-gray-100 min-h-screen font-sans"> 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16"> 
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 xl:gap-12"> 
            
            <!-- Main Content Column -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Job Header Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                             
                             <?php if($jobPosting->company->logo_url): ?>
                                <img src="<?php echo e($jobPosting->company->logo_url); ?>" 
                                     alt="<?php echo e($jobPosting->company->name); ?>" 
                                     class="w-16 h-16 sm:w-20 sm:h-20 object-contain rounded-lg border border-gray-100 p-1">
                            <?php else: ?>
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center">
                                    <span class="text-2xl sm:text-3xl font-bold text-indigo-600">
                                        <?php echo e(substr($jobPosting->company->name, 0, 1)); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Title, Company, Tags -->
                        <div class="flex-1 min-w-0">
                            
                            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-1"><?php echo e($jobPosting->title); ?></h1>
                            
                            <a href="<?php echo e(route('companies.show', $jobPosting->company)); ?>" class="text-xl text-gray-600 hover:text-indigo-600 transition-colors duration-150 mb-4 inline-block"><?php echo e($jobPosting->company->name); ?></a>
                            
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                    <i class="fas fa-briefcase w-4 text-center mr-1.5 opacity-75"></i> <?php echo e($jobPosting->employment_type); ?>

                                </span>
                                <?php if($jobPosting->remote_allowed): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                       <i class="fas fa-laptop-house w-4 text-center mr-1.5 opacity-75"></i> Remote
                                    </span>
                                <?php endif; ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <i class="fas fa-user-graduate w-4 text-center mr-1.5 opacity-75"></i> <?php echo e($jobPosting->experience_level); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Details Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 sm:p-8">
                        
                        <div class="prose prose-xl lg:prose-2xl max-w-4xl mx-auto prose-indigo">
                            
                            
                            <?php if($jobPosting->description): ?>
                                <h2>Job Description</h2>
                                
                                <div><?php echo nl2br(e($jobPosting->description)); ?></div> 
                            <?php endif; ?>

                            
                            <?php
                                $requirements = [];
                                if ($jobPosting->requirements) {
                                    try {
                                        // Prioritize JSON decoding
                                        $decoded = json_decode($jobPosting->requirements, true, 512, JSON_THROW_ON_ERROR);
                                        if (is_array($decoded)) {
                                            $requirements = $decoded;
                                        }
                                    } catch (\JsonException $e) {
                                        // Fallback: Split by newline if not valid JSON
                                        $requirements = preg_split('/\r\n|\n|\r/,', $jobPosting->requirements);
                                    }
                                    $requirements = array_map('trim', $requirements);
                                    $requirements = array_filter($requirements); // Remove empty lines/items
                                }
                            ?>
                             <?php if(!empty($requirements)): ?>
                                <h2 class="mt-8">Requirements</h2> 
                                <ul>
                                    <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($requirement); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>

                            
                             <?php
                                $responsibilities = [];
                                if ($jobPosting->responsibilities) {
                                    $responsibilities = preg_split('/\r\n|\n|\r/', $jobPosting->responsibilities);
                                    $responsibilities = array_map('trim', $responsibilities);
                                     // Remove potential list markers like -, *, •
                                    $responsibilities = array_map(function($line) {
                                        return preg_replace('/^[-*•\s]+/u', '', $line);
                                    }, $responsibilities);
                                    $responsibilities = array_filter($responsibilities); // Remove empty lines
                                }
                            ?>
                            <?php if(!empty($responsibilities)): ?>
                                <h2 class="mt-8">Responsibilities</h2>
                               <ul>
                                    <?php $__currentLoopData = $responsibilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $responsibility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($responsibility); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>

                             
                            <?php
                                $benefits = null;
                                if ($jobPosting->benefits) {
                                    try {
                                        $benefits = json_decode($jobPosting->benefits, false, 512, JSON_THROW_ON_ERROR);
                                    } catch (\JsonException $e) {
                                        // Handle error or maybe try splitting by common delimiters if not JSON
                                        $benefits = preg_split('/\r\n|\n|\r/,', $jobPosting->benefits);
                                        $benefits = array_map('trim', $benefits);
                                        $benefits = array_filter($benefits);
                                    }
                                }
                            ?>
                            <?php if(!empty($benefits) && is_array($benefits)): ?>
                                <h2 class="mt-8">Benefits</h2>
                                <ul>
                                    <?php $__currentLoopData = $benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($benefit); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>

                            
                            <?php
                                $skills = [];
                                if ($jobPosting->skills_required) {
                                    if (is_array($jobPosting->skills_required)) {
                                        $skills = $jobPosting->skills_required;
                                    } else {
                                         // Try decoding JSON first
                                        try {
                                             $decodedSkills = json_decode($jobPosting->skills_required, true, 512, JSON_THROW_ON_ERROR);
                                             if (is_array($decodedSkills)) {
                                                 $skills = $decodedSkills;
                                             } else {
                                                 // Fallback to comma separation if not JSON or not array
                                                 $skills = explode(',', $jobPosting->skills_required);
                                             }
                                        } catch (\JsonException $e) {
                                             // Fallback to comma separation if JSON decode fails
                                             $skills = explode(',', $jobPosting->skills_required);
                                        }
                                        $skills = array_map('trim', $skills);
                                        $skills = array_filter($skills);
                                    }
                                }
                            ?>
                             <?php if(!empty($skills)): ?>
                                <div class="not-prose mt-8 pt-6 border-t border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Required Skills</h3>
                                    <div class="flex flex-wrap gap-2">
                                        <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                <?php echo e($skill); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Company Info Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 sm:p-8">
                        
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">About <?php echo e($jobPosting->company->name); ?></h2>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="flex-shrink-0">
                                <?php if($jobPosting->company->logo_url): ?>
                                    <img src="<?php echo e($jobPosting->company->logo_url); ?>" 
                                         alt="<?php echo e($jobPosting->company->name); ?>" 
                                         class="w-16 h-16 object-contain rounded-lg border border-gray-100 p-1">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center">
                                        <span class="text-xl font-bold text-indigo-600">
                                            <?php echo e(substr($jobPosting->company->name, 0, 1)); ?>

                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                
                                <div class="prose prose-indigo max-w-none mb-4">
                                     <p><?php echo e($jobPosting->company->description); ?></p>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <?php if($jobPosting->company->website): ?>
                                        <a href="<?php echo e($jobPosting->company->website_url); ?>" 
                                           target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                            <i class="fas fa-globe mr-2"></i>
                                            Visit Website
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('companies.show', $jobPosting->company)); ?>" 
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                        <i class="fas fa-building mr-2"></i>
                                        View Company Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <aside class="lg:col-span-4">
                <div class="sticky top-6 space-y-6">
                    <!-- Apply Button Card -->
                     <div class="bg-white rounded-xl shadow-lg p-6">
                         <?php if($jobPosting->is_active): ?>
                             <a href="<?php echo e(route('jobs.apply', $jobPosting)); ?>" 
                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                 <i class="fas fa-paper-plane mr-2"></i>
                                 Apply Now
                             </a>
                             <?php if($jobPosting->external_apply_url): ?>
                                 <a href="<?php echo e($jobPosting->external_apply_url); ?>" target="_blank" rel="noopener noreferrer"
                                    class="mt-3 w-full inline-flex items-center justify-center px-6 py-3 border border-indigo-600 rounded-lg shadow-sm text-base font-medium text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                     Apply on Company Site <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                                 </a>
                             <?php endif; ?>
                         <?php else: ?>
                             <button disabled 
                                     class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-gray-500 bg-gray-200 cursor-not-allowed">
                                 <i class="fas fa-ban mr-2"></i>
                                 Application Closed
                             </button>
                         <?php endif; ?>
                     </div>

                    <!-- Job Overview Card -->
                     <div class="bg-white rounded-xl shadow-lg">
                        <div class="border-b border-gray-200 px-6 py-4">
                            
                            <h3 class="text-xl font-semibold text-gray-900">Job Overview</h3>
                        </div>
                        <div class="p-6 space-y-4 text-sm">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt w-5 text-center text-gray-400 mt-1 mr-3 flex-shrink-0"></i>
                                <div>
                                    <span class="text-gray-500">Location</span>
                                    <p class="font-medium text-gray-800"><?php echo e($jobPosting->location); ?></p>
                                </div>
                            </div>
                            <?php if($jobPosting->salary_range): ?> 
                               <div class="flex items-start">
                                    <i class="fas fa-money-bill-wave w-5 text-center text-gray-400 mt-1 mr-3"></i>
                                    <div>
                                        <span class="text-gray-500">Salary</span>
                                        <p class="font-medium text-gray-800"><?php echo e($jobPosting->salary_range); ?></p>
                                    </div>
                                </div>
                            <?php elseif($jobPosting->salary_min && $jobPosting->salary_max): ?>
                                 <div class="flex items-start">
                                    <i class="fas fa-money-bill-wave w-5 text-center text-gray-400 mt-1 mr-3"></i>
                                    <div>
                                        <span class="text-gray-500">Salary</span>
                                        <p class="font-medium text-gray-800">$<?php echo e(number_format($jobPosting->salary_min)); ?> - $<?php echo e(number_format($jobPosting->salary_max)); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                             <div class="flex items-start">
                                <i class="fas fa-briefcase w-5 text-center text-gray-400 mt-1 mr-3 flex-shrink-0"></i>
                                <div>
                                    <span class="text-gray-500">Job Type</span>
                                    <p class="font-medium text-gray-800"><?php echo e($jobPosting->employment_type); ?></p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-user-graduate w-5 text-center text-gray-400 mt-1 mr-3 flex-shrink-0"></i>
                                <div>
                                    <span class="text-gray-500">Experience</span>
                                    <p class="font-medium text-gray-800"><?php echo e($jobPosting->experience_level); ?></p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="far fa-calendar-alt w-5 text-center text-gray-400 mt-1 mr-3 flex-shrink-0"></i>
                                <div>
                                    <span class="text-gray-500">Date Posted</span>
                                    <p class="font-medium text-gray-800"><?php echo e($jobPosting->created_at->format('M d, Y')); ?> (<?php echo e($jobPosting->created_at->diffForHumans()); ?>)</p>
                                </div>
                            </div>
                            <?php if($jobPosting->application_deadline): ?>
                                <div class="flex items-start">
                                    <i class="fas fa-calendar-times w-5 text-center text-red-400 mt-1 mr-3 flex-shrink-0"></i>
                                    <div>
                                        <span class="text-gray-500">Application Deadline</span>
                                        <p class="font-medium text-red-600"><?php echo e($jobPosting->application_deadline->format('M d, Y')); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Similar Jobs Card -->
                    <?php if($relatedJobs->isNotEmpty()): ?>
                        <div class="bg-white rounded-xl shadow-lg">
                            <div class="border-b border-gray-200 px-6 py-4">
                                
                                <h3 class="text-xl font-semibold text-gray-900">Similar Jobs</h3>
                            </div>
                            <div class="divide-y divide-gray-100">
                                <?php $__currentLoopData = $relatedJobs->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similarJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <a href="<?php echo e(route('jobs.show', $similarJob)); ?>" class="block p-4 hover:bg-gray-50 transition-colors duration-150">
                                        <h4 class="font-medium text-gray-900 truncate"><?php echo e($similarJob->title); ?></h4>
                                        <p class="text-sm text-gray-500 truncate mb-1"><?php echo e($similarJob->company->name); ?></p>
                                        <div class="flex flex-wrap items-center gap-1.5 text-xs">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded font-medium bg-indigo-50 text-indigo-700">
                                                <i class="fas fa-briefcase mr-1 opacity-75"></i> <?php echo e($similarJob->employment_type); ?>

                                            </span>
                                            <?php if($similarJob->remote_allowed): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded font-medium bg-green-50 text-green-700">
                                                    <i class="fas fa-laptop-house mr-1 opacity-75"></i> Remote
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                             
                             <?php if(count($relatedJobs) > 5): ?>
                                <div class="px-6 py-3 border-t border-gray-100 text-center">
                                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View More Similar Jobs</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </aside>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/jobs/show.blade.php ENDPATH**/ ?>