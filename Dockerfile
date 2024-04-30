# Use PHP 7.4
FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html

# Set DNS servers (optional but recommended)
#RUN echo "nameserver 8.8.8.8" > /etc/resolv.conf

# Update package lists and install necessary packages
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
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

# Install PHP extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql zip


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel application files
COPY . .

# Install dependencies
RUN composer install

# Change owner of the Laravel directories
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Clear application cache and config
RUN php artisan cache:clear
RUN php artisan config:clear
# RUN php artisan migrate

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# Copy entrypoint script into the image
COPY entrypoint.sh /entrypoint.sh


# Make the script executable
RUN chmod +x /entrypoint.sh


# Set entrypoint script
ENTRYPOINT ["/entrypoint.sh"]

# RUN ls -la
