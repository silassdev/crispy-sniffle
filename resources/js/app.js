import './bootstrap';



window.APP_TOAST = {
  push(title, message, type = 'info', ttl = 5000) {
    const event = new CustomEvent('app-toast', { detail: { title, message, type, ttl }});
    window.dispatchEvent(event);
  }
};
