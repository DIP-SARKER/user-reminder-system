# Inactive User Reminder System

This project is a Laravel 12 application that detects inactive users and
sends reminder notifications using scheduled commands and queued jobs.

The system automatically finds users who have not logged in for a
configurable number of days and dispatches jobs to simulate sending
reminder messages.

---

## Features

- Track user login activity using `last_login_at`
- Automatically update login timestamp using Laravel **Authentication Event Listener**
- Detect inactive users after a configurable number of days
- Scheduled command runs daily
- Dispatch queued jobs for each inactive user
- Simulate sending reminders via Laravel logs
- Store reminder history in the `reminder_logs` table
- Prevent users from being processed more than once per day
- Dashboard integration using Laravel Breeze + Livewire
- Manual **Admin Dashboard button** to trigger the reminder check for testing

---

## Tech Stack

- Laravel 12
- Laravel Breeze
- Livewire
- MySQL
- Laravel Scheduler
- Laravel Queue

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/dip-sarker/user-reminder-system.git
cd user-reminder-system
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Create environment file

```bash
cp .env.example .env
```

or

```powershell
copy .env.example .env
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Configure database

Update the `.env` file with your database credentials:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=user_alert
    DB_USERNAME=root
    DB_PASSWORD=

Also configure queue and inactivity settings:

    QUEUE_CONNECTION=database
    INACTIVE_AFTER_DAYS=7

### 6. Run database migrations

```bash
php artisan migrate
```

### 7. Create queue tables

```bash
php artisan queue:table
php artisan migrate
```

### 8. Seed test users

```bash
php artisan db:seed
```

Reset database and seed again:

```bash
php artisan migrate:fresh --seed
```

### 9. Build frontend assets

```bash
npm run dev
```

### 10. Run the application

```bash
php artisan serve
```

Application will be available at:

    http://127.0.0.1:8000

---

## Running the Scheduler

List of scheduled tasks:

```bash
php artisan schedule:list
```

Run scheduler manually:

```bash
php artisan schedule:run
```

Scheduled command used in this project:

```bash
php artisan app:run-scheduler
```

This command:

1.  Finds users inactive for the configured number of days
2.  Dispatches reminder jobs
3.  Ensures users are not processed more than once per day

---

## Running the Queue Worker

Queued jobs process reminders asynchronously.

Start the worker:

```bash
php artisan queue:work
```

Run worker once:

```bash
php artisan queue:work --once
```

Retry failed jobs:

```bash
php artisan queue:retry all
```

Clear failed jobs:

```bash
php artisan queue:flush
```

---

## Testing the Reminder System

### Option 1: Run from terminal

Start the queue worker:

```bash
php artisan queue:work
```

Run the reminder command manually:

```bash
php artisan app:run-scheduler
```

Check the logs:

    storage/logs/laravel.log

Check the database:

    reminder_logs table

---

### Option 2: Run from terminal

Start the queue worker:

```bash
php artisan queue:work
```

Log in using the test admin account created by the seeder:

        admin@test.com
        password: password

Navigate to the Admin Dashboard and click the Run Reminder Check button.

Check the logs:

    storage/logs/laravel.log

Check the database:

    reminder_logs table

---

## Useful Laravel Commands

Clear caches:

```bash
php artisan optimize:clear
```

Clear config cache:

```bash
php artisan config:clear
```

Clear application cache:

```bash
php artisan cache:clear
```

List all available commands:

```bash
php artisan list
```

---

## Notes

- Reminder sending is simulated using Laravel logs.
- Reminder history is stored in the database.
- The inactivity period is configurable using environment variables.
- Users are processed at most once per day.

---

## Author

DIP SARKER
