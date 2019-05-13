#!/bin/bash

cd /var/www/html

if [[ $APP_ENV = "local" ]]; then
    echo "local environment"
    composer install
    php artisan migrate
fi

if [[ $APP_ENV = "production" ]]; then
    echo "local environment"
    composer install --optimize-autoloader --no-dev
    php artisan migrate --force
    php artisan config:cache
    php artisan route:cache
fi

echo "ready to work!"
php-fpm -R