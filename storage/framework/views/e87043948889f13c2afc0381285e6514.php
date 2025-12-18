

<?php $__env->startSection('title', 'About Us'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-blue-900 to-indigo-800 text-white py-24 mb-16">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-fade-in-up">
                Empowering <span class="text-blue-400">Future</span> Minds
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto mb-10 leading-relaxed">
                We are more than just an LMS. We are a community dedicated to lifelong learning, innovation, and technical excellence.
            </p>
            <div class="flex justify-center gap-4">
                <a href="<?php echo e(route('blogs.index')); ?>" class="px-8 py-3 bg-white text-blue-900 font-bold rounded-full hover:bg-blue-50 transition duration-300 shadow-lg">Our Blog</a>
                <a href="<?php echo e(route('contact.show')); ?>" class="px-8 py-3 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-900 transition duration-300">Get in Touch</a>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 p-12 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Journey</h2>
                <div class="prose prose-blue text-gray-600 space-y-4">
                    <p>Founded with the vision of making high-quality education accessible to everyone, our platform has evolved into a robust ecosystem for students and trainers alike.</p>
                    <p>We believe that learning should be engaging, interactive, and tailored to individual needs. Our LMS provides the tools to make this happen.</p>
                </div>
            </div>
            <div class="md:w-1/2 bg-blue-600 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-700 to-indigo-800 opacity-90 group-hover:scale-110 transition duration-700"></div>
                <div class="relative z-10 h-full flex items-center justify-center p-12 text-center">
                    <div class="text-white">
                        <div class="text-6xl font-bold mb-2">10k+</div>
                        <div class="text-blue-200 uppercase tracking-widest font-semibold">Active Learners</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Explained Content Sections -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
        <div class="bg-white border border-gray-100 rounded-2xl p-8 md:p-12 shadow-sm">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-4">Understanding Our Platform</h3>
            
            <div class="space-y-12">
                <!-- Section 1 -->
                <div class="flex gap-6">
                    <div class="hidden sm:block text-blue-600 pt-1">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">The LMS Advantage</h4>
                        <div class="text-gray-600 leading-relaxed space-y-4">
                            <p>Our Learning Management System is built on the latest technologies to ensure speed, security, and a seamless user experience. We provides features like:</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Interactive course modules</li>
                                <li>Real-time progress tracking</li>
                                <li>Community-driven discussion forums</li>
                                <li>Direct trainer-student communication</li>
                            </ul>
                            <p>For more details on how we handle your data, please visit our <a href="#" class="text-blue-600 hover:underline font-medium">Privacy Policy</a>.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="flex gap-6">
                    <div class="hidden sm:block text-blue-600 pt-1">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Our Commitment to Quality</h4>
                        <div class="text-gray-600 leading-relaxed">
                            <p>We vet every trainer and course material to ensure it meets our high standards. We believe in transparency and continuous improvement.</p>
                            <p class="mt-4">By using our platform, you agree to our <a href="#" class="text-blue-600 hover:underline font-medium">Terms of Service</a> and our <a href="#" class="text-blue-600 hover:underline font-medium">Community Guidelines</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="bg-blue-600 rounded-3xl p-12 text-center text-white shadow-2xl shadow-blue-200">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 italic">Ready to start your learning journey?</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Join thousands of students who are already mastering new skills on our platform.</p>
            <a href="/" class="inline-block px-10 py-4 bg-white text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition duration-300 shadow-lg hover:-translate-y-1 transform">Create Free Account</a>
        </div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/about.blade.php ENDPATH**/ ?>