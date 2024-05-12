# Use the official PHP 8.2 image as the base image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container
WORKDIR /var/www/html

# Copy composer files to the container and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code to the container
COPY . .

# Run composer to generate autoloader and optimize
RUN composer dump-autoload --optimize --classmap-authoritative

# Expose port 8000 to the outside world
EXPOSE 8000

# Start PHP-FPM server
CMD ["php-fpm"]

# Example for setting up PostgreSQL service if needed
# (You might need to adjust this part based on your specific database setup)
# COPY docker/postgres/my_database.sql /docker-entrypoint-initdb.d/
# ENV POSTGRES_DB=my_database
# ENV POSTGRES_USER=my_user
# ENV POSTGRES_PASSWORD=my_password
