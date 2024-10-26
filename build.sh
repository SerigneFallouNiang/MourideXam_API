#!/bin/bash

# Création du fichier .env
echo "APP_NAME=MourideXam
APP_ENV=production      
APP_KEY=base64:AAAL4ergxXkTX+Jsk/5bdceGZXmM9NXJHcBAxRwXlso=
APP_DEBUG=false              
APP_TIMEZONE=UTC
APP_URL=https://mouridexam-api.onrender.com   
FRONTEND_URL=https://votre-frontend.com   
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error               

DB_CONNECTION=mysql
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_DATABASE=$DB_DATABASE
DB_USERNAME=$DB_USERNAME
DB_PASSWORD=$DB_PASSWORD

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=mouridexam-api.onrender.com     

FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=$MAIL_USERNAME
MAIL_PASSWORD=$MAIL_PASSWORD
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=$MAIL_FROM_ADDRESS
MAIL_FROM_NAME=\${APP_NAME}

JWT_SECRET=$JWT_SECRET
JWT_ALGO=HS256

LIBRETRANSLATE_API_URL=https://libretranslate.com" > .env

# Installation des dépendances Composer
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Génération de la clé d'application si nécessaire
php artisan key:generate --force

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

# Migrations de la base de données
php artisan migrate --force