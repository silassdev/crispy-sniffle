<div>
    
    <form wire:submit.prevent="openModal" class="relative group/input">
        <input wire:model="email" type="email" placeholder="name@company.com" 
               class="w-full px-6 py-4 rounded-2xl bg-white/5 border border-white/10 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500/50 focus:bg-white/10 transition-all duration-300" />
        
        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-500 group-focus-within/input:text-emerald-500">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
        </div>

        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
            <span class="text-rose-500 text-xs mt-1 block"><?php echo e($message); ?></span> 
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

        <button type="submit" class="w-full mt-3 py-4 rounded-2xl bg-emerald-600 text-white font-extrabold hover:bg-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-900/40 hover:-translate-y-1 transform flex items-center justify-center gap-2">
            <span wire:loading.remove wire:target="openModal">Get Updates</span>
            <span wire:loading wire:target="openModal">Processing...</span>
        </button>
    </form>


    <!--[if BLOCK]><![endif]--><?php if($showModal): ?>
    <div class="fixed inset-0 z-[100] flex items-center justify-center px-4"
         x-data
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        

        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" wire:click="$set('showModal', false)"></div>


        
        <div class="relative w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all p-8 md:p-10"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95">
            
             <!-- Decorative elements -->
             <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
             <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

             <div class="relative z-10">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100/50 text-emerald-600 mb-6 shadow-sm">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 font-['Playfair_Display']">Customize Your Feed</h3>
                    <p class="text-slate-500 mt-2 text-sm leading-relaxed">
                        Hey <span class="text-emerald-600 font-semibold"><?php echo e($email); ?></span>! To make sure we send you relevant content, please select up to <span class="font-bold text-slate-900">5 topics</span> you're interested in.
                    </p>
                </div>

                <!-- Interests Grid -->
                <div class="grid grid-cols-2 gap-3 mb-8">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $availableInterests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button wire:click="toggleInterest('<?php echo e($key); ?>')"
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                    'px-4 py-3 rounded-xl text-sm font-bold transition-all duration-200 border text-center flex items-center justify-center gap-2',
                                    'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-200 transform scale-[1.02]' => in_array($key, $interests),
                                    'bg-white text-slate-500 border-slate-200 hover:border-indigo-300 hover:bg-indigo-50' => !in_array($key, $interests),
                                    'opacity-50 cursor-not-allowed' => count($interests) >= 5 && !in_array($key, $interests)
                                ]); ?>"
                                <?php if(count($interests) >= 5 && !in_array($key, $interests)): ?> disabled <?php endif; ?>>
                            
                            <!--[if BLOCK]><![endif]--><?php if(in_array($key, $interests)): ?>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <?php echo e($label); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="space-y-3">
                    <button wire:click="subscribe" 
                            class="w-full py-4 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition-all duration-300 shadow-xl flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="subscribe">Confirm Subscription</span>
                        <span wire:loading wire:target="subscribe">Subscribing...</span>
                    </button>
                    <button wire:click="$set('showModal', false)" 
                            class="w-full py-3 rounded-xl text-slate-400 font-bold hover:text-slate-600 transition-colors text-sm">
                        Maybe later
                    </button>
                </div>
             </div>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/newsletter-subscription.blade.php ENDPATH**/ ?>