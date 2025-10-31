import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Global toast helper (for other scripts to call)
window.APP_TOAST = {
  push(title, message, ttl = 5000) {
    const event = new CustomEvent('app-toast', { detail: { title, message, ttl }});
    window.dispatchEvent(event);
  }
};

window.addEventListener('app-toast', (e) => {
  // find any toast Alpine instances and call push via DOM
  // We'll broadcast a global custom event; the toast component's init() can also listen if needed.
});
