# Use the official PHP image with the required PHP version
FROM php:8.3.10-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN service apache2 restart

# Set working directory
WORKDIR /var/www/html

# Copy the existing application directory contents
COPY . .

# RUN ln -s public html
# Set proper permissions for Laravel files
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install

# Expose port 9000
EXPOSE 80

# Start server
CMD ["apache2-foreground"]
