#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Running migrations..."
php artisan migrate --force
echo "Running queue..."
 php artisan queue:work --queue=emails
#echo "Running seeders..."
#php artisan db:seed

#echo "Running vite..."
#npm install
#npm run build