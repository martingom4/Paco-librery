# Usar una imagen base de PHP con Apache
FROM php:8.1-apache

# Instalar dependencias y las bibliotecas necesarias
RUN apt-get update && \
    apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Habilitar el módulo de headers para CORS
RUN a2enmod headers

# Copiar el archivo de configuración de Apache
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Descargar e instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar el directorio de trabajo para Composer y el proyecto
WORKDIR /var/www/

# Copiar composer.json y composer.lock en el contenedor
COPY ./src/composer.json ./src/composer.lock ./

# Instalar dependencias de Composer en /var/www/vendor
RUN composer install --optimize-autoloader --no-interaction --prefer-dist --no-scripts --no-progress


# Exponer el puerto 80
EXPOSE 80

# Cambiar la propiedad de los archivos a www-data para Apache
RUN chown -R www-data:www-data /var/www

# Copiar el script de entrada y darle permisos de ejecución
COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Configurar el script de entrada
ENTRYPOINT ["/entrypoint.sh"]
