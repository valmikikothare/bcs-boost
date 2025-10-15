#!/bin/bash

set -euo pipefail

### === CONFIG ===
DOMAIN="bcs-boost.mit.edu"
PROJECT_DIR="/var/www/html" # Laravel project path
GIT_REPO_URL="https://github.com/valmikikothare/bcs-boost.git" # Optional: set if you want to auto-clone
APACHE_CONF="/etc/apache2/sites-available/${DOMAIN}.conf"
USER_NAME="ubuntu"
PHP_VERSION="8.2"

### === Helpers ===
log(){ echo -e "\n==== $* ====\n"; }
need_cmd(){ command -v "$1" >/dev/null 2>&1 || return 1; }

### === System update ===
log "Updating system packages"
apt-get update -y
apt-get upgrade -y

### === Basic tools ===
log "Installing basic utilities"
apt-get install -y software-properties-common curl zip unzip git ufw

### === PHP 8.2 & extensions ===
log "Installing PHP ${PHP_VERSION} and common extensions for Laravel"
if ! apt-cache policy | grep -qi "ondrej/php"; then
  add-apt-repository -y ppa:ondrej/php || true
  apt-get update -y
fi

apt-get install -y \
  php${PHP_VERSION} php${PHP_VERSION}-cli php${PHP_VERSION}-common \
  php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-zip \
  php${PHP_VERSION}-curl php${PHP_VERSION}-gd php${PHP_VERSION}-intl \
  php${PHP_VERSION}-bcmath php${PHP_VERSION}-mysql

if need_cmd update-alternatives; then
  update-alternatives --set php /usr/bin/php${PHP_VERSION} || true
fi

### === Composer ===
log "Installing Composer"
if ! need_cmd composer; then
  EXPECTED_CHECKSUM="$(curl -fsSL https://composer.github.io/installer.sig)"
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"
  if [ "${EXPECTED_CHECKSUM}" != "${ACTUAL_CHECKSUM}" ]; then
    echo 'ERROR: Invalid Composer installer checksum' >&2
    rm composer-setup.php
    exit 1
  fi
  php composer-setup.php --install-dir=/usr/local/bin --filename=composer
  rm composer-setup.php
fi

### === Nodejs and npm ===
log "Installing nodejs and npm"
apt-get install -y nodejs npm

log "Preparing project directory at ${PROJECT_DIR}"
if [ ! -f "${PROJECT_DIR}/composer.json" ] || [ ! -f "${PROJECT_DIR}/package.json" ] || [ ! -f "${PROJECT_DIR}/artisan" ]; then
    rm -rf "${PROJECT_DIR}"
    mkdir -p "${PROJECT_DIR}"
fi

### === Project directory ===
git clone "${GIT_REPO_URL}" "${PROJECT_DIR}"
cd "${PROJECT_DIR}"

### === Copy .env.example ===
log "Copying .env.example to .env"
if [ ! -f .env ]; then
    cp .env.example .env
fi

### === Build frontend ===
log "Installing javascript dependencies and building frontend"
npm install && npm run build
rm -rf node_modules

chown -R "${USER_NAME}":"${USER_NAME}" "${PROJECT_DIR}"

### === Laravel dependencies ===
log "Installing Laravel dependencies with Composer"
sudo -u "${USER_NAME}" composer install --no-interaction --prefer-dist --optimize-autoloader

### === Optimize Laravel cache ===
log "Optimizing laravel caches"
sudo -u "${USER_NAME}" php artisan optimize:clear
sudo -u "${USER_NAME}" php artisan optimize

### === Laravel permissions ===
log "Setting Laravel storage and cache permissions"
chown -R "${USER_NAME}":www-data storage bootstrap/cache
find storage -type d -exec chmod 775 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;

### === Apache ===
log "Installing and enabling Apache"
apt-get install -y apache2
systemctl enable apache2
systemctl start apache2
a2enmod rewrite headers ssl

### === Apache vhost for Laravel (DocumentRoot -> public) ===
log "Creating Apache vhost for ${DOMAIN}"
bash -c "cat > '${APACHE_CONF}'" <<EOF
<VirtualHost *:80>
    ServerName ${DOMAIN}

    ServerAdmin admin@${DOMAIN}
    DocumentRoot ${PROJECT_DIR}/public

    <Directory ${PROJECT_DIR}/public>
        AllowOverride All
        Require all granted
        Options FollowSymLinks
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/${DOMAIN}-error.log
    CustomLog \${APACHE_LOG_DIR}/${DOMAIN}-access.log combined

    <IfModule mod_headers.c>
        Header always set X-Frame-Options SAMEORIGIN
        Header always set X-Content-Type-Options nosniff
    </IfModule>
</VirtualHost>
EOF

a2dissite 000-default.conf || true
a2ensite "${DOMAIN}.conf"
systemctl reload apache2

### === UFW firewall ===
log "Configuring UFW to allow SSH and Apache"
ufw allow OpenSSH || true
ufw allow 'Apache Full' || true
echo "y" | ufw enable || true

### === Let's Encrypt SSL ===
log "Installing Certbot and obtaining SSL certificate for ${DOMAIN}"
if ! need_cmd snap; then
  apt-get install -y snapd
fi
snap install core && snap refresh core
if snap list | grep -q certbot; then
  log "Certbot already installed via snap"
else
  snap install --classic certbot
fi
ln -sf /snap/bin/certbot /usr/bin/certbot
certbot --apache -d "${DOMAIN}" --redirect --agree-tos -m "admin@${DOMAIN}" -n || true

### === Final restart ===
log "Restarting Apache"
systemctl restart apache2

log "All done! Site should be available at: https://${DOMAIN}"
