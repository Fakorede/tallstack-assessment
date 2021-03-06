
## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Installation

After cloning the application, you need to install it's dependencies.

```
$ composer install
$ npm install && npm run dev
```

## Application Setup

When you are done with installation, copy the .env.example file to .env

```
$ cp .env.example .env
```

Generate the application key

```
$ php artisan key:generate
```

Create database connection

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Run database migrations

```
$ php artisan migrate
```

Seed database with dummy data

```
$ php artisan db:seed
```

Run tests

```
$ php artisan test --filter StaffTest
$ php artisan test --filter PatientTest
```

Run application

```
$ php artisan serve
```

## Implemented Functionalities

### Features

- [x] A page for creating practice staff users (Roles: Admin, Nurse, Doctor)
- [x] A page for creating patients
- [x] A page to record blood pressure observations for patients
- [x] Export CSV of practice users (Admin, Nurse, Doctor)
- [x] Export CSV of patient blood pressure observations

### Dev requirements

- [x] Use Laravel Excel to generate CSV.
- [x] Use Livewire Datatables.
- [x] Use Tailwind CSS.
- [x] Write Tests.
- [x] Use Alpine/Livewire, not Vue.js or anything else.
- [x] Create a seeder that seeds the DB with 100 practice staff, and 1000/50000 patients.

### ACL

- [x] Any staff member can see all patients in it, and create blood pressure observations for them
- [x] Only Admins can “Export CSV of practice staff”
- [x] Admins and Doctors can “Export CSV of patient Blood Pressure”

** Only Admin can add Staff Users.


## Built With

The awesome [Tallstack](https://tallstack.dev/) 🥳 🎉 - The new way to build rich, reactive web apps.


# IMPORTANT

**For a CSV export of upto 50000, this would take a lot of memory and would require using a queue which will export the data in chunks.**

**The application currently cannot handle large exports but will be able to if I implement the `shouldQueue` interface in the exports classes and setup a queue driver to run the queues/background jobs.**

**This will be implemented as stated in the laravel-excel [docs](https://docs.laravel-excel.com/3.1/exports/queued.html) and would require setting up a queue driver as in the laravel [docs](https://laravel.com/docs/8.x/queues).**
