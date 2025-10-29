# 🚀 Devs Open — Free Laravel MVP (Open Source)

A clean, production-minded starter for showcasing **apps, blogs, and custom APIs** — built with **Laravel + MariaDB** and a lightweight frontend stack: **Blade + Tailwind CSS + Alpine.js + Livewire**.  
Perfect for freelancers or small teams who want a **fast portfolio + blog + admin dashboard** that’s easy to extend.

---

## ⚡ Quick Pitch

**Devs Open** is a minimal, opinionated MVP you can clone and launch locally in minutes.  
Includes: auth, blog CRUD, public API endpoints, admin dashboard, responsive UI, and a small WYSIWYG-ready editor scaffold.

Designed to be **readable, forkable, and easy to customize.**

---

## ✨ Features

- 🔐 Admin auth (login + password reset)  
- 👤 Seeded admin account for first run  
- 📝 Blog CRUD: create, edit, publish, soft-delete  
- 🖼️ Featured image uploads (with `storage:link`)  
- 🏠 Public home with recent posts  
- 🌐 API endpoints for blogs (JSON)  
- 📱 Responsive nav + mobile drawer  
- ⚙️ Tailwind + Alpine + Livewire UI  
- ✉️ Mailer set to log (easy password reset testing)

---

## 🧰 Tech Stack

| Layer | Technology |
|-------|-------------|
| Backend | Laravel (latest) |
| Database | MariaDB / MySQL |
| Frontend | Blade, Tailwind CSS, Alpine.js, Livewire |
| Bundler | Vite |
| Recommended | `intervention/image` for uploads |

---

## 🏁 Quick Start (Windows + XAMPP)

> Prereqs: PHP (via XAMPP), Composer, Node, NPM, VSCode

```bash
# Clone
git clone https://github.com/yourname/devs-open.git
cd devs-open

# Install deps
composer install
npm install

# Copy & edit .env
cp .env.example .env
php artisan key:generate
