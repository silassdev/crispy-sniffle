@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


  {{-- HERO --}}
  <section class="relative mb-16 overflow-visible">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="relative z-10">
        <h1 class="text-5xl sm:text-6xl font-black leading-[1.1] mb-6 font-['Playfair_Display'] text-slate-900 dark:text-gray-500">
          Learn for <span class="text-indigo-600 underline decoration-indigo-200 decoration-8 underline-offset-4">free</span>.<br>
          Teach for <span class="italic text-yellow-500">impact</span>.
        </h1>
        <p class="text-xl text-gray-600 dark:text-slate-400 mb-8 max-w-xl leading-relaxed">
          Build real projects, join a community, and get verified as a trainer or student. Your journey to excellence starts here.
        </p>

        <div class="flex flex-wrap gap-4">
          <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-indigo-600 text-white rounded-full font-bold shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300">
            Get started now
          </a>

          <a href="{{ route('home') }}#explore" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-slate-200 rounded-full font-bold hover:bg-slate-50 hover:border-slate-300 transition-all duration-300">
            Explore posts
          </a>
        </div>
      </div>

      <div class="relative lg:h-[500px] hidden lg:block">
        <div class="absolute -right-24 top-1/2 -translate-y-1/2 w-[140%] h-[120%] z-0 opacity-10 bg-indigo-600 rounded-full blur-3xl"></div>
        <img src="/img/hero-right.svg"
             alt="Hero Illustration"
             class="relative z-10 w-full h-full object-contain drop-shadow-2xl animate-float hero-blend">
      </div>
    </div>
  </section>

  {{-- MISSION / ABOUT --}}
  <section class="mb-20">
      <div class="p-8 md:p-12 bg-white dark:bg-slate-100 rounded-3xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-10 items-center">
        <div class="w-full md:w-1/2">
           <img src="/img/mission.png" alt="Our Mission" class="rounded-2xl shadow-lg w-full">
        </div>
        <div class="w-full md:w-1/2">
            <h2 class="text-3xl font-bold mb-6 text-slate-900 dark:text-slate-800 leading-tight">We are dedicated to revolutionizing the digital world through cutting-edge web and app solutions.</h2>
            <ul class="space-y-4 text-slate-600 dark:text-slate-400">
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-green-100 text-green-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Expert Team:</strong> Skilled professionals with years of experience.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-green-100 text-green-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Tailored Solutions:</strong> Strategies that align with your goals.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-green-100 text-green-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Seamless Experience:</strong> From consultation to launch.</span>
                </li>
            </ul>
        </div>
      </div>
  </section>

  {{-- NEW DYNAMIC COURSES SECTION --}}
  @if(isset($courses) && count($courses) > 0)
  <section class="mb-20">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 font-['Playfair_Display']">Popular Courses</h2>
            <p class="text-slate-500">Handpicked for your professional growth</p>
        </div>
        <a href="#" class="text-indigo-600 font-semibold hover:underline">View all courses</a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($courses->take(6) as $course)
            @include('partials.post-card', ['post' => $course])
        @endforeach
    </div>
  </section>
  @endif

  {{-- COUNTERS SECTION --}}
  <section class="mb-24 relative overflow-hidden bg-slate-100 rounded-[3rem] py-16 px-8">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
        </svg>
    </div>
    <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-12 text-center text-white">
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-yellow-400 font-['Playfair_Display']" data-counter="0" data-target="187">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Courses Offered</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-indigo-400 font-['Playfair_Display']" data-counter="0" data-target="450">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Active Students</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-rose-400 font-['Playfair_Display']" data-counter="0" data-target="1042">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Verified Trainers</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-emerald-400 font-['Playfair_Display']" data-counter="0" data-target="32">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Community Posts</p>
      </div>
    </div>
  </section>

  {{-- EXPLORE / FEED + RIGHT SIDEBAR --}}
  <section id="explore" class="grid gap-8 lg:grid-cols-3">
    <main class="lg:col-span-2 space-y-6">

      {{-- trending posts header --}}
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Latest posts</h2>
        <a href="{{ route('blogs.index') ?? '#' }}" class="text-sm text-indigo-600 hover:underline">View all</a>
      </div>

      <div class="space-y-4">
        @include('partials.feed', ['posts' => $posts ?? null])
      </div>

    </main>

    {{-- right column: small widgets --}}
    <aside class="space-y-6">
      <div class="p-4 bg-white rounded-lg shadow-sm">
        <h4 class="font-semibold mb-2">Trending tags</h4>
        <div class="flex flex-wrap gap-2">
          <a href="#" class="inline-block px-3 py-1 text-xs bg-gray-100 rounded hover:bg-gray-200">#laravel</a>
          <a href="#" class="inline-block px-3 py-1 text-xs bg-gray-100 rounded hover:bg-gray-200">#react</a>
          <a href="#" class="inline-block px-3 py-1 text-xs bg-gray-100 rounded hover:bg-gray-200">#tailwind</a>
        </div>
      </div>

      <div class="p-4 bg-white rounded-lg shadow-sm">
        <h4 class="font-semibold mb-2">Top trainers</h4>
        <ul class="space-y-2 text-sm text-gray-700">
          <li class="flex items-center justify-between">
            <div>Jane Doe</div>
            <div class="text-xs text-gray-500">12 courses</div>
          </li>
          <li class="flex items-center justify-between">
            <div>John Smith</div>
            <div class="text-xs text-gray-500">8 courses</div>
          </li>
        </ul>
      </div>
    </aside>
  </section>

  {{-- testimonials strip --}}
  <section class="mt-12">
    @includeIf('partials.testimonials')
  </section>

  {{-- CTA footer --}}
  <section class="mt-12 p-6 bg-gradient-to-r from-indigo-50 to-white rounded-lg text-center">
    <h3 class="text-lg font-semibold mb-2">Ready to start learning?</h3>
    <a href="{{ route('register') }}" class="inline-block px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition">
      Create a free account
    </a>
  </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const revealEls = document.querySelectorAll('[data-reveal]');
  const counters = document.querySelectorAll('[data-counter]');

  if (!('IntersectionObserver' in window)) {
    revealEls.forEach(el => el.classList.add('opacity-100','translate-y-0'));
    counters.forEach(counter => counter.textContent = counter.dataset.target);
    return;
  }

  const io = new IntersectionObserver((entries, ob) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.remove('opacity-0','translate-y-6');
        e.target.classList.add('opacity-100','translate-y-0','transition','duration-700','ease-out');
        ob.unobserve(e.target);
      }
    });
  }, {threshold: 0.12});

  revealEls.forEach(el => {
    el.classList.add('opacity-0','translate-y-6');
    io.observe(el);
  });

  const counterIo = new IntersectionObserver((entries, ob) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const counter = e.target;
        const target = +counter.dataset.target;
        let current = 0;
        const increment = Math.ceil(target / 100);

        const updateCounter = () => {
          current += increment;
          if (current > target) {
            counter.textContent = target;
          } else {
            counter.textContent = current;
            requestAnimationFrame(updateCounter);
          }
        };

        updateCounter();
        ob.unobserve(counter);
      }
    });
  });

  counters.forEach(counter => counterIo.observe(counter));
});
</script>
@endpush

@endsection
