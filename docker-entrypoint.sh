#!/bin/bash

# Run Laravel migrations
php artisan migrate --force

# Seed the database
php artisan db:seed --force

# Clear cache if needed
php artisan cache:clear
php artisan config:clear

php-fpm

# Start the original container process (e.g., Laravel's PHP-FPM)
# exec "$@"

