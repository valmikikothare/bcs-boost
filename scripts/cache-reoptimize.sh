#!/usr/bin/env bash

# Intended to be ran as non-root user with sudo privileges

set -e

php artisan optimize:clear
php artisan optimize
php artisan view:cache

sudo systemctl restart apache2

