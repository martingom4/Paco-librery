-- Crear la base de datos y seleccionarla
CREATE DATABASE IF NOT EXISTS paco_librery_db;
USE paco_librery_db;

-- Tabla para Tipo de Teléfono
CREATE TABLE IF NOT EXISTS Tipo_telefono (
    tipo_telefono INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(20) NOT NULL
);

-- Tabla para Tipo de Correo
CREATE TABLE IF NOT EXISTS Tipo_correo (
    tipo_correo INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(20) NOT NULL
);

-- Tabla para Editorial
CREATE TABLE IF NOT EXISTS Editorial (
    ID_editorial INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    corregimiento VARCHAR(50),
    calle VARCHAR(50),
    num_loc VARCHAR(10)
);

-- Tabla para Librería
CREATE TABLE IF NOT EXISTS Libreria (
    ID_libreria INT AUTO_INCREMENT PRIMARY KEY,
    nom_lib VARCHAR(50) NOT NULL,
    corregimiento VARCHAR(50) NOT NULL,
    calle VARCHAR(50) NOT NULL,
    num_loc VARCHAR(10) NOT NULL
);

-- Tabla para Cliente
CREATE TABLE IF NOT EXISTS Cliente (
    ID_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL -- Almacenada como hash
);

-- Tabla para Autor
CREATE TABLE IF NOT EXISTS Autor (
    ID_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    edad INT NOT NULL,
    fecha_nac DATE NOT NULL
);

-- Tabla para Empleado
CREATE TABLE IF NOT EXISTS Empleado (
    ID_empleado INT AUTO_INCREMENT PRIMARY KEY,
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
    ID_libreria_e INT,
    FOREIGN KEY (ID_libreria_e) REFERENCES Libreria(ID_libreria) ON DELETE SET NULL
);

-- Tabla para Teléfono de Empleado
CREATE TABLE IF NOT EXISTS Telefono_empleado (
    T_ID_empleado INT NOT NULL,
    T_empleado_tipo_telefono INT NOT NULL,
    tel_empleado VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_empleado, T_empleado_tipo_telefono),
    FOREIGN KEY (T_ID_empleado) REFERENCES Empleado(ID_empleado) ON DELETE CASCADE,
    FOREIGN KEY (T_empleado_tipo_telefono) REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE
);

-- Tabla para Teléfono de Librería
CREATE TABLE IF NOT EXISTS Telefono_libreria (
    T_ID_libreria INT NOT NULL,
    T_libreria_tipo_telefono INT NOT NULL,
    tel_lib VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_libreria, T_libreria_tipo_telefono),
    FOREIGN KEY (T_ID_libreria) REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    FOREIGN KEY (T_libreria_tipo_telefono) REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE
);

-- Tabla para Teléfono de Editorial
CREATE TABLE IF NOT EXISTS Telefono_editorial (
    T_ID_editorial INT NOT NULL,
    T_editorial_tipo_telefono INT NOT NULL,
    tel_editorial VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_editorial, T_editorial_tipo_telefono),
    FOREIGN KEY (T_ID_editorial) REFERENCES Editorial(ID_editorial) ON DELETE CASCADE,
    FOREIGN KEY (T_editorial_tipo_telefono) REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE
);

-- Tabla para Teléfono de Autor
CREATE TABLE IF NOT EXISTS Telefono_autor (
    T_ID_autor INT NOT NULL,
    T_autor_tipo_telefono INT NOT NULL,
    tel_autor VARCHAR(20) NOT NULL,
    PRIMARY KEY (T_ID_autor, T_autor_tipo_telefono),
    FOREIGN KEY (T_ID_autor) REFERENCES Autor(ID_autor) ON DELETE CASCADE,
    FOREIGN KEY (T_autor_tipo_telefono) REFERENCES Tipo_telefono(tipo_telefono) ON DELETE CASCADE
);

-- Tabla para Correo de Cliente
CREATE TABLE IF NOT EXISTS Correo_cliente (
    C_ID_cliente INT NOT NULL,
    C_cliente_tipo_correo INT NOT NULL,
    correo_cliente VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_cliente, C_cliente_tipo_correo),
    FOREIGN KEY (C_ID_cliente) REFERENCES Cliente(ID_cliente) ON DELETE CASCADE,
    FOREIGN KEY (C_cliente_tipo_correo) REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE
);

-- Tabla para Correo de Librería
CREATE TABLE IF NOT EXISTS Correo_libreria (
    C_ID_libreria INT NOT NULL,
    C_libreria_tipo_correo INT NOT NULL,
    correo_lib VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_libreria, C_libreria_tipo_correo),
    FOREIGN KEY (C_ID_libreria) REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    FOREIGN KEY (C_libreria_tipo_correo) REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE
);

-- Tabla para Correo de Editorial
CREATE TABLE IF NOT EXISTS Correo_editorial (
    C_ID_editorial INT NOT NULL,
    C_editorial_tipo_correo INT NOT NULL,
    correo_editorial VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_editorial, C_editorial_tipo_correo),
    FOREIGN KEY (C_ID_editorial) REFERENCES Editorial(ID_editorial) ON DELETE CASCADE,
    FOREIGN KEY (C_editorial_tipo_correo) REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE
);

-- Tabla para Correo de Autor
CREATE TABLE IF NOT EXISTS Correo_autor (
    C_ID_autor INT NOT NULL,
    C_autor_tipo_correo INT NOT NULL,
    correo_autor VARCHAR(50) NOT NULL,
    PRIMARY KEY (C_ID_autor, C_autor_tipo_correo),
    FOREIGN KEY (C_ID_autor) REFERENCES Autor(ID_autor) ON DELETE CASCADE,
    FOREIGN KEY (C_autor_tipo_correo) REFERENCES Tipo_correo(tipo_correo) ON DELETE CASCADE
);

-- Tabla para Premio de Autor
CREATE TABLE IF NOT EXISTS Premio_autor (
    ID_premio INT AUTO_INCREMENT PRIMARY KEY,
    P_ID_autor INT NOT NULL,
    nom_premio VARCHAR(50) NOT NULL,
    FOREIGN KEY (P_ID_autor) REFERENCES Autor(ID_autor) ON DELETE CASCADE
);

-- Tabla para Género
CREATE TABLE IF NOT EXISTS Genero (
    ID_genero INT AUTO_INCREMENT PRIMARY KEY,
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
    L_ID_editorial INT,
    L_ID_autor INT,
    L_ID_genero INT,
    imagen VARCHAR(255) NULL,  -- Columna para la ruta de la imagen
    FOREIGN KEY (L_ID_editorial) REFERENCES Editorial(ID_editorial) ON DELETE SET NULL,
    FOREIGN KEY (L_ID_autor) REFERENCES Autor(ID_autor) ON DELETE SET NULL,
    FOREIGN KEY (L_ID_genero) REFERENCES Genero(ID_genero) ON DELETE SET NULL
);

-- Tabla para Inventario
CREATE TABLE IF NOT EXISTS Inventario (
    ID_libreria_inv INT NOT NULL,
    ISBN_inv VARCHAR(20) NOT NULL,
    cantidad_disponible INT NOT NULL,
    PRIMARY KEY (ID_libreria_inv, ISBN_inv),
    FOREIGN KEY (ID_libreria_inv) REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    FOREIGN KEY (ISBN_inv) REFERENCES Libro(ISBN) ON DELETE CASCADE
);

-- Tabla para Venta
CREATE TABLE IF NOT EXISTS Venta (
    ID_venta INT AUTO_INCREMENT PRIMARY KEY,
    ISBN_v VARCHAR(20) NOT NULL,
    ID_cliente_v INT NOT NULL,
    ID_libreria_v INT NOT NULL,
    ID_empleado_v INT,
    cantidad INT NOT NULL,
    metodo_pago VARCHAR(15) NOT NULL,
    ITBMS DECIMAL(10, 2) NOT NULL,
    costo_total DECIMAL(10, 2) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (ISBN_v) REFERENCES Libro(ISBN) ON DELETE CASCADE,
    FOREIGN KEY (ID_cliente_v) REFERENCES Cliente(ID_cliente) ON DELETE CASCADE,
    FOREIGN KEY (ID_libreria_v) REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    FOREIGN KEY (ID_empleado_v) REFERENCES Empleado(ID_empleado) ON DELETE SET NULL
);

-- Tabla para Auditoría
CREATE TABLE IF NOT EXISTS Auditoria (
    ID_Auditoria INT AUTO_INCREMENT PRIMARY KEY,
    tabla_afectada VARCHAR(50) NOT NULL,
    tipo_cambio VARCHAR(20) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);


-- Inserciones Iniciales

-- Tipos de teléfono
INSERT INTO Tipo_telefono (descripcion)
SELECT 'personal' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Tipo_telefono WHERE descripcion = 'personal'
);
INSERT INTO Tipo_telefono (descripcion)
SELECT 'trabajo' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Tipo_telefono WHERE descripcion = 'trabajo'
);
INSERT INTO Tipo_telefono (descripcion)
SELECT 'principal' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Tipo_telefono WHERE descripcion = 'principal'
);

-- Tipos de correo
INSERT INTO Tipo_correo (descripcion)
SELECT 'personal' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Tipo_correo WHERE descripcion = 'personal'
);
INSERT INTO Tipo_correo (descripcion)
SELECT 'trabajo' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Tipo_correo WHERE descripcion = 'trabajo'
);
INSERT INTO Tipo_correo (descripcion)
SELECT 'general' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Tipo_correo WHERE descripcion = 'general'
);

-- Géneros
INSERT INTO Genero (descripcion)
SELECT 'Misterio' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Genero WHERE descripcion = 'Misterio'
);
INSERT INTO Genero (descripcion)
SELECT 'Ciencia Ficción' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Genero WHERE descripcion = 'Ciencia Ficción'
);
INSERT INTO Genero (descripcion)
SELECT 'Romance' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Genero WHERE descripcion = 'Romance'
);
INSERT INTO Genero (descripcion)
SELECT 'Fantasía' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Genero WHERE descripcion = 'Fantasía'
);
INSERT INTO Genero (descripcion)
SELECT 'Terror' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM Genero WHERE descripcion = 'Terror'
);
