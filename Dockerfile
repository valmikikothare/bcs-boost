ARG USER_NAME=ubuntu
ARG PHP_VERSION=8.2
ARG PROJECT_DIR=/var/www/html 
ARG DOMAIN=bcs-boost.mit.edu

FROM ubuntu:noble AS base

SHELL ["/bin/bash", "-c"]

ARG PHP_VERSION

# Install base packages, PHP, Node, and Apache modules in logical steps
RUN <<EOT
set -ex
apt-get update 
apt-get install -y software-properties-common curl zip unzip git ca-certificates lsb-release gnupg ufw
add-apt-repository -y ppa:ondrej/php 
add-apt-repository -y ppa:ondrej/apache2
apt-get update 
apt-get install -y \
    php${PHP_VERSION} php${PHP_VERSION}-cli php${PHP_VERSION}-common \
    php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-zip \
    php${PHP_VERSION}-curl php${PHP_VERSION}-gd php${PHP_VERSION}-intl \
    php${PHP_VERSION}-bcmath php${PHP_VERSION}-mysql \
    nodejs npm apache2 mysql-client
update-alternatives --set php /usr/bin/php${PHP_VERSION}
rm -rf /var/lib/apt/lists/*
EOT

# Install Composer globally
RUN <<EOT
set -ex
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
EOT

# Build webserver
FROM base AS build

ARG PROJECT_DIR
ARG USER_NAME

# Copy source code
COPY . ${PROJECT_DIR} 

WORKDIR ${PROJECT_DIR}

# Configure file permissions
RUN <<EOT
set -ex
chown -R ${USER_NAME}:${USER_NAME} .
chown -R "${USER_NAME}":www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
EOT

USER ${USER_NAME}

# Install JS dependencies and build frontend as the non-root user
RUN --mount=type=cache,target=${PROJECT_DIR}/node_modules,uid=1000,gid=1000 \
    npm install --no-audit --no-fund && npm run build 

# Install PHP dependencies with Composer and clear laravel cache
RUN --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction \
    && php artisan optimize:clear

USER root

# Create Apache virtual host (DocumentRoot -> public)

ARG DOMAIN

RUN <<EOT
set -ex
a2enmod rewrite headers ssl  
cat > /etc/apache2/sites-available/${DOMAIN}.conf <<EOF
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
a2ensite ${DOMAIN}.conf 
EOT

# Expose HTTP and HTTPS
EXPOSE 80 443

COPY --chmod=770 <<EOF /entrypoint.sh
#!/bin/bash
set -e
cd ${PROJECT_DIR}
php artisan optimize:clear
php artisan optimize
php artisan view:cache
apache2ctl -D  FOREGROUND
EOF

ENTRYPOINT ["/entrypoint.sh"]


FROM base AS dev

RUN apt-get update && apt-get install -y \
    sudo vim bash-completion

ARG USER_NAME

RUN echo $USER_NAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USER_NAME \
    && chmod 0440 /etc/sudoers.d/$USER_NAME

USER ${USER_NAME}

ARG PROJECT_DIR

WORKDIR ${PROJECT_DIR}

ENTRYPOINT []
CMD ["sleep", "infinity"]