# Paco Librery

Este es un sistema de gestión de librerías desarrollado en PHP sin el uso de frameworks. Utiliza Docker para manejar el entorno de desarrollo con Apache y PostgreSQL.

## Requisitos

Asegúrate de tener [Docker](https://docs.docker.com/get-docker/) instalados en tu sistema.
Despues de esto recuerda que es importante ejecutar Docker para su funcionamiento
Asegúrate de tener [Docker](https://docs.docker.com/get-docker/) instalados en tu sistema.
Despues de esto recuerda que es importante ejecutar Docker para su funcionamiento
## Configuración del Proyecto



---

   ### **Antes de ejecutar el contenedor, realiza los siguientes ajustes:**


   #### **1. Cambia el formato de salto de línea en Visual Studio Code**
   Esto es necesario para asegurarte de que los archivos tengan saltos de línea compatibles con entornos Linux (`LF`).

   1. Abre Visual Studio Code.
   2. Ve a: **Archivo > Preferencias > Configuración**.
   3. En la barra de búsqueda, escribe `eol`.
   4. Encuentra la configuración **Files: Eol** y cámbiala de `auto` a `\n (LF)`.

   ---

   #### **2. Configura los saltos de línea en Git**
   Esto evita que Git convierta los saltos de línea automáticamente al formato `CRLF` al clonar o extraer repositorios.

   1. Abre una terminal Git.
   2. Ejecuta el siguiente comando:
      ```bash
      git config --global core.autocrlf input
      ```
      Esto asegura que Git conserve los saltos de línea en el formato original (`LF`) del repositorio.

   ---


---

1. **Clonar el repositorio**:
   ```
   git clone <URL del repositorio>
   cd Paco-librery
   ```
 #### **1.1. Da permisos de ejecución al archivo `entrypoint.sh`**
   Esto es necesario para que el archivo `entrypoint.sh` pueda ejecutarse dentro del contenedor.


   1. Abre una terminal en Visual Studio Code.
   2. Asegurate que la terminal sea bash
   3. Asegúrate de estar en el directorio raíz de tu proyecto.
   4. Ejecuta el siguiente comando:
      ```bash
      chmod +x ./docker/entrypoint.sh
      ```
      Esto asignará permisos de ejecución al archivo.


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
git checkout -b inicio-sesion-cliente remotes/origin/inicio-sesion-cliente
git checkout -b inicio-sesion-admin remotes/origin/inicio-sesion-admin
git checkout -b registro-admin remotes/origin/registro-admin
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

```
# Archivos y carpetas del sistema
.DS_Store
Thumbs.db

# Archivos de entorno
.env
docker-compose.override.yml
docker/Dockerfile.override

# Archivos de logs
logs/
logs/*

# Configuración de Docker
docker/db_data

# Archivos de bases de datos y backups
*.sql
*.tar.gz
*.gz

# Archivos temporales de PHP
*.log
*.cache

# Directorios generados por Composer y dependencias
/vendor/

# Archivos y directorios que contienen configuraciones específicas de desarrollo
# Ignorar archivos de configuración de Apache o Nginx si es necesario


# Ignorar archivos de configuración en src
src/.migraciones_completadas

# Ignorar archivos de pruebas o ejemplos (si no son necesarios en producción)
tests/
examples/

# Archivos de configuración de entorno de Docker (si contienen credenciales sensibles)
docker-compose.yml
docker/*   # Ignorar el directorio Docker entero si contiene configuraciones sensibles


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

Aquí tienes una sección de documentación para incluir en tu archivo `README.md`, explicando el uso de `docker-compose.override.yml` y `Dockerfile.override` para configuraciones locales:

---

## Configuración de Docker para Desarrollo Local

### Archivos de Configuración

1. **`docker-compose.override.yml`**: Este archivo complementa el archivo `docker-compose.yml` principal y se utiliza para personalizar configuraciones de Docker Compose para el entorno de desarrollo local. 

2. **`Dockerfile.override`**: Este archivo es una versión personalizada del `Dockerfile` principal y contiene configuraciones adicionales o específicas para el desarrollo local, como herramientas de depuración o dependencias adicionales.

### Cómo Configurar el Entorno de Desarrollo Local

1. Crea los archivos `docker-compose.override.yml` y `Dockerfile.override`  en las ubicaciones donde estan los archivos semejantes.

2. **Ejemplo de `docker-compose.override.yml`**:

    ```
    version: '3.9'
    services:
      web:
        build:
          context: .
          dockerfile: docker/Dockerfile.override  # Dockerfile específico para el entorno local
        ports:
          - "8000:80"
        volumes:
          - ./src:/var/www
          - ./logs/apache:/var/log/apache2
          - ./logs/php:/var/log/php
          - ./docker/apache/vhost.conf:/etc/apache2/sites-available/vhost.conf
        env_file:
          - .env
        environment:
          APP_ENV: ${APP_ENV}
          APP_DEBUG: ${APP_DEBUG}
          DB_CONNECTION: ${DB_CONNECTION}
          DB_HOST: ${DB_HOST}
          DB_PORT: ${DB_PORT}
          DB_DATABASE: ${DB_DATABASE}
          DB_USERNAME: ${DB_USERNAME}
          DB_PASSWORD: ${DB_PASSWORD}
        depends_on:
          db:
            condition: service_healthy
        command: >
          /bin/bash -c "a2dissite 000-default.conf && a2ensite vhost.conf && apache2-foreground"
      db:
        image: postgres:13
        environment:
          POSTGRES_DB: ${DB_DATABASE}
          POSTGRES_USER: ${DB_USERNAME}
          POSTGRES_PASSWORD: ${DB_PASSWORD}
        volumes:
          - db_data:/var/lib/postgresql/data
          - ./src/migrations/init.sql:/docker-entrypoint-initdb.d/init.sql
        healthcheck:
          test: ["CMD-SHELL", "pg_isready -U ${DB_USERNAME} -d ${DB_DATABASE}"]
          interval: 30s
          timeout: 10s
          retries: 5

    volumes:
      db_data:
    ```

3. **Ejemplo de `Dockerfile.override`**:

    ```
    # Usar una imagen base de PHP con Apache
    FROM php:7.4-apache

    # Instalar extensiones necesarias de PHP y las bibliotecas de desarrollo de PostgreSQL
    RUN apt-get update && apt-get install -y \
        libpq-dev \
        unzip \
        git \
        && docker-php-ext-install pdo pdo_pgsql \
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
    ```

4. **Ignorar Archivos de Override en el Repositorio**

   Para evitar que estos archivos de configuración local se suban al repositorio, agrégalos a tu archivo `.gitignore`:

    ```gitignore
    # Ignorar archivos de configuración local
    docker-compose.override.yml
    docker/Dockerfile.override
    ```

### Ejecución del Entorno de Desarrollo con Override

Para ejecutar Docker usando estas configuraciones de override, usa el siguiente comando:

```
docker-compose -f docker-compose.yml -f docker-compose.override.yml up --build
```

Este comando carga tanto el archivo principal `docker-compose.yml` como el archivo de override `docker-compose.override.yml`, aplicando las configuraciones adicionales sin afectar el entorno de producción o las configuraciones de otros desarrolladores.

### Ventajas de Usar Override

- **Aislamiento de configuraciones**: Mantén las configuraciones de producción separadas de las de desarrollo.
- **Evita conflictos**: Cada desarrollador puede tener su configuración sin afectar al proyecto principal.
- **Flexibilidad**: Puedes agregar o eliminar configuraciones según el entorno sin modificar el `Dockerfile` y `docker-compose.yml` principal.

--- 

Esta configuración ayuda a mantener un entorno de desarrollo limpio y flexible, permitiendo personalizar el entorno local sin interferir con el flujo de trabajo del equipo o el entorno de producción.
