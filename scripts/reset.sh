#!/usr/bin/env bash

# Intended to be ran as non-root user with sudo privileges

set -e

php artisan optimize:clear
php artisan schedule:cache-clear
sudo rm -rf storage/framework/sessions/*

php artisan optimize
php artisan view:cache

sudo chown -R $(id -un):www-data storage bootstrap/cache

sudo systemctl restart apache2

