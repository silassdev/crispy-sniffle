---

# 📚 aShila LMS — README

A minimal, modern **Learning Management System (LMS) MVP** built with **Laravel, Tailwind CSS, Alpine.js, and MySQL**.  
This README covers setup, authentication (3 roles: student, trainer, admin), dashboards, trainer approval, assets, and troubleshooting.

---

## 📑 Table of Contents
- [Project Summary](#project-summary)  
- [Requirements](#requirements)  
- [Quick Setup](#quick-setup)  
- [Environment Variables](#environment-variables)  
- [Database & Migrations](#database--migrations)  
- [Seed an Admin User](#seed-an-admin-user)  
- [Run the App (Local)](#run-the-app-local)  
- [Assets (Vite / Tailwind / Alpine)](#assets-vite--tailwind--alpine)  
- [Routes (Summary)](#routes-summary)  
- [Views](#views)  
- [Middleware & Auth](#middleware--auth)  
- [Trainer Approval Flow](#trainer-approval-flow)  
- [Troubleshooting](#troubleshooting)  
- [Useful Artisan Commands](#useful-artisan-commands)  
- [Deployment Notes](#deployment-notes)  
- [Tests](#tests)  
- [Future Improvements](#future-improvements)  
- [License / Credits](#license--credits)  

---

## 🚀 Project Summary
- Roles: **student**, **trainer** (requires admin approval), **admin**  
- Auth: Laravel Breeze/Jetstream/Fortify adaptable  
- Frontend: Tailwind CSS + Alpine.js  
- Media/jobs: Queue + cloud storage ready (S3/DigitalOcean)  
- API: Sanctum‑ready scaffold for mobile integration  

---

## ⚙️ Requirements
- PHP 8.1+  
- Composer  
- Node.js + npm  
- MySQL (or MariaDB)  
- Redis (recommended for queues/cache)  
- Optional: Docker  

---

## 🛠 Quick Setup
```bash
git clone <repo-url> lms-mvp
cd lms-mvp

# PHP deps
composer install

# JS deps
npm install

# copy env and generate key
cp .env.example .env
php artisan key:generate

# configure DB in .env

# run migrations & seed admin
php artisan migrate
php artisan db:seed --class=AdminUserSeeder

# build assets
npm run dev

# serve app
php artisan serve
```

---

## 🔑 Environment Variables
Minimum changes in `.env`:
```env
APP_NAME="ALLPILAR LMS"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lms_mvp
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

REDIS_HOST=127.0.0.1
```
👉 For quick dev: `DB_CONNECTION=sqlite` and create `database/database.sqlite`.

---

## 🗄 Database & Migrations
Includes migrations for:
- `users` (role enum + approved flag)  
- `courses`, `lessons`, `enrollments`, `notes`, `community_posts`, `comments`, `media`, `zoom_links`, `notifications`  

Run:
```bash
php artisan migrate
```

---

## 👤 Seed an Admin User
```bash
php artisan db:seed --class=AdminUserSeeder
```
⚠️ Change the seeded password after first login.

---

## 💻 Run the App (Local)
- Backend: `php artisan serve`  
- Frontend:  
  ```bash
  npm run dev     # development
  npm run build   # production
  ```
- Or use Docker if provided.

---

## 🎨 Assets (Vite / Tailwind / Alpine)
- `resources/css/app.css` → Tailwind directives  
- `resources/js/app.js` → Alpine.js bootstrap  
- `tailwind.config.js` → purge paths  

Install & build:
```bash
npm install
npm install alpinejs
npm run dev
```

---

## 🌐 Routes (Summary)
- `/` → Home (`resources/views/home.blade.php`)  
- Auth: `/register`, `/login`, `/logout`, password reset, verification  
- Student dashboard: `/dashboard/student`  
- Trainer dashboard: `/dashboard/trainer` (requires `role:trainer` + `approved.trainer`)  
- Admin dashboard: `/admin/dashboard`  
- Trainer pending: `/trainer/pending`  
- API: `/api/v1/*` (Sanctum ready)  

---

## 🖼 Views
- `resources/views/layouts/app.blade.php` — base layout  
- `resources/views/home.blade.php` — homepage  
- Dashboards:  
  - `dashboard/admin.blade.php`  
  - `dashboard/trainer.blade.php`  
  - `dashboard/student.blade.php`  

---

## 🔐 Middleware & Auth
- `RoleMiddleware` → restrict by role (`role:admin`, `role:trainer,admin`)  
- `EnsureTrainerApproved` → redirect unapproved trainers to `/trainer/pending`  

Register in `app/Http/Kernel.php`:
```php
'role' => \App\Http\Middleware\RoleMiddleware::class,
'approved.trainer' => \App\Http\Middleware\EnsureTrainerApproved::class,
```

---

## ✅ Trainer Approval Flow
1. Trainer registers → `approved=false`  
2. Admin sees pending trainers at `/admin/trainers/pending`  
3. Admin approves → `approved=true`  
4. Trainer notified via `TrainerApprovedNotification` (queued)  

---

## 🛠 Troubleshooting
- Ensure `.env` exists and run `php artisan key:generate`  
- Run migrations + seed admin  
- Clear caches:  
  ```bash
  php artisan view:clear
  php artisan cache:clear
  php artisan route:clear
  php artisan config:clear
  ```
- Build assets: `npm install && npm run dev`  
- Check logs: `storage/logs/laravel.log`  
- Verify routes: `php artisan route:list`  

---

## ⚡ Useful Artisan Commands
```bash
php artisan migrate
php artisan migrate:fresh   # reset DB
php artisan db:seed
php artisan tinker
php artisan route:list
php artisan queue:work
php artisan storage:link
```

---

## 🚀 Deployment Notes
- Use S3/DigitalOcean Spaces + CDN  
- Run `php artisan config:cache` and `php artisan route:cache`  
- Use Redis for queues/cache  
- Secure admin endpoints (consider 2FA)  
- Backups: `spatie/laravel-backup`  

---

## 🧪 Tests
Start with feature tests for:
- Registration (student & trainer)  
- Trainer approval flow  
- Login redirects to dashboards  
- Route protection (middleware)  

---

## 🔮 Future Improvements
- Use `spatie/laravel-permission` for flexible ACL  
- Add notifications & queues for heavy tasks  
- Build JSON API endpoints with Sanctum  
- Add PWA, search (Meilisearch/Algolia), analytics  

---

## 📜 License / Credits
Use and modify freely.  
Built on the **Laravel ecosystem** (Laravel, Tailwind CSS, Alpine.js).  

---


