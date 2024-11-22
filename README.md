# Liga Project Setup Guide

The Liga project is an application that allows you to manage users in a team.

## Technologies Used

-   Laravel
-   MySQL 

## Steps to Run the Project

### 1. Clone the Repository

Clone the project repository from GitHub:

`git clone <repository_url>`

### 2. Install Composer

Install Composer, a dependency manager for PHP:

`sudo apt install composer`

### 3. Install Project Dependencies

Navigate to the project directory and install the required PHP dependencies using Composer:

`cd <project_directory>`
`composer install`

### 4. Set Up the Database

Install MariaDB server:

`sudo apt install mariadb-server`

Log in to MySQL as the root user:

`mysql -u root -p`

Create a new user and grant privileges:

`CREATE USER 'olga' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'olga'@'localhost';
FLUSH PRIVILEGES;`

Create the liga database:

`CREATE DATABASE liga;`

### 5. Configure the .env File

Copy the .env.example file to .env:

`cp .env.example .env`

Open the .env file and configure the database settings:

`DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=liga
DB_USERNAME=olga
DB_PASSWORD=password`

### 6. Generate the Application Key

Run the following command to generate a new application key:

`php artisan key:generate`

### 7. Run Migrations

Run the database migrations to create the necessary tables:

`php artisan migrate`

### 8. Seed the Database (Optional)

Seed the database with some test data:

`php artisan db:seed`

### 9. Start the Laravel Development Server

Finally, start the development server:

`php artisan serve`

You should see the following output:

Server running on [http://127.0.0.1:8000]
