

<?php $__env->startSection('title', 'Home — ' . config('app.name')); ?>

<?php $__env->startSection('content'); ?>
<?php
  $studentRegisterUrl = Route::has('register')
    ? route('register', ['role' => 'student'])
    : url('/register?role=student');

  $trainerRegisterUrl = Route::has('register')
    ? route('register', ['role' => 'trainer'])
    : url('/register?role=trainer');

  $loginUrl = Route::has('login') ? route('login') : url('/login');

  $youtubeId = env('HERO_VIDEO_ID', 'dQw4w9WgXcQ');
?>

<section class="pt-10 pb-12 bg-gradient-to-b from-white to-gray-50">
  <style>
    /* safe, plain CSS (no @apply) */
    .blob-float { animation: floatY 6s ease-in-out infinite; }
    @keyframes floatY { 0%{transform:translateY(0)}50%{transform:translateY(-8px)}100%{transform:translateY(0)} }

    .marquee {
      display:flex;
      gap:1rem;
      align-items:center;
      will-change:transform;
      animation: marquee 18s linear infinite;
    }
    @keyframes marquee {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    /* keep marquee pausable on hover/focus */
    .marquee-wrap:hover .marquee,
    .marquee-wrap:focus-within .marquee { animation-play-state: paused; }

    /* simple svg draw */
    .stroke-draw { stroke-dasharray: 200; stroke-dashoffset: 200; animation: draw 1s ease forwards; }
    @keyframes draw { to { stroke-dashoffset: 0; } }

    /* video thumbnail mask */
    .video-thumb { background: linear-gradient(180deg, rgba(0,0,0,0.12), rgba(0,0,0,0.22)); }
    .play-btn {
      width:56px; height:56px; border-radius:999px; background:white; display:inline-flex; align-items:center; justify-content:center;
      box-shadow: 0 6px 18px rgba(2,6,23,0.12);
    }
  </style>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
      
      <div class="space-y-6">
        <div class="inline-flex items-center gap-3">
          <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-semibold">LMS — Live</span>
          <span class="text-xs text-gray-500">Open • Secure • Collaborative</span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight">
          Teach. Learn. Launch.  
          <span class="block text-indigo-600 mt-1">Powerful courses made simple.</span>
        </h1>

        <p class="text-gray-600 max-w-xl">
          Run live classes, publish resources, and track learner progress — a modern LMS built with web-first design and real-time features. Fast to set up, easy to scale.
        </p>

        <div class="flex flex-wrap gap-3">
          <a href="<?php echo e($studentRegisterUrl); ?>" class="inline-flex items-center px-5 py-3 rounded-md bg-indigo-600 text-white font-medium shadow">Get started (Student)</a>
          <a href="<?php echo e($trainerRegisterUrl); ?>" class="inline-flex items-center px-5 py-3 rounded-md bg-white border border-gray-200 text-gray-700 font-medium shadow-sm">Apply as Trainer</a>
          <a href="<?php echo e($loginUrl); ?>" class="inline-flex items-center px-4 py-3 rounded-md text-sm text-gray-600">Login</a>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3">
          <div class="rounded-lg border overflow-hidden bg-white shadow-sm p-3 flex items-center gap-3">
            
            <div class="w-20 h-12 rounded-md bg-gradient-to-br from-indigo-50 to-teal-50 flex items-center justify-center blob-float shrink-0">
              <svg width="56" height="34" viewBox="0 0 56 34" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="1.5" y="1.5" width="53" height="31" rx="6" stroke="#C7D2FE" stroke-width="2" />
                <path class="stroke-draw" d="M14 20 C18 14, 38 14, 42 20" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="28" cy="14" r="6" fill="#A78BFA" fill-opacity="0.12" stroke="#7C3AED" stroke-width="1.2"/>
                <polygon points="26,12 26,16 30,14" fill="#7C3AED" />
              </svg>
            </div>

            <div class="flex-1">
              <div class="text-sm font-semibold">Live demo</div>
              <div class="text-xs text-gray-500">Watch a short walk-through of our platform</div>
            </div>
          </div>

          
          <div x-data="{ open: false }" class="rounded-lg overflow-hidden bg-black/5 border shadow-sm">
            <template x-if="!open">
              <button @click="open = true" class="w-full aspect-[16/9] video-thumb relative flex items-center justify-center focus:outline-none">
                
                <img src="https://img.youtube.com/vi/<?php echo e($youtubeId); ?>/maxresdefault.jpg"
                     alt="Intro video"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                <span class="play-btn" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#111827" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v18l15-9L5 3z"/></svg>
                </span>
              </button>
            </template>

            <template x-if="open">
              <div class="w-full aspect-[16/9]">
                <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?php echo e($youtubeId); ?>?autoplay=1&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen title="Intro video"></iframe>
              </div>
            </template>
          </div>
        </div>

      </div>

      
      <div class="space-y-6">
        <div class="rounded-2xl p-6 bg-white shadow-lg border relative overflow-hidden">
          
          <div class="w-full h-56 sm:h-64 relative">
            <svg viewBox="0 0 600 360" class="w-full h-full" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
              <defs>
                <linearGradient id="A" x1="0" x2="1"><stop offset="0" stop-color="#06b6d4"/><stop offset="1" stop-color="#7c3aed"/></linearGradient>
              </defs>

              <g transform="translate(0,0)">
                <ellipse cx="320" cy="200" rx="210" ry="100" fill="url(#A)" opacity="0.09" class="blob-float" />
                <rect x="60" y="40" width="260" height="180" rx="16" fill="white" stroke="#E6E9F2" stroke-width="1.5" />
                <rect x="340" y="70" width="180" height="120" rx="12" fill="#F8FAFF" stroke="#E6E9F2" />
                <circle cx="420" cy="130" r="28" fill="#7C3AED" opacity="0.12" />
                <path d="M90 110 H300" stroke="#E6E9F2" stroke-width="5" stroke-linecap="round" />
                <path d="M90 140 H240" stroke="#E6E9F2" stroke-width="5" stroke-linecap="round" />
                <g transform="translate(360,90)">
                  <path d="M16 6 L46 26 L16 46 V6 Z" fill="#06b6d4" />
                </g>
              </g>
            </svg>

            
            <div class="absolute top-4 right-4 bg-white/90 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">Live • 3 ongoing</div>
          </div>

          
          <div class="mt-4 marquee-wrap overflow-hidden">
            <div class="marquee" aria-hidden="true" style="width:200%">
              
              <?php
                $items = [
                  ['type'=>'icon','svg'=> '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 20v-6M12 4v6" /></svg>'],
                  ['type'=>'icon','svg'=> '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="2"/></svg>'],
                  ['type'=>'img','src'=> asset("img/earth.svg")],
                  ['type'=>'icon','svg'=> '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 7h18M3 12h18M3 17h18" stroke-width="2"/></svg>'],
                  ['type'=>'img','src'=> asset("img/laptop-technology-streaming-video-learning-education.svg")],
                  ['type'=>'icon','svg'=> '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14M12 5v14" stroke-width="2"/></svg>'],
                ];
              ?>

              <?php for($r=0;$r<2;$r++): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="flex-shrink-0 inline-flex items-center gap-3 px-4 py-2">
                    <?php if($it['type']==='icon'): ?>
                      <div class="w-12 h-12 rounded bg-white shadow-sm flex items-center justify-center border">
                        <?php echo $it['svg']; ?>

                      </div>
                    <?php else: ?>
                      <div class="w-12 h-12 rounded overflow-hidden border shadow-sm">
                        <img src="<?php echo e($it['src']); ?>" alt="sample" class="w-full h-full object-cover">
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endfor; ?>
            </div>
          </div>

          
          <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <article class="bg-white border rounded-lg p-5 shadow-sm flex gap-4 items-start">
              <img src="<?php echo e(asset('img/wink.svg')); ?>" alt="Feature 1" class="w-20 h-20 object-cover rounded-md flex-shrink-0">
              <div>
                <h3 class="text-lg font-extrabold tracking-tight">Create courses that convert</h3>
                <p class="text-sm text-gray-600 mt-1">Use rich resources, quizzes and certificates to keep learners engaged and successful.</p>
              </div>
            </article>

            <article class="bg-white border rounded-lg p-5 shadow-sm flex gap-4 items-start">
              <img src="<?php echo e(asset('img/programming-process.svg')); ?>" alt="Feature 2" class="w-20 h-20 object-cover rounded-md flex-shrink-0">
              <div>
                <h3 class="text-lg font-extrabold tracking-tight">Host live sessions</h3>
                <p class="text-sm text-gray-600 mt-1">Schedule live classes with attendance tracking and recordings for replay.</p>
              </div>
            </article>
          </div>
        </div>

        
        <div class="flex gap-3">
          <a href="<?php echo e($studentRegisterUrl); ?>" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white">Join students</a>
          <a href="<?php echo e($trainerRegisterUrl); ?>" class="inline-flex items-center px-4 py-2 rounded-md border">Become trainer</a>
        </div>
      </div>
    </div>
  </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home.blade.php ENDPATH**/ ?>