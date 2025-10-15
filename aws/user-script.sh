#!/usr/bin/env bash
set -euo pipefail

### === CONFIG ===
DOMAIN="bcs-boost.mit.edu"
PROJECT_DIR="/var/www/html" # Laravel project path
GIT_REPO_URL="https://github.com/valmikikothare/bcs-boost.git" # Optional: set if you want to auto-clone
APACHE_CONF="/etc/apache2/sites-available/${DOMAIN}.conf"
PHP_VERSION="8.2"

### === Helpers ===
log(){ echo -e "\n==== $* ====\n"; }
need_cmd(){ command -v "$1" >/dev/null 2>&1 || return 1; }

### === System update ===
log "Updating system packages"
sudo apt-get update -y
sudo apt-get upgrade -y

### === Basic tools ===
log "Installing basic utilities"
sudo apt-get install -y software-properties-common curl zip unzip git ufw


### === PHP 8.2 & extensions ===
log "Installing PHP ${PHP_VERSION} and common extensions for Laravel"
if ! apt-cache policy | grep -qi "ondrej/php"; then
  sudo add-apt-repository -y ppa:ondrej/php || true
  sudo apt-get update -y
fi

sudo apt-get install -y \
  php${PHP_VERSION} php${PHP_VERSION}-cli php${PHP_VERSION}-common \
  php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-zip \
  php${PHP_VERSION}-curl php${PHP_VERSION}-gd php${PHP_VERSION}-intl \
  php${PHP_VERSION}-bcmath php${PHP_VERSION}-mysql

if need_cmd update-alternatives; then
  sudo update-alternatives --set php /usr/bin/php${PHP_VERSION} || true
fi

### === Composer ===
log "Installing Composer"
if ! need_cmd composer; then
  EXPECTED_CHECKSUM="$(curl -fsSL https://composer.github.io/installer.sig)"
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"
  if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
    echo 'ERROR: Invalid Composer installer checksum' >&2
    rm composer-setup.php
    exit 1
  fi
  sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
  rm composer-setup.php
fi

### === Nodejs and npm ===
log "Installing nodejs and npm"
sudo apt-get install -y nodejs npm

### === Project directory ===
log "Preparing project directory at ${PROJECT_DIR}"
sudo mkdir -p "${PROJECT_DIR}"
sudo chown -R "$USER":"$USER" "${PROJECT_DIR}"

if [ -n "${GIT_REPO_URL}" ] && [ -z "$(ls -A "${PROJECT_DIR}")" ]; then
  log "Cloning repo ${GIT_REPO_URL} into ${PROJECT_DIR}"
  git clone "${GIT_REPO_URL}" "${PROJECT_DIR}"
else
  log "Skipping clone (either repo URL not set or directory not empty)."
fi
cd "${PROJECT_DIR}"

### === Laravel dependencies ===
log "Installing Laravel dependencies with Composer"
if [ ! -f .env ] && [ -f .env.example ]; then
  cp .env.example .env
else
  log ".env.example not found. Ensure your Laravel code is in ${PROJECT_DIR}"
fi

### === Laravel dependencies ===
log "Installing Laravel dependencies with Composer"
if [ -f composer.json ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
else
  log "composer.json not found. Ensure your Laravel code is in ${PROJECT_DIR}"
fi

### === Build frontend ===
log "Installing javascript dependencies and building frontend"
if [ -f package.json ]; then
  npm install && npm run build
else
  log "package.json not found. Ensure your Laravel code is in ${PROJECT_DIR}"
fi

### === Optimize Laravel cache ===
if [ -f "${PROJECT_DIR}/artisan" ]; then
  log "Optimizing laravel caches"
  php "${PROJECT_DIR}/artisan" config:cache || true
  php "${PROJECT_DIR}/artisan" route:cache || true
  php "${PROJECT_DIR}/artisan" view:cache || true
fi

### === Apache ===
log "Installing and enabling Apache"
sudo apt-get install -y apache2
sudo systemctl enable apache2
sudo systemctl start apache2
sudo a2enmod rewrite headers ssl

### === Laravel permissions ===
log "Setting Laravel storage and cache permissions"
sudo chown -R www-data:www-data "${PROJECT_DIR}/storage" "${PROJECT_DIR}/bootstrap/cache" || true
sudo find "${PROJECT_DIR}/storage" -type d -exec chmod 775 {} \; || true
sudo find "${PROJECT_DIR}/bootstrap/cache" -type d -exec chmod 775 {} \; || true

### === Apache vhost for Laravel (DocumentRoot -> public) ===
log "Creating Apache vhost for ${DOMAIN}"
sudo bash -c "cat > '${APACHE_CONF}'" <<EOF
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

sudo a2dissite 000-default.conf || true
sudo a2ensite "${DOMAIN}.conf"
sudo systemctl reload apache2

### === UFW firewall ===
log "Configuring UFW to allow SSH and Apache"
sudo ufw allow OpenSSH || true
sudo ufw allow 'Apache Full' || true
echo "y" | sudo ufw enable || true

### === Let's Encrypt SSL ===
log "Installing Certbot and obtaining SSL certificate for ${DOMAIN}"
if ! need_cmd snap; then
  sudo apt-get install -y snapd
fi
sudo snap install core && sudo snap refresh core
if snap list | grep -q certbot; then
  log "Certbot already installed via snap"
else
  sudo snap install --classic certbot
fi
sudo ln -sf /snap/bin/certbot /usr/bin/certbot
sudo certbot --apache -d "${DOMAIN}" --redirect --agree-tos -m "admin@${DOMAIN}" -n


### === Final restart ===
log "Restarting Apache"
sudo systemctl restart apache2

log "All done! Site should be available at: https://${DOMAIN}"
