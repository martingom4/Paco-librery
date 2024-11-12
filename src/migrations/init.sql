-- Crear la base de datos solo si no existe
DO $$ BEGIN
   IF NOT EXISTS (SELECT 1 FROM pg_database WHERE datname = 'paco_librery_db') THEN
      CREATE DATABASE paco_librery_db;
   END IF;
END $$;

-- Conectar a la base de datos
\c paco_librery_db;

-- Crear la tabla users solo si no existe
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
