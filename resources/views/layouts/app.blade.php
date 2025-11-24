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
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Safe Element Selection
      const contentEl = document.getElementById('admin-content');
      const loader = document.getElementById('ajax-loader');
      const sidebar = document.getElementById('admin-sidebar');
      const countersEl = document.getElementById('admin-counters');
      const toggle = document.getElementById('sidebar-toggle');
      
      // SVG Icons for the toggle (if they exist)
      const openIcon = document.getElementById('toggle-open');
      const closeIcon = document.getElementById('toggle-close');

      // --- Helper Functions ---

      function showLoader() {
        if (loader) { loader.classList.remove('hidden'); loader.classList.add('flex'); }
      }

      function hideLoader() {
        if (loader) { loader.classList.add('hidden'); loader.classList.remove('flex'); }
      }

      function setActive(sectionName, linkEl) {
        document.querySelectorAll('.ajax-link.dash-active').forEach(i => i.classList.remove('dash-active'));
        if (linkEl) linkEl.classList.add('dash-active');
      }

      // --- Core Logic ---

      async function fetchCounters() {
        if (!countersEl) return; // Safety check
        try {
          const res = await fetch("{{ route('admin.counters') }}", {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          if (!res.ok) return;
          const data = await res.json();
          countersEl.innerHTML = `S:${data.students} • T:${data.trainers} • A:${data.admins}`;
        } catch (e) {
          console.warn('Failed to fetch counters', e);
        }
      }

      async function loadUrl(url, sectionName, linkEl = null, push = true) {
        if (!contentEl) {
            // Fallback if admin-content container is missing
            window.location.href = url;
            return;
        }

        showLoader();
        try {
          const res = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          
          if (!res.ok) {
            window.location.href = url;
            return;
          }
          
          const html = await res.text();
          contentEl.innerHTML = html;
          setActive(sectionName, linkEl);
          
          if (push) history.pushState({ url, section: sectionName }, '', url);
          
          fetchCounters();
        } catch (err) {
          console.error('AJAX load failed', err);
          window.location.href = url;
        } finally {
          hideLoader();
        }
      }

      // --- Event Listeners ---

      // 1. Sidebar Toggle (Consolidated Logic)
      if (sidebar && toggle) {
        toggle.addEventListener('click', function() {
          const collapsed = sidebar.classList.toggle('collapsed');
          
          // Toggle Icons if they exist
          if (openIcon && closeIcon) {
            openIcon.classList.toggle('hidden', collapsed);
            closeIcon.classList.toggle('hidden', !collapsed);
          }
          
          toggle.setAttribute('aria-expanded', String(!collapsed));
        });
      }

      // 2. AJAX Links
      document.querySelectorAll('.ajax-link').forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const url = this.dataset.route || this.href;
          const section = this.dataset.section || null;
          loadUrl(url, section, this, true);
        });
      });

      // 3. History Navigation (Back/Forward)
      window.addEventListener('popstate', function(e) {
        const state = e.state;
        if (state && state.url) {
          loadUrl(state.url, state.section, null, false);
        } else {
          window.location.reload();
        }
      });

      // Initial load
      fetchCounters();
    });

      async function loadFragment(url) {
      showLoader();
      try {
        const fragmentUrl = url.includes('?') ? url + '&fragment=1' : url + '?fragment=1';
        const res = await fetch(fragmentUrl, {
          headers: {'X-Requested-With': 'XMLHttpRequest','Accept':'text/html,application/json'},
          credentials: 'same-origin'
        });

        // If server returned JSON (redirect conversion), handle it
        const contentType = res.headers.get('content-type') || '';
        if (contentType.includes('application/json')) {
          const payload = await res.json();
          if (payload.redirect) {
            await loadFragment(payload.redirect.replace('?fragment=1',''));
            if (payload.message) dispatchAppToast('Success', payload.message);
          }
          return;
        }

        if (!res.ok) throw new Error(res.statusText);
        const html = await res.text();
        document.getElementById('dashboard-main-content').innerHTML = html;
        history.replaceState({}, '', url);
      } catch (err) {
        console.error('loadFragment error', err);
        dispatchAppToast('Error', 'Unable to load section');
      } finally {
        hideLoader();
      }
    }

  </script>

  @stack('scripts')

</body>
</html>