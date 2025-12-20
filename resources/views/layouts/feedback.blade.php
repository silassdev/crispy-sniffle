<section class="bg-slate-900 text-slate-400 border-t border-slate-800 relative overflow-hidden group">
  <!-- Abstract Decoration -->
  <div class="absolute -right-24 -top-24 w-96 h-96 bg-indigo-600 rounded-full blur-[120px] opacity-20 group-hover:opacity-30 transition-opacity duration-700"></div>
  <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-blue-600 rounded-full blur-[120px] opacity-10"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16">

      <!-- Feedback Categories -->
      <nav aria-label="Feedback categories">
        <h3 class="text-white text-xl font-extrabold mb-8 flex items-center gap-3">
            <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
            Share Your Thoughts
        </h3>
        <ul class="space-y-4 text-sm">
          <li>
            <a href="#"
               class="inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold text-slate-400 hover:text-white hover:bg-white/5">
              Course Feedback
            </a>
          </li>

          <li>
            <a href="#"
               class="inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold text-slate-400 hover:text-white hover:bg-white/5">
              Platform Suggestions
            </a>
          </li>

          <li>
            <a href="#"
               class="inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold text-slate-400 hover:text-white hover:bg-white/5">
              Report an Issue
            </a>
          </li>

          <li>
            <a href="#"
               class="inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold text-slate-400 hover:text-white hover:bg-white/5">
              Feature Requests
            </a>
          </li>

          <li>
            <a href="#"
               class="inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold text-slate-400 hover:text-white hover:bg-white/5">
              General Comments
            </a>
          </li>
        </ul>
      </nav>

      <!-- Feedback Impact (Visual Placeholder) -->
      <div class="hidden lg:block">
           <h3 class="text-white text-xl font-extrabold mb-8 flex items-center gap-3">
                <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                Your Voice Matters
           </h3>
           <p class="text-slate-400 text-sm leading-relaxed mb-6">
                Every piece of feedback helps us improve and deliver a better learning experience for our community.
           </p>
           <div class="flex items-center gap-4">
               <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10 text-white font-black text-lg">
                   💬
               </div>
               <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10 text-white font-black text-lg">
                   ✨
               </div>
               <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10 text-white font-black text-lg">
                   🎯
               </div>
           </div>
      </div>

      <!-- Submit Feedback Action -->
      <div class="md:text-left lg:text-right">
        <h3 class="text-white text-xl font-extrabold mb-8 flex items-center gap-3 justify-start lg:justify-end">
            Submit Feedback
            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
        </h3>
        <p class="text-sm text-slate-400 mb-8 max-w-sm lg:ml-auto leading-relaxed">Have ideas or concerns? We'd love to hear from you. Your feedback drives our continuous improvement.</p>

        <div class="max-w-sm lg:ml-auto">
            <a href="{{ route('contact.show') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition-all duration-300 shadow-lg shadow-indigo-600/20 w-full">
                Give Feedback
            </a>
        </div>
      </div>

    </div>
  </div>
</section>
