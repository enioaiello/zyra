# Utiliser l'image PHP 8.1 avec Apache
FROM php:8.1-apache

# Installer les extensions nécessaires et Composer
RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activer les modules Apache
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Définition des permissions pour éviter les erreurs 403 et 500
RUN chown -R ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/www/html \
    && chmod -R 755 /var/www/html

# Installer les dépendances PHP avec Composer
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# Donner les bons droits aux fichiers
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
