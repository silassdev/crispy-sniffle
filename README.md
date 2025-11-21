# Laravel LMS

A comprehensive Learning Management System (LMS) built with Laravel, designed to facilitate online education through role-based access for administrators, trainers, and students. This application leverages modern web technologies to provide a seamless experience for managing courses, blogs, user profiles, and more.

## Features

- **Role-Based Access Control**: Supports three user roles - Admin, Trainer, and Student - with specific permissions and functionalities.
- **User Authentication & Social Login**: Secure login with traditional email/password and social media integration via Laravel Socialite.
- **Trainer Approval System**: Trainers must be approved by admins before gaining access to create and manage courses.
- **Course Management**: Trainers can create and manage courses; students can enroll and access learning materials.
- **Blog System**: Integrated blogging feature for sharing educational content, news, and updates.
- **Admin Dashboard**: Admins can invite new admins, manage trainer applications, view overviews, and oversee the platform.
- **Email Notifications**: Automated emails for trainer applications, approvals, rejections, and welcome messages for students.
- **Responsive UI**: Built with Tailwind CSS and Alpine.js for a modern, mobile-friendly interface.
- **Real-Time Components**: Utilizes Livewire and Volt for reactive, dynamic UI elements without page reloads.
- **Caching & Queues**: Redis integration for efficient caching and background job processing.
- **Testing Suite**: Comprehensive tests using PHPUnit for reliability.

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- Docker (optional, for containerized setup)
- Redis (for caching and queues)

### Steps

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd laravel-lms
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install Node Dependencies**:
   ```bash
   npm install
   ```

4. **Environment Setup**:
   - Copy the example environment file:
     ```bash
     cp .env.example .env
     ```
   - Generate application key:
     ```bash
     php artisan key:generate
     ```
   - Configure your database, mail, and social login settings in `.env`.

5. **Database Migration & Seeding**:
   ```bash
   php artisan migrate --force
   php artisan db:seed
   ```

6. **Build Assets**:
   ```bash
   npm run build
   ```

### Quick Setup Script

You can use the provided setup script for a streamlined installation:
```bash
composer run setup
```

This will handle dependency installation, environment setup, migrations, and asset building.

## Usage

### Running the Application

Start the development server with all necessary services:
```bash
composer run dev
```

This command runs:
- Laravel server (`php artisan serve`)
- Queue worker (`php artisan queue:listen`)
- Log tailing (`php artisan pail`)
- Vite dev server (`npm run dev`)

Access the application at `http://localhost:8000`.

### Key Routes & Functionality

- **Home**: Public landing page with featured blog posts.
- **Authentication**: Login, register, password reset, and social login.
- **Admin Panel** (`/admin`): Dashboard for managing trainers, sending invites, and viewing statistics.
- **Trainer Dashboard**: Course creation and management (after approval).
- **Student Dashboard**: Course enrollment and progress tracking.
- **Blog**: Public blog posts and individual post views.
- **Profile**: User profile management.

### Testing

Run the test suite:
```bash
composer run test
```

## Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature/your-feature-name`.
3. Make your changes and ensure tests pass.
4. Commit your changes: `git commit -m 'Add some feature'`.
5. Push to the branch: `git push origin feature/your-feature-name`.
6. Open a pull request.

### Code Style

- Follow PSR-12 coding standards.
- Use Laravel Pint for code formatting: `vendor/bin/pint`.
- Write tests for new features.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

For support, please open an issue on the GitHub repository or contact the maintainers.

---

Built with ❤️ using Laravel, Livewire, and Tailwind CSS.
