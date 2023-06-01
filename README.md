# company_app
This is a Laravel project that allows you to manage companies and employees.

## Prerequisites

- PHP (>= 7.4)
- Composer
- MySQL (>= 5.7)
- Node.js (>= 12.0)

## Getting Started

1. Clone the repository.
   
2. Install the dependencies:
    ```
    composer install
    npm install && npm run dev
    ```
    
3. Generate the Application Key:
   ```
   php artisan key:generate
   ```
    
4.Configure the Environment:
- Rename the .env.example file to .env.
- Update the database configuration in the .env file to match your MySQL settings.

    
5.Generate the Application Key:
   ```
   php artisan key:generate
   ```
    
6.Run the Database Migrations and Seeders:
   ```
   php artisan migrate --seed
   ```
    
7.Serve the Application:
   ```
   php artisan serve
   ```
