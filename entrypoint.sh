#!/bin/bash

# Wait for MySQL
# /wait-for-it.sh mysql:3306 --timeout=60 --strict -- echo "MySQL is up"

# Set execute permission for this script
chmod +x /entrypoint.sh

# Navigate to the Laravel project directory (update this to your Laravel project directory)
cd /var/www/html

# Run database migrations
php artisan migrate

# Clear cache
php artisan cache:clear

# Clear config cache
php artisan config:cache

# chown -R www-data:www-data /var/www/storage
# chown -R www-data:www-data /var/www/bootstrap/cache


# Start the Laravel server
php artisan serve --host=0.0.0.0 --port=9000
