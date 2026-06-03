# 1. Image PHP + Apache
FROM php:8.2-apache

# 2. Installer dépendances
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    git \
    unzip

# 3. Extensions PHP
RUN docker-php-ext-install bcmath sockets zip pdo_mysql

# Installer Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -

RUN apt-get install -y nodejs

# 4. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. 🔥 Activer rewrite (OBLIGATOIRE pour Laravel)
RUN a2enmod rewrite

# 6. 🔥 Définir le bon dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# 7. 🔥 Modifier la config Apache (TRÈS IMPORTANT)
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 8. Dossier de travail
WORKDIR /var/www/html