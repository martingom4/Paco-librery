Aquí tienes el archivo `README.md` ajustado con el formato adecuado y el contenido completo:

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

### 1.1 **Para configurar en Windows, se necesita cambiar dos archivos:**

#### Primero cambia el `entrypoint.sh`:

```bash
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

#### Dockerfile:

```dockerfile
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
WORKDIR /var/www/html

# Copiar composer.json en el contenedor
COPY ./src/composer.json ./

# Instalar dependencias de Composer en /var/www/html/vendor
RUN composer install --no-dev --optimize-autoloader

# Copiar el código fuente de la aplicación desde src sin incluir composer.json y .env
COPY ./src /var/www/html

# Copiar el archivo .env directamente a /var/www/html/.env
COPY .env /var/www/html/.env

# Exponer el puerto 80
EXPOSE 80

# Cambiar la propiedad de los archivos a www-data para Apache
RUN chown -R www-data:www-data /var/www

# Copiar el script de entrada y darle permisos de ejecución
COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x docker/entrypoint.sh


# Configurar el script de entrada
ENTRYPOINT ["/entrypoint.sh"]
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

3. **Si es la primera vez iniciando Docker, ejecuta este comando**:

   ```bash
   docker-compose up --build
   ```

4. **Iniciar los contenedores**:
   Ejecuta el siguiente comando para iniciar el entorno:

   ```bash
   docker-compose up -d
   ```

5. **Acceder al proyecto**:
   Una vez que los contenedores estén en ejecución, abre el navegador y accede a la URL:

   - [http://localhost:8000](http://localhost:8000)

6. **Ejecutar migraciones de la base de datos**:
   Las migraciones se ejecutan automáticamente al iniciar el contenedor. Si deseas ejecutarlas manualmente, usa el archivo `src/migrations/init.sql`.

7. **Apagar el proyecto**:
   Para detener los contenedores, ejecuta:

   ```bash
   docker-compose down
   ```

8. **Las ramas que se estan utilizando se pueden activar con**:

```
git checkout -b busqueda-libro remotes/origin/busqueda-libro
git checkout -b develop remotes/origin/develop
git checkout -b factura remotes/origin/factura
git checkout -b inicio-sesion remotes/origin/inicio-sesion-cliente
git checkout -b inicio-sesion-admin remotes/origin/inicio-sesion-admin
git checkout -b inicio-sesion-admin remotes/origin/registro-admin
git checkout -b registro-cliente remotes/origin/registro-cliente
```

Se tendria que navegar dependiendo de lo que se quiera programar

## Estructura de Carpetas

- **src/public/**: Contiene los archivos frontend (HTML, CSS, JS) y el archivo `home.php`.
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

```gitignore
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

## **importante**

para que los cambios de archivos de contenedor se debe usar este comando despues de haber configurado todo en tu sistema

```
git update-index --no-assume-unchanged docker/Dockerfile
git update-index --no-assume-unchanged docker/apache/vhost.conf
git update-index --no-assume-unchanged docker/entrypoint.sh
git update-index --no-assume-unchanged docker-compose.yml
```

Esto lo que hace es que ignora los cambios que se pudieron hacer en la instalacion sin que dañe produccion

Ejecutar estos comandos en la terminal bash para que se vean reflejados




Aquí tienes una guía en formato de README para que tu equipo pueda seguir los pasos y mantener sus ramas actualizadas sin generar conflictos:

---

# Guía para Mantener las Ramas Actualizadas sin Conflictos

---

## 1. **Usar `git fetch` para Traer Cambios sin Fusionarlos Automáticamente**

El comando `git fetch` permite traer los últimos cambios del repositorio remoto sin aplicarlos automáticamente en las ramas locales. Esto es útil para revisar los cambios antes de fusionarlos y evitar conflictos inesperados.

```
git fetch origin
```

Esto actualizará la referencia de las ramas remotas en tu repositorio local (como `origin/busqueda-libro`, `origin/develop`, etc.) sin modificar tus ramas locales.

---

## 2. **Verificar los Cambios en las Ramas Remotas**

Para inspeccionar los cambios antes de aplicarlos, puedes comparar tus ramas locales con las versiones en el remoto. Esto es útil para identificar posibles conflictos antes de la fusión.

```
git diff <rama-local> origin/<rama-remota>
```

Ejemplo para la rama `develop`:

```
git diff develop origin/develop
```

---

## 3. **Fusionar los Cambios con `rebase` en Lugar de `merge`**

Utilizar `rebase` en lugar de `merge` ayuda a mantener un historial de cambios más limpio y facilita la resolución de conflictos. Sigue estos pasos para actualizar tu rama:

1. Cambia a la rama local que deseas actualizar:

   ```
   git checkout <rama-local>
   ```

2. Usa `rebase` para aplicar los cambios de la rama remota:

   ```
   git rebase origin/<rama-remota>
   ```

   Ejemplo para `develop`:

   ```
   git checkout develop #esto es para moverte entre las ramas que existen en este caso develop
   git rebase origin/develop
   ```

   Si hay conflictos, Git solicitará que los resuelvas uno por uno. Después de resolver cada conflicto, usa:

   ```
   git add <archivo-con-conflicto>
   git rebase --continue
   ```

   Si deseas abortar el rebase en cualquier momento, puedes usar:

   ```b
   git rebase --abort
   ```

---

## 4. **Trabajar en Ramas de Características (Feature Branches)**

Evita trabajar directamente en las ramas principales como `main` o `develop`. En su lugar, utiliza ramas de características (feature branches) para cada tarea específica, por ejemplo, `busqueda-libro` o `registro-cliente`. Esto permite que los cambios se prueben y validen antes de fusionarlos en las ramas principales.

---

## 5. **Pruebas Locales Antes de Hacer `push` al Remoto**

Antes de subir tus cambios al repositorio remoto:

1. Asegúrate de que todo funcione correctamente en tu entorno local.
2. Haz un último `git fetch` y `git rebase` en tu rama de trabajo para asegurarte de que tienes la última versión del remoto y evitar conflictos de último momento.

Para subir tus cambios:

```
git push origin <rama-local>
```

---

## Ejemplo Completo del Flujo de Trabajo

Aquí tienes un ejemplo del flujo completo, usando la rama `busqueda-libro` como ejemplo:

1. Trae los cambios del remoto:

   ```
   git fetch origin
   ```

2. Rebasa tu rama `busqueda-libro` sobre `develop` del remoto para mantenerla actualizada:

   ```
   git checkout busqueda-libro
   git rebase origin/develop
   ```

3. Resuelve cualquier conflicto si es necesario, luego:

   ```
   git add <archivo-con-conflicto>
   git rebase --continue
   ```

4. Finalmente, sube tus cambios:

   ```bash
   git push origin busqueda-libro
   ```

---

Siguiendo estos pasos, el equipo puede mantener el repositorio sincronizado y minimizar los conflictos en el proceso de colaboración. Si tienes dudas, consulta con el equipo antes de proceder.

---
