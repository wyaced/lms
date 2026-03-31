FROM php:8.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql intl zip
    # && apt-get clean \
    # && rm -rf /var/lib/apt/lists/*

# Install Node.js (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy full Laravel project
# COPY . . # patched out to avoid redundancy with volume mount

# Install PHP dependencies note
# RUN composer install # patched out due to issues with autoload.php

# Install Node dependencies (Vite + React)
# RUN npm install # patched out to avoid redundancy with volume mount

EXPOSE 8000 5173

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
