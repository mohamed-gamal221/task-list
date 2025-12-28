# Laravel Task Manager 🚀

A clean, functional Task Management application built with Laravel 11. This project demonstrates core backend capabilities including RESTful routing, Form Request validation, and Eloquent ORM relationships.

## Features
- **CRUD Operations**: Create, Read, Update, and Delete tasks.
- **Task Toggling**: Custom model logic to toggle completion status.
- **Pagination**: Efficient data handling using Laravel's native paginator.
- **Validation**: Secure data entry using dedicated `TaskRequest` classes.
- **Flash Messaging**: Real-time feedback for user actions (Success/Error).

## Tech Stack
- **Framework**: Laravel 11
- **Language**: PHP 8.2+
- **Database**: SQLite (or MySQL)
- **Frontend**: Blade Templates & Custom CSS

## Installation
1. Clone the repo: `git clone <your-url>`
2. Install dependencies: `composer install`
3. Setup environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`