# Stage 1 — Use official Composer image to install dependencies
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist


# Stage 2 — Build final PHP-Apache image
FROM php:8.2-apache

# Enable rewrite module for routing
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy project files and vendor folder
COPY . .
COPY --from=vendor /app/vendor ./vendor

# --- Apache Config Fix ---
# Allow .htaccess and full access to /var/www/html
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Add a custom VirtualHost config
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/project.conf && \
    a2enconf project

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]
