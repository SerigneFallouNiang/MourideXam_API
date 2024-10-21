FROM php:8.3

# Install dependencies and PHP extensions
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libonig-dev \
    libzip-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    mariadb-client \
    libgd-dev \
    libmagickwand-dev \
    libmagickcore-dev \
    imagemagick \
    && docker-php-ext-install pdo_mysql mbstring gd exif

# Install Imagick from source
RUN cd /tmp && \
    git clone https://github.com/Imagick/imagick.git && \
    cd imagick && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    docker-php-ext-enable imagick

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /app

# Copy application files
COPY . /app

# Set permissions for the application
RUN chown -R www-data:www-data /app


# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --verbose

# Require additional packages
RUN composer require php-open-source-saver/jwt-auth \
    guzzlehttp/guzzle \
    stichoza/google-translate-php

# Define the command to run the application
CMD php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider" && \
    php artisan storage:link && \
    php artisan key:generate && \
    php artisan migrate:refresh && \
    php artisan jwt:secret && \
    php artisan serve --host=0.0.0.0 --port=8181

# Expose the application port
EXPOSE 8181