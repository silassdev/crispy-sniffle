<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name'))</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  @livewireStyles

  @stack('head')

 </head>
 <body class="min-h-screen bg-gray-50 text-gray-800">

  <x-toast />

  
  @include('layouts.navigation')


  <main class="pt-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    @yield('content')
  </main>

  @include('layouts.footer')

    @livewireScripts

     <script>
(function(){
  const contentEl = document.getElementById('admin-content');
  const loader = document.getElementById('ajax-loader');
  const sidebar = document.getElementById('admin-sidebar');
  const countersEl = document.getElementById('admin-counters');

  function showLoader() { loader.classList.remove('hidden'); loader.classList.add('flex'); }
  function hideLoader() { loader.classList.add('hidden'); loader.classList.remove('flex'); }

  // set active class
  function setActive(sectionName, linkEl){
    // remove old
    document.querySelectorAll('.ajax-link.dash-active').forEach(i => i.classList.remove('dash-active'));
    if (linkEl) linkEl.classList.add('dash-active');

    // role-specific header color: the sidebar header already has classes
  }

  // fetch counters and render small summary
  async function fetchCounters(){
    try {
      const res = await fetch("{{ route('admin.counters') }}", { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
      if (!res.ok) return;
      const data = await res.json();
      countersEl.innerHTML = `S:${data.students} • T:${data.trainers} • A:${data.admins}`;
    } catch(e){
      // ignore
    }
  }

  // load a url into #admin-content
  async function loadUrl(url, sectionName, linkEl = null, push=true){
    showLoader();
    try {
      const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
      if (!res.ok){
        // fallback to full reload
        window.location.href = url;
        return;
      }
      const html = await res.text();
      contentEl.innerHTML = html;
      setActive(sectionName, linkEl);
      if (push) history.pushState({ url, section: sectionName }, '', url);
      // after map, refresh counters
      fetchCounters();
    } catch(err){
      console.error('AJAX load failed', err);
      window.location.href = url; // degrade to normal nav
    } finally {
      hideLoader();
    }
  }

  // bind sidebar links
  document.querySelectorAll('.ajax-link').forEach(link => {
    link.addEventListener('click', function(e){
      e.preventDefault();
      const url = this.dataset.route || this.href;
      const section = this.dataset.section || null;
      loadUrl(url, section, this, true);
    });
  });

  // handle back/forward buttons
  window.addEventListener('popstate', function(e){
    const state = e.state;
    if (state && state.url) {
      loadUrl(state.url, state.section, null, false);
    } else {
      // full reload if no state
      window.location.reload();
    }
  });

  // sidebar collapse toggle
  const toggle = document.getElementById('sidebar-toggle');
  if (toggle){
    toggle.addEventListener('click', function(){
      sidebar.classList.toggle('collapsed');
    });
  }

  // initial counters fetch
  fetchCounters();

  // optionally preload default section (overview) via AJAX
  // If you prefer server-side initial HTML in admin-content, skip this.
  // loadUrl("{{ route('admin.dashboard') }}", 'overview', document.querySelector('[data-section="overview"]'), false);

  })();

  document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.getElementById('admin-sidebar');
  const toggle = document.getElementById('sidebar-toggle');
  const openIcon = document.getElementById('toggle-open');
  const closeIcon = document.getElementById('toggle-close');

  if (!sidebar || !toggle) return;

  toggle.addEventListener('click', () => {
    const collapsed = sidebar.classList.toggle('collapsed');

    // switch the SVGs
    if (openIcon && closeIcon) {
      openIcon.classList.toggle('hidden', collapsed);
      closeIcon.classList.toggle('hidden', !collapsed);
    }

    // a11y
    toggle.setAttribute('aria-expanded', String(!collapsed));
  });
 });

</script>



  @stack('scripts')


  
  @stack('scripts')

 
  </body>
</html>
