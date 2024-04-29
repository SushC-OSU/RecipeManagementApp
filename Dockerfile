# Use PHP 7.4
FROM php:7.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Remove the default nginx index page
RUN rm -rf /var/www/html

# Symlink public directory
RUN ln -s public html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Copy wait-for-it.sh
# COPY wait-for-it.sh /wait-for-it.sh

# Make wait-for-it.sh executable
# RUN chmod +x /wait-for-it.sh


# Copy entrypoint.sh
COPY entrypoint.sh /entrypoint.sh


# Change ownership of entrypoint.sh
RUN chown www-data:www-data /entrypoint.sh

RUN mkdir -p /var/www/storage/logs
RUN chown -R www-data:www-data /var/www/storage


# RUN chown -R www-data:www-data /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache


# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# Set entrypoint script
ENTRYPOINT ["/entrypoint.sh"]

RUN ls -la
