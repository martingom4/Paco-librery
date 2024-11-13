-- Crear la base de datos solo si no existe
DO $$ BEGIN
   IF NOT EXISTS (SELECT 1 FROM pg_database WHERE datname = 'paco_librery_db') THEN
      CREATE DATABASE paco_librery_db;
   END IF;
END $$;

-- Conectar a la base de datos
\c paco_librery_db;

-- Tabla para Tipo de Teléfono
CREATE TABLE IF NOT EXISTS Tipo_telefono (
    tipo_telefono SERIAL PRIMARY KEY,
    descripcion VARCHAR(20) NOT NULL
);

-- Tabla para Tipo de Correo
CREATE TABLE IF NOT EXISTS Tipo_correo (
    tipo_correo SERIAL PRIMARY KEY,
    descripcion VARCHAR(20) NOT NULL
);

-- Tabla para Editorial
CREATE TABLE IF NOT EXISTS Editorial (
    ID_editorial SERIAL PRIMARY KEY,
    nombre VARCHAR(50),
    corregimiento VARCHAR(50),
    calle VARCHAR(50),
    num_loc VARCHAR(10)
);

-- Tabla para Librería
CREATE TABLE IF NOT EXISTS Libreria (
    ID_libreria SERIAL PRIMARY KEY,
    nom_lib VARCHAR(50) NOT NULL,
    corregimiento VARCHAR(50) NOT NULL,
    calle VARCHAR(50) NOT NULL,
    num_loc VARCHAR(10) NOT NULL
);

-- Tabla para Cliente
CREATE TABLE IF NOT EXISTS Cliente (
    ID_cliente SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL -- Almacenada como hash
);

-- Tabla para Autor
CREATE TABLE IF NOT EXISTS Autor (
    ID_autor SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    edad INT NOT NULL,
    fecha_nac DATE NOT NULL
);

-- Tabla para Empleado
CREATE TABLE IF NOT EXISTS Empleado (
    ID_empleado SERIAL PRIMARY KEY,
    CIP VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    fecha_contrato DATE NOT NULL,
    fecha_nac DATE NOT NULL,
    edad INT NOT NULL,
    sueldo DECIMAL(10, 2) NOT NULL,
    cargo VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    ID_libreria_e INT NOT NULL REFERENCES Libreria(ID_libreria) ON DELETE SET NULL
);

-- Tabla para Teléfono de Empleado
CREATE TABLE IF NOT EXISTS Telefono_empleado (
    T_ID_empleado INT NOT NULL REFERENCES Empleado(ID_empleado) ON DELETE CASCADE,
    T_empleado_tipo_telefono INT NOT NULL REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE,
    tel_empleado VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_empleado, T_empleado_tipo_telefono)
);

-- Tabla para Teléfono de Librería
CREATE TABLE IF NOT EXISTS Telefono_libreria (
    T_ID_libreria INT NOT NULL REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    T_libreria_tipo_telefono INT NOT NULL REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE,
    tel_lib VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_libreria, T_libreria_tipo_telefono)
);

-- Tabla para Teléfono de Editorial
CREATE TABLE IF NOT EXISTS Telefono_editorial (
    T_ID_editorial INT NOT NULL REFERENCES Editorial(ID_editorial) ON DELETE CASCADE,
    T_editorial_tipo_telefono INT NOT NULL REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE,
    tel_editorial VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_editorial, T_editorial_tipo_telefono)
);

-- Tabla para Teléfono de Autor
CREATE TABLE IF NOT EXISTS Telefono_autor (
    T_ID_autor INT NOT NULL REFERENCES Autor(ID_autor) ON DELETE CASCADE,
    T_autor_tipo_telefono INT NOT NULL REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE,
    tel_autor VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_autor, T_autor_tipo_telefono)
);

-- Tabla para Correo de Cliente
CREATE TABLE IF NOT EXISTS Correo_cliente (
    C_ID_cliente INT NOT NULL REFERENCES Cliente(ID_cliente) ON DELETE CASCADE,
    C_cliente_tipo_correo INT NOT NULL REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE,
    correo_cliente VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_cliente, C_cliente_tipo_correo)
);

-- Tabla para Correo de Librería
CREATE TABLE IF NOT EXISTS Correo_libreria (
    C_ID_libreria INT NOT NULL REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    C_libreria_tipo_correo INT NOT NULL REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE,
    correo_lib VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_libreria, C_libreria_tipo_correo)
);

-- Tabla para Correo de Editorial
CREATE TABLE IF NOT EXISTS Correo_editorial (
    C_ID_editorial INT NOT NULL REFERENCES Editorial(ID_editorial) ON DELETE CASCADE,
    C_editorial_tipo_correo INT NOT NULL REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE,
    correo_editorial VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_editorial, C_editorial_tipo_correo)
);

-- Tabla para Correo de Autor
CREATE TABLE IF NOT EXISTS Correo_autor (
    C_ID_autor INT NOT NULL REFERENCES Autor(ID_autor) ON DELETE CASCADE,
    C_autor_tipo_correo INT NOT NULL REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE,
    correo_autor VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_autor, C_autor_tipo_correo)
);

-- Tabla para Premio de Autor
CREATE TABLE IF NOT EXISTS Premio_autor (
    ID_premio SERIAL PRIMARY KEY,
    P_ID_autor INT NOT NULL REFERENCES Autor(ID_autor) ON DELETE CASCADE,
    nom_premio VARCHAR(50) NOT NULL
);

-- Tabla para Género
CREATE TABLE IF NOT EXISTS Genero (
    ID_genero SERIAL PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

-- Tabla para Libro
CREATE TABLE IF NOT EXISTS Libro (
    ISBN VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    edicion VARCHAR(20) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    fecha_publi DATE NOT NULL,
    L_ID_editorial INT NOT NULL REFERENCES Editorial(ID_editorial) ON DELETE SET NULL,
    L_ID_autor INT NOT NULL REFERENCES Autor(ID_autor) ON DELETE SET NULL,
    L_ID_genero INT NOT NULL REFERENCES Genero(ID_genero) ON DELETE SET NULL
);

-- Tabla para Inventario
CREATE TABLE IF NOT EXISTS Inventario (
    ID_libreria_inv INT NOT NULL REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    ISBN_inv VARCHAR(20) NOT NULL REFERENCES Libro(ISBN) ON DELETE CASCADE,
    cantidad_disponible INT NOT NULL,
    PRIMARY KEY (ID_libreria_inv, ISBN_inv)
);

-- Tabla para Venta
CREATE TABLE IF NOT EXISTS Venta (
    ID_venta SERIAL PRIMARY KEY,
    ISBN_v VARCHAR(20) NOT NULL REFERENCES Libro(ISBN) ON DELETE CASCADE,
    ID_cliente_v INT NOT NULL REFERENCES Cliente(ID_cliente) ON DELETE CASCADE,
    ID_libreria_v INT NOT NULL REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    ID_empleado_v INT NOT NULL REFERENCES Empleado(ID_empleado) ON DELETE SET NULL,
    cantidad INT NOT NULL,
    metodo_pago VARCHAR(15) NOT NULL,
    ITBMS DECIMAL(10, 2) NOT NULL,
    costo_total DECIMAL(10, 2) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL
);

-- Tabla para Auditoría
CREATE TABLE IF NOT EXISTS Auditoria (
    ID_Auditoria SERIAL PRIMARY KEY,
    tabla_afectada VARCHAR(50) NOT NULL,
    tipo_cambio VARCHAR(20) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);


CREATE TABLE IF NOT EXISTS Pago (
    ID_pago SERIAL PRIMARY KEY,
    ID_venta INT NOT NULL REFERENCES Venta(ID_venta) ON DELETE CASCADE, -- Asociación directa con Venta
    metodo_pago VARCHAR(50) NOT NULL, -- Ejemplo: 'tarjeta', 'paypal', etc.
    estado VARCHAR(20) NOT NULL, -- Estado de la transacción: 'pendiente', 'completado', 'fallido'
    monto DECIMAL(10, 2) NOT NULL, -- Monto del pago en USD
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, -- Fecha y hora del pago
    referencia_externa VARCHAR(100) -- Identificador de la transacción en el sistema externo
);



-- datos para mejor funcionamiento


-- Tipos de teléfono
INSERT INTO Tipo_telefono (descripcion) VALUES ('personal') ON CONFLICT DO NOTHING;
INSERT INTO Tipo_telefono (descripcion) VALUES ('trabajo') ON CONFLICT DO NOTHING;
INSERT INTO Tipo_telefono (descripcion) VALUES ('principal') ON CONFLICT DO NOTHING;

-- Tipos de correo
INSERT INTO Tipo_correo (descripcion) VALUES ('personal') ON CONFLICT DO NOTHING;
INSERT INTO Tipo_correo (descripcion) VALUES ('trabajo') ON CONFLICT DO NOTHING;
INSERT INTO Tipo_correo (descripcion) VALUES ('general') ON CONFLICT DO NOTHING;

-- Géneros
INSERT INTO Genero (descripcion) VALUES ('Misterio') ON CONFLICT DO NOTHING;
INSERT INTO Genero (descripcion) VALUES ('Ciencia Ficción') ON CONFLICT DO NOTHING;
INSERT INTO Genero (descripcion) VALUES ('Romance') ON CONFLICT DO NOTHING;
INSERT INTO Genero (descripcion) VALUES ('Fantasía') ON CONFLICT DO NOTHING;
INSERT INTO Genero (descripcion) VALUES ('Terror') ON CONFLICT DO NOTHING;
