
# Laravel+Vue E-Box PT BPR KARYA UTAMA JABAR


## About Repository

A very simple Laravel 8 + Vue 2 + AdminLTE 3 based CRUD Starter template for SPA Application.
<p align="center">
<img src="https://i.imgur.com/Q8aGXV5.png">
<img src="https://i.imgur.com/aXlpJip.png">
</p>

## Tech Specification
- Node JS V. 16 (Recommended)
- Laravel 8
- Vue 2 + VueRouter + vue-progressbar + sweetalert2 + laravel-vue-pagination
- Laravel Passport
- Admin LTE 3 + Bootstrap 4 + Font Awesome 5
- PHPUnit Test Case/Test Coverage

## Features

- Modal based Create+Edit, List with Pagination, Delete with Sweetalert
- Login, Register, Forget+Reset Password as default auth
- Profile, Update Profile, Change Password, Avatar
- Product Management 
- User Management
- Settings: Categories, Tags
- Frontend and Backend User ACL with Gate Policy (type: admin/user)
- Simple Static Dashboard
- Developer Options for OAuth Clients and Personal Access Token
- Build with Docker

## Installation

- `git clone https://github.com/agusmaulanayusufnoor/eboxku-v1.0.0.2.git`
- `cd eboxku-v1.0.0.2/`
- `composer install`
- `cp .env.example .env`
- Update `.env` and set your database credentials
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`
- `npm install`
- `npm run dev`
- `php artisan serve`

## Install with Docker

- `docker-compose up -d`
- `docker exec -it vue-starter /bin/bash`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`
- Application http://localhost:8008/
- Adminer for Database http://localhost:8080/
- DBhost: yourIP:3307, user: root, Password: 123456


## Unit Test

#### run PHPUnit

```bash
# run PHPUnit all test cases
vendor/bin/phpunit
# or Feature test only
vendor/bin/phpunit --testsuite Feature
```

#### Code Coverage Report

```bash
# reports is a directory name
vendor/bin/phpunit --coverage-html reports/
```
A `reports` directory has been created for code coverage report. Open the dashboard.html.


## Credit
This repository is motivated by [Hujjat/laravStart](https://github.com/Hujjat/laravStart) and his awesome video tutorial in [Youtube](https://www.youtube.com/playlist?list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE).

## License

[MIT license](https://opensource.org/licenses/MIT).
