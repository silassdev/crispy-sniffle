import './bootstrap';
import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

Alpine.plugin(persist)
window.Alpine = Alpine
Alpine.start()


// Global toast helper (for other scripts to call)
window.APP_TOAST = {
  push(title, message, ttl = 5000) {
    const event = new CustomEvent('app-toast', { detail: { title, message, ttl }});
    window.dispatchEvent(event);
  }
};

window.addEventListener('app-toast', (e) => {
  
});
