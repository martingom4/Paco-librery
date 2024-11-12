#!/bin/bash

# Espera a que PostgreSQL esté listo antes de ejecutar migraciones
until pg_isready -h db -p 5432 -U paco_user
do
  echo "Esperando a que PostgreSQL esté listo..."
  sleep 1
done

# Ejecuta las migraciones (instrucciones SQL en init.sql)
if [ -f /var/www/html/migrations/init.sql ]; then
  echo "Ejecutando migraciones..."
  psql -h db -U paco_user -d paco_librery_db -f /var/www/html/migrations/init.sql
else
  echo "Archivo de migración init.sql no encontrado"
fi

# Inicia Apache en el contenedor
apache2-foreground
