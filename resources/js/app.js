import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine;
document.addEventListener('livewire:load', () => {
if (!Alpine.started) {
Alpine.start();
 }
});


window.APP_TOAST = {
  push(title, message, ttl = 5000) {
    const event = new CustomEvent('app-toast', { detail: { title, message, ttl }});
    window.dispatchEvent(event);
  }
};

window.addEventListener('app-toast', (e) => {
  
});
