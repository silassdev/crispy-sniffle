import './bootstrap';
import Alpine from 'alpinejs';
import { adminAuth } from './adminAuth';

window.adminAuth = adminAuth;

window.Alpine = Alpine;
Alpine.start();
