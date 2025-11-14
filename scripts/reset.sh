#!/usr/bin/env bash

# Intended to be ran as root user

set -e

if [[ $EUID != 0 ]]; then
    echo "Must be run as root/sudo"
    exit 1
fi

php artisan optimize:clear
php artisan schedule:clear-cache
rm -rf storage/framework/sessions/*

php artisan optimize
php artisan view:cache

php artisan schedule:interrupt

chown -R ubuntu:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

systemctl restart apache2

