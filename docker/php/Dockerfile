# Base image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

ADD app .

COPY ./app/.env.example ./.env

# Install dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client \ 
    && docker-php-ext-install pdo_mysql zip \
    && a2enmod rewrite


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

COPY ./docker/php/utils/wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it

# Copy entrypoint script
COPY ./docker/php/utils/docker-entrypoint.sh /usr/bin/docker-entrypoint.sh
RUN chmod +x /usr/bin/docker-entrypoint.sh

# Expose port 80
EXPOSE 80

# Start Apache
# CMD ["apache2-foreground"]

# Use entrypoint script
ENTRYPOINT ["/usr/bin/docker-entrypoint.sh"]