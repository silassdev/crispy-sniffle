

<?php $__env->startSection('title', 'Feedback'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-slate-900 py-24 mb-16 group">
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px] opacity-40 group-hover:opacity-60 transition-opacity"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-fade-in-up text-white font:['Playfair_Display']">
                Your <span class="text-indigo-400">Voice</span> Matters
            </h1>
            <p class="text-xl md:text-2xl text-indigo-100/60 max-w-3xl mx-auto mb-10 leading-relaxed">
                Every piece of feedback helps us improve and deliver a better learning experience for our community.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#feedback-form" class="px-8 py-3 bg-white text-slate-900 font-bold rounded-full hover:bg-slate-50 transition duration-300 shadow-lg flex items-center gap-2 hover:-translate-y-1 transform">
                    Share Feedback
                </a>
                <a href="<?php echo e(route('contact.show')); ?>" class="px-8 py-3 bg-transparent border-2 border-white/20 text-white font-bold rounded-full hover:bg-white/10 transition duration-300">Contact Support</a>
            </div>
        </div>
    </div>

    <!-- Why Feedback Matters -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 p-12 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">We Listen & Improve</h2>
                <div class="prose prose-blue text-gray-600 space-y-4">
                    <p>Your feedback is the foundation of our continuous improvement. We take every suggestion, concern, and idea seriously.</p>
                    <p>Many of our best features and improvements came directly from community feedback. Join us in shaping the future of this platform.</p>
                </div>
            </div>
            <div class="md:w-1/2 bg-blue-600 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-700 to-indigo-800 opacity-90 group-hover:scale-110 transition duration-700"></div>
                <div class="relative z-10 h-full flex items-center justify-center p-12 text-center">
                    <div class="text-white">
                        <div class="text-6xl font-bold mb-2">500+</div>
                        <div class="text-blue-200 uppercase tracking-widest font-semibold">Improvements Made</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Categories -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
        <div class="bg-white border border-gray-100 rounded-2xl p-8 md:p-12 shadow-sm">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-4">How Can We Help?</h3>
            
            <div class="space-y-12">
                <div class="flex gap-6">
                    <div class="hidden sm:block text-blue-600 pt-1">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Course Feedback</h4>
                        <div class="text-gray-600 leading-relaxed">
                            <p>Share your thoughts on course content, difficulty, pacing, or instructor performance. Your input helps us improve educational quality.</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-6">
                    <div class="hidden sm:block text-blue-600 pt-1">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Feature Requests</h4>
                        <div class="text-gray-600 leading-relaxed">
                            <p>Have an idea for a new feature? We'd love to hear it! Describe what you need and how it would improve your experience.</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-6">
                    <div class="hidden sm:block text-blue-600 pt-1">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Report an Issue</h4>
                        <div class="text-gray-600 leading-relaxed">
                            <p>Encountered a bug or technical issue? Let us know the details so we can investigate and fix it quickly.</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-6">
                    <div class="hidden sm:block text-blue-600 pt-1">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4" id="feedback-form">General Comments</h4>
                        <div class="text-gray-600 leading-relaxed">
                            <p>Any other thoughts, suggestions, or comments? We're all ears and appreciate every piece of feedback.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Form CTA -->
    <!-- Feedback Form Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-24" id="feedback-form">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('feedback-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-582920030-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</div>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/feedback.blade.php ENDPATH**/ ?>