# Laravel Project

## Overview

This project is a Laravel-based web application designed to manage orders and messages. It includes features such as user authentication, order management, and real-time notifications using Laravel's built-in capabilities and third-party services.

## Features

- User authentication with admin and normal user roles
- Order management system with status tracking
- Messaging system for orders
- Real-time notifications
- API endpoints for user registration, login, and logout
- Integration with Vonage for notifications
- Tailwind CSS and Alpine.js for frontend styling and interactivity

## Installation

To set up the project locally, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/TariqAyman/rodud-backend.git
   cd rodud-backend
   ```

2. **Install PHP dependencies:**

   Ensure you have [Composer](https://getcomposer.org/) installed.
   ```bash
   composer install
   ```

3. **Install Node.js dependencies:**

   Ensure you have [Node.js](https://nodejs.org/) installed.
   ```bash
   npm install
   ```

4. **Environment setup:**

   Copy the `.env.example` file to `.env` and configure your environment variables, especially the database and Vonage settings.
   ```bash
   cp .env.example .env
   ```

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Run database migrations:**

   Ensure your database is set up and configured in the `.env` file, then run:
   ```bash
   php artisan migrate
   ```

7. **Seed the database:**

   To populate the database with initial data, run the seeder:
   ```bash
   php artisan db:seed
   ```

   This will create default users, orders, and messages as defined in the `DatabaseSeeder` class.

8. **Build frontend assets:**
   ```bash
   npm run dev
   ```

9. **Start the development server:**
   ```bash
   php artisan serve
   ```

   You can now access the application at `http://localhost:8000`.

## Usage

- **Authentication:** Use the provided routes to register, login, and manage user profiles.
- **Order Management:** Create, view, and manage orders through the application interface.
- **Messaging:** Admins can send messages related to orders.
- **Notifications:** Receive real-time notifications for order updates and other events.

## API Endpoints

- **Register:** `POST /api/register`
- **Login:** `POST /api/login`
- **Logout:** `POST /api/logout`

## User to login 
- admin : admin@admin.com : password
- user : user@user.com : password
