#!/usr/bin/env bash

# Intended to be ran as non-root user with sudo privileges

set -e

DOMAIN="bcs-boost.mit.edu"

sudo certbot --apache -d "${DOMAIN}" --redirect --agree-tos -m "admin@${DOMAIN}" -n
sudo systemctl restart apache2

