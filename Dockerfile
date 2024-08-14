# Use the official PHP image with FPM
FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application code to the container
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate application key and run migrations
RUN php artisan key:generate && php artisan migrate --force

# Install Node.js and npm
RUN apt-get install -y nodejs npm

# Install Node.js dependencies and build assets
RUN npm install && npm run production

# Expose port 80
EXPOSE 80

# Start PHP-FPM server
CMD ["php-fpm"]
