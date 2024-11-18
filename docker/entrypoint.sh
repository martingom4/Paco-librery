#!/bin/bash
set -e  # Detener el script si ocurre un error

echo "Esperando a que MySQL esté listo..."
until mysqladmin ping -h "$DB_HOST" --silent; do
  echo "MySQL no está listo. Reintentando en 3 segundos..."
  sleep 3
done

# Ejecutar migraciones solo si no se han ejecutado antes
if [ ! -f /var/www/.migraciones_completadas ]; then
  echo "Ejecutando migraciones..."
  if [ -f /var/www/migrations/init.sql ]; then
    mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < /var/www/migrations/init.sql
  fi
  # Crear un archivo de marca para indicar que las migraciones se ejecutaron
  touch /var/www/.migraciones_completadas
fi

echo "Configurando ServerName en Apache..."
echo "ServerName localhost" >> /etc/apache2/apache2.conf

echo "Iniciando Apache..."
apache2-foreground
