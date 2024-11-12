# Usa una imagen base de PHP con Apache
FROM php:8.0-apache

# Instala extensiones de PHP necesarias para PostgreSQL y el cliente de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Copia el archivo de configuración de Apache
COPY docker/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Habilita el módulo rewrite de Apache
RUN a2enmod rewrite

# Copia el archivo de configuración php.ini
COPY docker/php.ini /usr/local/etc/php/php.ini

# Copia el archivo de migración y el script de entrada
COPY docker/migrations /var/www/html/migrations
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Configura el entrypoint
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
