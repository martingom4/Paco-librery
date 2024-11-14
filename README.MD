Aquí tienes el README ajustado con el formato correcto y el contenido completo:

````markdown
# Paco Librery

Este es un sistema de gestión de librerías desarrollado en PHP sin el uso de frameworks. Utiliza Docker para manejar el entorno de desarrollo con Apache y PostgreSQL.

## Requisitos

Asegúrate de tener [Docker](https://docs.docker.com/get-docker/) y [Docker Compose](https://docs.docker.com/compose/install/) instalados en tu sistema.

## Configuración del Proyecto

1. **Clonar el repositorio**:
   ```bash
   git clone <URL del repositorio>
   cd paco_librery
   ```
````
1.1 **Para configurar en windows se necesita cambiar dos archivos:** 
   ## Primero cambia el entrypoint.sh
  ```
    #!/bin/bash
echo "Esperando a que PostgreSQL esté listo..."
until pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
  sleep 3
done

# Ejecutar migraciones solo si no se han ejecutado antes
if [ ! -f /var/www/.migraciones_completadas ]; then
  echo "Ejecutando migraciones..."
  if [ -f /var/www/html/migrations/init.sql ]; then
    export PGPASSWORD=$DB_PASSWORD
    psql -h $DB_HOST -U $DB_USERNAME -d $DB_DATABASE -f /var/www/html/migrations/init.sql
  fi
  # Crear un archivo de marca para indicar que las migraciones se ejecutaron
  touch /var/www/.migraciones_completadas
fi

echo "Configurando ServerName en Apache..."
echo "ServerName localhost" >> /etc/apache2/apache2.conf
echo "Iniciando Apache..."
apache2-foreground
  ```

   ## Dockerfile 
      ```
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
         # ENTRYPOINT ["/entrypoint.sh"]
      
      ```
2. **Crear el archivo de entorno**:
   Crea un archivo `.env` en la raíz del proyecto con las siguientes variables de entorno:

   ```env
   # Configuración general del entorno
      APP_ENV=development
      APP_DEBUG=true
      
      # Configuración de la base de datos
      DB_CONNECTION=pgsql
      DB_HOST=db
      DB_PORT=5432
      DB_DATABASE=paco_librery_db
      DB_USERNAME=paco_user
      DB_PASSWORD=paco1234
   ```

## Configuración de Entornos

- **Desarrollo**: Configura `APP_ENV=development` y `APP_DEBUG=true` en `.env` para ver los errores y advertencias.
- **Producción**: Cambia a `APP_ENV=production` y `APP_DEBUG=false` para ocultar errores y advertencias en el entorno de producción.
3. **si es primera vez en iniciar docker ejecuta este comando**:
   ```bash
   docker-compose up --build
   ```
3.1 **Iniciar los contenedores**:
   Ejecuta el siguiente comando para iniciar el entorno:

   ```bash
   docker-compose up -d
   ```

4. **Acceder al proyecto**:
   Una vez que los contenedores estén en ejecución, abre el navegador y accede a la URL:

   - [http://localhost:8000](http://localhost:8000)

5. **Ejecutar migraciones de la base de datos**:
   Las migraciones se ejecutan automáticamente al iniciar el contenedor. Si deseas ejecutarlas manualmente, usa el archivo `src/migrations/init.sql`.

6. **Apagar el proyecto**:
   Para detener los contenedores, ejecuta:
   ```bash
   docker-compose down
   ```

## Estructura de Carpetas

- **src/public/**: Contiene los archivos frontend (HTML, CSS, JS) y el archivo `index.php`.
- **src/app/**: Contiene la lógica de backend, organizada en controladores, modelos, vistas y helpers.
- **src/config/**: Configuración del proyecto, incluyendo la conexión a la base de datos.
- **docker/**: Archivos de configuración de Docker, como el Dockerfile y configuraciones de Apache.
- **logs/**: Carpeta para almacenar los logs de Apache y PHP.



## Acceso a Logs

- **Apache logs**: Los logs de Apache se encuentran en `logs/apache/`.
- **PHP logs**: Los logs de PHP están en `logs/php/`.
- Estos logs son útiles para depurar y solucionar problemas en el proyecto.

## Notas

- La base de datos persiste en un volumen llamado `db_data`, por lo que los datos no se perderán cuando se apaguen los contenedores.
- Cualquier cambio en la carpeta `src` se refleja automáticamente en el contenedor.

## Archivos Ignorados en el Control de Versiones

El archivo `.gitignore` está configurado para ignorar archivos sensibles o innecesarios en el repositorio, incluyendo:
## **Importante** despues de configurar todo en el archivo gitignore colocar esta configuracion
```

# Archivos y carpetas del sistema
.DS_Store
Thumbs.db

# Archivos de entorno (no incluir el archivo .env en producción)
.env

# Archivos de logs
logs/
logs/*

# Archivos temporales de PHP
*.log
*.cache

# Configuración de Docker
docker/db_data

# Archivos y configuraciones de Docker que no deben subirse
docker/entrypoint.sh
Dockerfile

```



Si encuentras problemas al iniciar los contenedores, asegúrate de que el archivo `entrypoint.sh` tiene permisos de ejecución. Ejecuta:
```bash
chmod +x docker/entrypoint.sh

