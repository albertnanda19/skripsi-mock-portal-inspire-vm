
# Gunakan image PHP yang sesuai dengan versi PHP yang digunakan proyek Anda
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependensi
COPY composer.json composer.lock ./
RUN composer install

# Copy seluruh file proyek
COPY . .

# Set permission
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 9000

# Command untuk menjalankan aplikasi
CMD ["php-fpm"]

# FROM php:8.3.12-apache

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --version=2.7.9 --install-dir=/usr/local/bin --filename=composer

# RUN docker-php-ext-install mysqli pdo pdo_mysql

# RUN a2enmod rewrite

# COPY . /var/www/html

# RUN chown -R www-data:www-data /var/www/html


# WORKDIR /var/www/html

# EXPOSE 80
