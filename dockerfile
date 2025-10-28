# Use PHP with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y unzip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy all project files into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Set the correct permissions for public directory
RUN chown -R www-data:www-data /var/www/html

# Change Apache DocumentRoot to /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
