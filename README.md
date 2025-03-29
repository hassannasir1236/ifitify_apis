# Ifitifyfitness REST API


Welcome to the FitnessApp API! This is a RESTful API built with Laravel 11, designed to help busy people manage their fitness routines efficiently. The API supports user authentication using JWT, along with features for signing up, signing in, creating exercises, monitoring weight, calculating BMI, and more.

## Table of Contents
- Features
- Requirements
- Installation
- Configuration
- Usage
- API Endpoints

## Features

- JWT Authentication: Secure authentication using JSON Web Tokens.
- User Management: Sign up and sign in functionality.
- Exercise Management: Create and manage exercises.
- Weight Monitoring: Track and monitor your weight.
- BMI Calculation: Automatically calculate Body Mass Index (BMI).
- and more..

## Requirements

- PHP >= 8.2
- Composer
- Laravel Framework >= 11.1
- PHPUnit
- JWT Authentication
- MySQL or any other supported database

## Installation

1. Clone the repository:

git clone https://github.com/ifitify/api.git

2. Install dependencies:

cd api
composer install

3. Copy the .env.example file to .env and configure your environment variables such as database connection details and JWT secret key.

cp .env.example .env
php artisan jwt:secret

4. Generate application key:

php artisan key:generate

5. Run database migrations:

php artisan migrate

6. (Optional) Seed the database with sample data:

php artisan db:seed

7. Start the Laravel development server:

php artisan serve


## Testing

Run PHPUnit tests:

php artisan test

## Usage

You can use tools like Postman or curl to interact with the API endpoints. Make sure to include the JWT token in the Authorization header for protected routes.

## Documentation

- view Documentation at : https://documenter.getpostman.com/view/32361299/2sA3e5eoaX
