# Task Management API

This project is a Laravel-based Task Management System that allows users to manage tasks, dependencies, and statuses efficiently.

## Features

Create a new task

Retrieve all tasks

Retrieve a specific task

Update task status

Add dependencies to a task

Delete a task
## Requirements

- PHP >= 8.2
- Laravel >= 11
- Composer
- MySQL or any other supported database

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/samiralaa/Task_Management_System
   cd employee-management-system
   ```
   2. **Install dependencies:**
   ```bash
   composer install
   ```
   3. **Copy the example environment file and make the required configuration changes:**
   ```bash
   cp .env.example .env
   ```
   4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
   5. **Create a new database and update the database configuration in the `.env` file:**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```
   6. **Run the database migrations:**
   ```bash
   php artisan migrate
   ```
   7. **Start the local development server:**
   ```bash
   php artisan serve
   ```
   8. **Open the application in your browser:**
   ```
   http://localhost:8000
   ```
   ## to login as admin use the following credentials:
   ```
   email: admin@admin.com
   password: password
   ```
 