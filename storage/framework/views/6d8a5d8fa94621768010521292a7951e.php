

<?php $__env->startSection('title', 'Sponsor Us'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-slate-900 py-24 mb-16 group">
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px] opacity-40 group-hover:opacity-60 transition-opacity"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-fade-in-up text-white font:['Playfair_Display']">
                <span class="text-indigo-400">Sponsor</span> Our Platform
            </h1>
            <p class="text-xl md:text-2xl text-indigo-100/60 max-w-3xl mx-auto mb-10 leading-relaxed">
                Support the future of digital learning and gain visibility in our growing community of learners and educators.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#tiers" class="px-8 py-3 bg-white text-slate-900 font-bold rounded-full hover:bg-slate-50 transition duration-300 shadow-lg flex items-center gap-2 hover:-translate-y-1 transform">
                    View Sponsorship Tiers
                </a>
                <a href="<?php echo e(route('contact.show')); ?>" class="px-8 py-3 bg-transparent border-2 border-white/20 text-white font-bold rounded-full hover:bg-white/10 transition duration-300">Contact Us</a>
            </div>
        </div>
    </div>

    <!-- Why Sponsor Section -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 p-12 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Sponsor Us?</h2>
                <div class="prose prose-blue text-gray-600 space-y-4">
                    <p>By sponsoring our platform, you're not just supporting education—you're investing in the future of digital learning.</p>
                    <p>Sponsors gain brand visibility across our platform, access to our community of learners and educators, and exclusive partnership opportunities.</p>
                </div>
            </div>
            <div class="md:w-1/2 bg-indigo-600 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-700 to-blue-800 opacity-90 group-hover:scale-110 transition duration-700"></div>
                <div class="relative z-10 h-full flex items-center justify-center p-12 text-center">
                    <div class="text-white">
                        <div class="text-6xl font-bold mb-2">10K+</div>
                        <div class="text-indigo-200 uppercase tracking-widest font-semibold">Active Learners</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sponsorship Tiers -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-24" id="tiers">
        <h3 class="text-3xl font-bold text-gray-900 mb-12 text-center">Sponsorship Tiers</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Bronze Tier -->
            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow">
                <div class="text-amber-700 text-4xl mb-4">🥉</div>
                <h4 class="text-2xl font-bold text-gray-800 mb-4">Bronze</h4>
                <div class="text-3xl font-bold text-gray-900 mb-6">$500<span class="text-base text-gray-500 font-normal">/month</span></div>
                <ul class="space-y-3 text-gray-600 mb-8">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Logo on website footer</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Social media mentions</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Quarterly newsletter feature</span>
                    </li>
                </ul>
                <a href="<?php echo e(route('contact.show')); ?>" class="block text-center px-6 py-3 bg-gray-100 text-gray-800 font-bold rounded-xl hover:bg-gray-200 transition duration-300">Get Started</a>
            </div>

            <!-- Silver Tier -->
            <div class="bg-white border-2 border-indigo-500 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-shadow transform scale-105">
                <div class="text-gray-400 text-4xl mb-4">🥈</div>
                <h4 class="text-2xl font-bold text-gray-800 mb-4">Silver</h4>
                <div class="text-3xl font-bold text-gray-900 mb-6">$1,500<span class="text-base text-gray-500 font-normal">/month</span></div>
                <ul class="space-y-3 text-gray-600 mb-8">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>All Bronze benefits</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Homepage logo placement</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Sponsored blog post</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Monthly analytics report</span>
                    </li>
                </ul>
                <a href="<?php echo e(route('contact.show')); ?>" class="block text-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition duration-300">Most Popular</a>
            </div>

            <!-- Gold Tier -->
            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow">
                <div class="text-yellow-500 text-4xl mb-4">🥇</div>
                <h4 class="text-2xl font-bold text-gray-800 mb-4">Gold</h4>
                <div class="text-3xl font-bold text-gray-900 mb-6">$3,000<span class="text-base text-gray-500 font-normal">/month</span></div>
                <ul class="space-y-3 text-gray-600 mb-8">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>All Silver benefits</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Dedicated sponsor page</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Webinar partnership</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Priority support access</span>
                    </li>
                </ul>
                <a href="<?php echo e(route('contact.show')); ?>" class="block text-center px-6 py-3 bg-gray-100 text-gray-800 font-bold rounded-xl hover:bg-gray-200 transition duration-300">Contact Us</a>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="bg-indigo-600 rounded-3xl p-12 text-center text-white shadow-2xl shadow-indigo-200">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 italic">Custom Sponsorship Package?</h2>
            <p class="text-indigo-100 mb-8 max-w-2xl mx-auto">We're open to creating custom sponsorship packages that align with your goals. Let's discuss how we can work together.</p>
            <a href="<?php echo e(route('contact.show')); ?>" class="inline-block px-10 py-4 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition duration-300 shadow-lg hover:-translate-y-1 transform">Contact the Team</a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/sponsor.blade.php ENDPATH**/ ?>