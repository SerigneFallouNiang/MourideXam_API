#!/bin/bash

# Copie du fichier .env.example vers .env
cp .env.example .env

# Installation des dépendances Composer
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Liens symboliques storage
php artisan storage:link

# Nettoyage et mise en cache de la configuration
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permissions des dossiers
chmod -R 775 storage bootstrap/cache
chmod -R 775 public

# Migrations de la base de données
php artisan migrate --force