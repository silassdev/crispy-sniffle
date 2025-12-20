// Listens for Livewire dispatched 'app-toast' events and plays sound + shows toast.
// Also subscribes to Echo (if present) and emits to Livewire.
// Fallback: polls /notifications/unread every 15s if Echo not configured.

(function () {
  // lightweight toast helper (replace with your app toast UI)
  function showToast(payload) {
    try {
      const title = payload.title || 'Notice';
      const message = payload.message || '';
      // Example: simple ephemeral DOM toast at bottom-right
      const wrap = document.getElementById('app-toast-wrap') || (function(){
        const w = document.createElement('div');
        w.id = 'app-toast-wrap';
        w.style.position = 'fixed';
        w.style.right = '12px';
        w.style.bottom = '12px';
        w.style.zIndex = 99999;
        document.body.appendChild(w);
        return w;
      })();

      const el = document.createElement('div');
      el.className = 'app-toast shadow-md rounded p-3 bg-white border';
      el.style.marginTop = '8px';
      el.style.minWidth = '240px';
      el.innerHTML = `<div style="font-weight:600">${title}</div><div style="font-size:13px;color:#444">${message}</div>`;
      wrap.appendChild(el);

      setTimeout(()=> {
        el.style.transition = 'opacity .4s';
        el.style.opacity = 0;
        setTimeout(()=> el.remove(), 500);
      }, payload.ttl || 3500);
    } catch (e) {
      console.warn('toast error', e);
    }
  }

  // sound helper: try audio file, fallback to WebAudio beep
  function playSound() {
    const url = '/sounds/notify.mp3';
    const audio = new Audio(url);
    audio.play().catch(() => {
      // fallback beep
      try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const o = ctx.createOscillator();
        const g = ctx.createGain();
        o.connect(g);
        g.connect(ctx.destination);
        o.frequency.value = 880;
        g.gain.value = 0.05;
        o.start();
        setTimeout(()=> { o.stop(); ctx.close(); }, 120);
      } catch (e) { /* ignore */ }
    });
  }

  window.addEventListener('navigate-to', function(e){
  if (e.detail && e.detail.url) {
    window.location.href = e.detail.url;
  }
});

  // unify toast source: window event and Livewire events
  window.addEventListener('app-toast', function (ev) {
    const payload = ev.detail || {};
    showToast(payload);
    playSound();
  });

  if (window.Livewire && typeof Livewire.on === 'function') {
    Livewire.on('app-toast', (payload) => {
      showToast(payload || {});
      playSound();
    });
  }

  // Echo subscription (Pusher or laravel-echo) — listen on private user channel
  function setupEcho(userId) {
    if (! userId || ! window.Echo) return false;
    try {
      // channel name for BroadcastNotificationCreated uses "App.Models.User.{id}" convention by default
      const channel = `private-App.Models.User.${userId}`;
      window.Echo.private(channel)
        .notification(function (notification) {
          // notify Livewire component and show toast
          if (window.Livewire && typeof Livewire.emit === 'function') {
            Livewire.emit('notificationReceived', notification);
          } else {
            // fallback: trigger DOM event
            window.dispatchEvent(new CustomEvent('app-toast', { detail: { title: notification.data.title, message: notification.data.message } }));
          }
        });
      return true;
    } catch (e) {
      console.warn('Echo subscribe failed', e);
      return false;
    }
  }

  // Polling fallback
  async function pollUnread() {
    try {
      const res = await fetch('/notifications/unread', { credentials: 'same-origin', headers: {'X-Requested-With': 'XMLHttpRequest'}});
      if (! res.ok) return;
      const json = await res.json();
      if (! json.data) return;
      const items = json.data;
      if (items.length > 0) {
        // emit the latest item to Livewire
        const latest = items[0];
        if (window.Livewire && typeof Livewire.emit === 'function') {
          Livewire.emit('notificationReceived', {
            id: latest.id,
            data: latest.data,
            created_at: latest.created_at
          });
        } else {
          window.dispatchEvent(new CustomEvent('app-toast', { detail: { title: latest.data.title, message: latest.data.message } }));
        }
      }
    } catch (e) {
      // ignore network errors
    }
  }

  // init: get user id from meta tag or window var set by server
  const userId = window.APP_USER_ID || (document.querySelector('meta[name="user-id"]') ? document.querySelector('meta[name="user-id"]').content : null);

  // try echo if present
  const echoOk = setupEcho(userId);

  // start polling if echo not available
  if (! echoOk) {
    setInterval(pollUnread, 15000); // every 15s
  }

})();

