#!/bin/bash
set -e  # Detener el script si ocurre un error

echo "Esperando a que MySQL esté listo..."
until mysqladmin ping -h "$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
  echo "MySQL no está listo. Reintentando en 3 segundos..."
  sleep 3
done

# Ejecutar migraciones solo si no se han ejecutado antes
if [ ! -f /var/www/.migraciones_completadas ]; then
  echo "Ejecutando migraciones..."
  if [ -f /var/www/migrations/init.sql ]; then
    echo "Encontrado init.sql. Ejecutando..."
    mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < /var/www/migrations/init.sql
    echo "Migraciones completadas con éxito."
  else
    echo "Archivo init.sql no encontrado. Saltando migraciones."
  fi
  # Crear un archivo de marca para indicar que las migraciones se ejecutaron
  touch /var/www/.migraciones_completadas
else
  echo "Migraciones ya fueron ejecutadas previamente. Saltando este paso."
fi

# Configuración de Apache
echo "Configurando ServerName en Apache..."
if ! grep -q "ServerName localhost" /etc/apache2/apache2.conf; then
  echo "ServerName localhost" >> /etc/apache2/apache2.conf
fi

# Iniciar Apache
echo "Iniciando Apache..."
apache2-foreground
