#!/bin/bash

# Wait for the database to be ready
/usr/bin/wait-for-it db --timeout=30 --strict -- echo "Database is ready."

# Run migrations
php artisan migrate --force

php artisan db:seed --class=BookingDiscountSeeder

# Start Apache
apache2-foreground