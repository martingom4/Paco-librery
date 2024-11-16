# Usar una imagen base de PHP con Apache
FROM php:7.4-apache

# Instalar extensiones necesarias de PHP y las bibliotecas de desarrollo de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*  # Limpiar la cache de apt para reducir el tamaño de la imagen

# Instalar el cliente de PostgreSQL
RUN apt-get update && apt-get install -y postgresql-client \
    && rm -rf /var/lib/apt/lists/*  # Limpiar la cache de apt

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

# Copiar composer.json en el contenedor
COPY ./src/composer.json ./

# Instalar dependencias de Composer en /var/www/vendor
RUN composer install --no-dev --optimize-autoloader

# Copiar el código fuente de la aplicación desde src sin incluir composer.json y .env
COPY ./src /var/www/

# Exponer el puerto 80
EXPOSE 80

# Cambiar la propiedad de los archivos a www-data para Apache
RUN chown -R www-data:www-data /var/www

# Copiar el script de entrada y darle permisos de ejecución
COPY ./docker/entrypoint.sh /entrypoint.sh

# Configurar el script de entrada
ENTRYPOINT ["/entrypoint.sh"]
