# docker/Dockerfile

# Usar una imagen base de PHP con Apache
FROM php:7.4-apache

# Instalar extensiones necesarias de PHP y las bibliotecas de desarrollo de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar el cliente de PostgreSQL
RUN apt-get update && apt-get install -y postgresql-client

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copiar el archivo de configuración de Apache
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Configurar permisos para el directorio de la aplicación
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Copiar el código fuente de la aplicación al contenedor
COPY ./src /var/www/html

# Copiar el archivo .env al contenedor
COPY ./.env /var/www/.env

# Copiar el script de entrada
COPY ./docker/entrypoint.sh /entrypoint.sh

# Otorgar permisos de ejecución al script de entrada
RUN chmod +x /entrypoint.sh

# Configurar el script de entrada
ENTRYPOINT ["/entrypoint.sh"]
