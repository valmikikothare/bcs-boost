#!/usr/bin/env bash

# Intended to be ran as non-root user with sudo privileges

set -e

php artisan optimize:clear
php artisan optimize
sudo systemctl restart apache2

