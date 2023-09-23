# About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Read more on the [official documentation](https://laravel.com/docs/).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## About Laravel Basic Setup

### Introduction

Welcome to the Laravel Basic Setup repository! This README will guide you through the key features and configurations included in this Laravel project.

### Features

#### Authentication

Our Laravel setup comes with a basic authentication system that includes the following features:

- **User Registration and Login:** Users can register and log in securely.

- **Two-Factor Authentication (2FA):** For added security, we've implemented 2FA, ensuring that users can enable this feature to protect their accounts.

- **Email Verification via Code:** To verify the authenticity of user email addresses, we've integrated email verification using verification codes.

- **Events with Each Action:** Every authentication action (e.g., registration, login, password reset) triggers events, allowing you to customize and extend functionality easily.

#### Observers

We've set up an observer for the User model. Observers are used to monitor changes to model data and can trigger various actions or events based on these changes. This helps maintain data integrity and allows you to implement additional functionality when users' data is modified.

#### Spatie Roles and Permissions Package

To manage user roles and permissions efficiently, we've integrated the Laravel Spatie Roles and Permissions package. This package simplifies user access control and permission management, making it easier to define user roles and what they can do within your application.

#### Pre-configured Roles

We've pre-configured a few roles for your convenience. These roles can be customized and extended as needed to meet the specific requirements of your application. This simplifies user role assignment and ensures that users have the appropriate access rights.

#### Exception Handling

We've configured exception handling to maintain uniformity and provide a consistent user experience in the case of errors or exceptions. Properly handling exceptions is crucial for the security and usability of any application, and our setup ensures that errors are handled gracefully.

## Getting Started

To get started with this Laravel Basic Setup, follow these steps:

1. **Clone the Repository:** Clone this repository to your local development environment.

   ```
   git clone https://github.com/browyn/laravel-basic-setup.git

   ```
2. **Install Dependencies**: Navigate to the project directory and install the required dependencies using Composer.

    ```
    cd laravel-basic-setup
    composer install

    ```

3. **Database Setup**: Configure your database settings in the .env file and run database migrations.

    ```
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed

    ```


