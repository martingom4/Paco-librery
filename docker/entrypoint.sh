#!/bin/bash
echo "Esperando a que PostgreSQL esté listo..."
until pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
  sleep 2
done
echo "Ejecutando migraciones..."
if [ -f /var/www/html/migrations/init.sql ]; then
  export PGPASSWORD=$DB_PASSWORD
  psql -h $DB_HOST -U $DB_USERNAME -d $DB_DATABASE -f /var/www/html/migrations/init.sql
fi
echo "Configurando ServerName en Apache..."
echo "ServerName localhost" >> /etc/apache2/apache2.conf
echo "Iniciando Apache..."
apache2-foreground
