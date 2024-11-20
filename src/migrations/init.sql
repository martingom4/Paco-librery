-- Crear la base de datos y seleccionarla
CREATE DATABASE IF NOT EXISTS paco_librery_db;
USE paco_librery_db;

-- Tabla Admin
CREATE TABLE IF NOT EXISTS Admin (
    ID_admin INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único
    correo VARCHAR(100) NOT NULL UNIQUE,     -- Correo único del administrador
    contrasena VARCHAR(255) NOT NULL         -- Contraseña encriptada
);

-- Tabla Editorial
CREATE TABLE IF NOT EXISTS Editorial (
    ID_editorial INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    corregimiento VARCHAR(50),
    calle VARCHAR(50),
    num_loc VARCHAR(10),
    telefono VARCHAR(20),                      -- Teléfono de la editorial
    correo VARCHAR(100)                       -- Correo de la editorial
);

-- Tabla Librería
CREATE TABLE IF NOT EXISTS Libreria (
    ID_libreria INT NOT NULL PRIMARY KEY,       -- El ID se define manualmente
    nom_lib VARCHAR(50) NOT NULL,
    corregimiento VARCHAR(50) NOT NULL,
    calle VARCHAR(50) NOT NULL,
    num_loc VARCHAR(10) NOT NULL,
    telefono VARCHAR(20),                      -- Teléfono de la librería
    correo VARCHAR(100)                       -- Correo de la librería
);

-- Tabla Cliente
CREATE TABLE IF NOT EXISTS Cliente (
    ID_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,          -- Almacenada como hash
    telefono VARCHAR(20),                      -- Teléfono del cliente
    correo VARCHAR(100)                       -- Correo del cliente
);

-- Tabla Autor
CREATE TABLE IF NOT EXISTS Autor (
    ID_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    edad INT NOT NULL,
    fecha_nac DATE NOT NULL,
    telefono VARCHAR(20),                      -- Teléfono del autor
    correo VARCHAR(100)                       -- Correo del autor
);

-- Tabla Empleado
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
    telefono VARCHAR(20),                      -- Teléfono del empleado
    correo VARCHAR(100),                       -- Correo del empleado
    FOREIGN KEY (ID_libreria_e) REFERENCES Libreria(ID_libreria) ON DELETE SET NULL
);

-- Tabla Género
CREATE TABLE IF NOT EXISTS Genero (
    ID_genero INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

-- Tabla Libro
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
    imagen VARCHAR(255) NULL,                  -- Columna para la ruta de la imagen
    FOREIGN KEY (L_ID_editorial) REFERENCES Editorial(ID_editorial) ON DELETE SET NULL,
    FOREIGN KEY (L_ID_autor) REFERENCES Autor(ID_autor) ON DELETE SET NULL,
    FOREIGN KEY (L_ID_genero) REFERENCES Genero(ID_genero) ON DELETE SET NULL
);

-- Tabla Inventario
CREATE TABLE IF NOT EXISTS Inventario (
    ID_libreria_inv INT NOT NULL,
    ISBN_inv VARCHAR(20) NOT NULL,
    cantidad_disponible INT NOT NULL,
    PRIMARY KEY (ID_libreria_inv, ISBN_inv),
    FOREIGN KEY (ID_libreria_inv) REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    FOREIGN KEY (ISBN_inv) REFERENCES Libro(ISBN) ON DELETE CASCADE
);

-- Tabla Venta
CREATE TABLE IF NOT EXISTS Venta (
    ID_venta INT AUTO_INCREMENT PRIMARY KEY,
    ISBN_v VARCHAR(20) NOT NULL,
    ID_cliente_v INT NOT NULL,
    ID_libreria_v INT NOT NULL,
    ID_empleado_v INT,
    cantidad INT NOT NULL,
    ITBMS DECIMAL(10, 2) NOT NULL,
    costo_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ISBN_v) REFERENCES Libro(ISBN) ON DELETE CASCADE,
    FOREIGN KEY (ID_cliente_v) REFERENCES Cliente(ID_cliente) ON DELETE CASCADE,
    FOREIGN KEY (ID_libreria_v) REFERENCES Libreria(ID_libreria) ON DELETE CASCADE,
    FOREIGN KEY (ID_empleado_v) REFERENCES Empleado(ID_empleado) ON DELETE SET NULL
);

-- Tabla Pago
CREATE TABLE IF NOT EXISTS Pago (
    ID_pago INT AUTO_INCREMENT PRIMARY KEY,    -- Identificador único del pago
    ID_venta INT NOT NULL,                     -- Venta asociada al pago
    metodo_pago VARCHAR(50) NOT NULL,          -- Método de pago (e.g., Tarjeta, PayPal)
    monto DECIMAL(10, 2) NOT NULL,             -- Monto total en USD
    estado ENUM('pendiente', 'completado', 'fallido', 'cancelado') DEFAULT 'pendiente', -- Estado del pago
    fecha_pago DATETIME DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora del pago
    FOREIGN KEY (ID_venta) REFERENCES Venta(ID_venta) ON DELETE CASCADE
);

-- Tabla Carrito
CREATE TABLE IF NOT EXISTS Carrito (
    ID_carrito INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único del carrito
    ID_cliente INT NOT NULL,                  -- Cliente que creó el carrito
    ISBN VARCHAR(20) NOT NULL,                -- Producto agregado
    cantidad INT NOT NULL,                    -- Cantidad seleccionada
    FOREIGN KEY (ID_cliente) REFERENCES Cliente(ID_cliente),
    FOREIGN KEY (ISBN) REFERENCES Libro(ISBN)
);

CREATE TABLE IF NOT EXISTS Factura (
    ID_factura INT AUTO_INCREMENT PRIMARY KEY,
    numero_factura VARCHAR(10) NOT NULL,          -- Número formateado
    ID_venta INT NOT NULL,
    fecha_emision DATETIME DEFAULT CURRENT_TIMESTAMP,
    nombre_cliente VARCHAR(100),
    correo_cliente VARCHAR(100),
    metodo_pago VARCHAR(50),
    monto_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ID_venta) REFERENCES Venta(ID_venta) ON DELETE CASCADE
);



-- Géneros
INSERT INTO Genero (descripcion)
SELECT *
FROM (
    SELECT 'Misterio' AS descripcion
    UNION ALL
    SELECT 'Ciencia Ficción'
    UNION ALL
    SELECT 'Romance'
    UNION ALL
    SELECT 'Fantasía'
    UNION ALL
    SELECT 'Terror'
) AS nuevos_generos
WHERE NOT EXISTS (
    SELECT 1 FROM Genero g WHERE g.descripcion = nuevos_generos.descripcion
);


-- insercion tablas de admin
INSERT INTO Admin (correo, contrasena)
SELECT *
FROM (
    SELECT 'martin.gomez@utp.ac.pa' AS correo, '1234' AS contrasena
    UNION ALL
    SELECT 'sebastian.herrera@utp.ac.pa', '1234'
    UNION ALL
    SELECT 'isabel.flores1@utp.ac.pa', '1234'
    UNION ALL
    SELECT 'luis.montenegro5@utp.ac.pa', '1234'
    UNION ALL
    SELECT 'mariangel.santos@utp.ac.pa', '1234'
    UNION ALL
    SELECT 'anilys.rodriguez@utp.ac.pa', '1234'
) AS nuevos_admins
WHERE NOT EXISTS (
    SELECT 1 FROM Admin a WHERE a.correo = nuevos_admins.correo
);

