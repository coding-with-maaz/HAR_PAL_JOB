

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen">
    <!-- Hero Section -->
    <div class="relative bg-gray-800">
        <div class="absolute inset-0">
            <?php if(isset($settings['blog_hero_image'])): ?>
                <img class="w-full h-full object-cover" src="<?php echo e(asset('storage/' . $settings['blog_hero_image'])); ?>" alt="Blog hero image">
            <?php else: ?>
                 <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Default blog hero">
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 via-purple-700 to-indigo-900 mix-blend-multiply opacity-80"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Our Blog</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                Stay updated with the latest industry news, career tips, and company insights.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 xl:gap-12">
            <!-- Blog Posts -->
            <div class="lg:col-span-8">
                <div class="space-y-8 sm:space-y-12">
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <article class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                            <?php if($post->featured_image): ?>
                                <div class="aspect-w-16 aspect-h-9 w-full relative">
                                    <img class="object-cover" src="<?php echo e(asset('storage/' . $post->featured_image)); ?>" alt="<?php echo e($post->title); ?>">
                                    <a href="<?php echo e(route('blog.category', $post->category)); ?>" class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">
                                        <i class="fas fa-folder-open mr-1.5 opacity-75"></i> <?php echo e($post->category->name); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <?php if(!$post->featured_image): ?>
                                         <a href="<?php echo e(route('blog.category', $post->category)); ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mr-3">
                                            <?php echo e($post->category->name); ?>

                                        </a>
                                        <span class="mr-3">•</span>
                                        <?php endif; ?>
                                        
                                        <span><i class="far fa-calendar-alt mr-1.5 opacity-75"></i><?php echo e($post->published_at->format('M d, Y')); ?></span>
                                        <span class="mx-2">•</span>
                                        <span><i class="far fa-user mr-1.5 opacity-75"></i><?php echo e($post->author->name); ?></span>
                                    </div>
                                    <h2 class="mt-1 text-xl sm:text-2xl font-semibold text-gray-900">
                                        <a href="<?php echo e(route('blog.show', $post)); ?>" class="hover:text-indigo-600 transition-colors duration-200">
                                            <?php echo e($post->title); ?>

                                        </a>
                                    </h2>
                                    <p class="mt-3 text-base text-gray-600 line-clamp-3"><?php echo e($post->excerpt ?: Str::limit(strip_tags($post->content), 160)); ?></p>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3">
                                    <div class="flex flex-wrap gap-2">
                                        <?php $__currentLoopData = $post->tags->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('blog.tag', $tag)); ?>" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200 hover:border-gray-300 transition-colors">
                                                #<?php echo e($tag->name); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <a href="<?php echo e(route('blog.show', $post)); ?>" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group">
                                        Read More <i class="fas fa-arrow-right ml-1.5 group-hover:translate-x-1 transition-transform duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-16 bg-white rounded-lg shadow">
                            <div class="text-gray-500">
                                <div class="w-16 h-16 mx-auto rounded-full bg-indigo-50 flex items-center justify-center mb-4">
                                    <i class="far fa-newspaper text-3xl text-indigo-400"></i>
                                </div>
                                <h3 class="text-xl font-medium text-gray-900">No blog posts found</h3>
                                <p class="mt-2 text-base">Check back later for new articles and insights.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12 sm:mt-16">
                    <?php echo e($posts->links()); ?>

                </div>
            </div>

            <!-- Sidebar -->
            <aside class="hidden lg:block lg:col-span-4">
                <div class="sticky top-6 space-y-6">
                    <!-- Categories -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('blog.category', $category->slug)); ?>" 
                                       class="flex items-center justify-between text-gray-600 hover:text-indigo-600 p-2 rounded-md hover:bg-gray-50 transition-colors duration-150 group">
                                        <span class="group-hover:font-medium"><?php echo e($category->name); ?></span>
                                        <span class="bg-gray-100 group-hover:bg-indigo-100 group-hover:text-indigo-700 text-gray-600 text-xs font-medium px-2 py-0.5 rounded-full transition-colors duration-150">
                                            <?php echo e($category->posts_count); ?>

                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog.tag', $tag)); ?>" 
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 border border-gray-200 hover:border-indigo-200 transition-colors duration-150">
                                    #<?php echo e($tag->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PHP_BACKEND_JOB_2_DAY\resources\views/blog/index.blade.php ENDPATH**/ ?>