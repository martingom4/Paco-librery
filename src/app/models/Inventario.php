<?php

class Inventario {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todo el inventario
    // Obtener todo el inventario con los datos adicionales de Libro, Libreria y Autor
    public function getInventario() {
        // Consulta con los JOIN para obtener los datos necesarios
        $sql = "
            SELECT 
                i.ISBN_inv AS ISBN, 
                l.titulo AS Titulo, 
                CONCAT(a.nombre, ' ', a.apellido) AS Autor, 
                lib.nom_lib AS Sucursal, 
                l.precio AS Precio, 
                i.cantidad_disponible AS Cantidad
            FROM 
                Inventario i
            LEFT JOIN 
                Libro l ON i.ISBN_inv = l.ISBN
            LEFT JOIN 
                Libreria lib ON i.ID_libreria_inv = lib.ID_libreria
            LEFT JOIN 
                Autor a ON l.L_ID_autor = a.ID_autor;
        ";

        // Ejecuta la consulta
        $result = $this->db->query($sql);
        
        // Retorna los resultados en formato de array asociativo
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    // Obtener el inventario con los filtros
    public function getLibrosFiltrados($isbn = null, $sucursal = null) {
            // Construcción de la consulta base con los JOIN para obtener los datos necesarios
            $sql = "
            SELECT 
                i.ISBN_inv AS ISBN, 
                l.titulo AS Titulo, 
                CONCAT(a.nombre, ' ', a.apellido) AS Autor, 
                lib.nom_lib AS Sucursal, 
                l.precio AS Precio, 
                i.cantidad_disponible AS Cantidad
            FROM 
                Inventario i
            LEFT JOIN 
                Libro l ON i.ISBN_inv = l.ISBN
            LEFT JOIN 
                Libreria lib ON i.ID_libreria_inv = lib.ID_libreria
            LEFT JOIN 
                Autor a ON l.L_ID_autor = a.ID_autor
            WHERE 1=1"; // Esto asegura que la consulta siempre sea válida

        $params = [];

        // Agregar filtro de ISBN si se proporciona
        if (!empty($isbn)) {
            $sql .= " AND i.ISBN_inv = :isbn";
            $params[':isbn'] = $isbn;
        }

        // Agregar filtro de Sucursal por ID si se proporciona
        if (!empty($sucursal)) {
            $sql .= " AND i.ID_libreria_inv = :sucursal";
            $params[':sucursal'] = $sucursal;
        }
    
        // Preparar y ejecutar la consulta
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    
        // Retornar el resultado de la consulta en formato de array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    

    public function registrarLibroYInventario( $isbn, $nombre, $titulo, $edicion, $precio, $fecha_publi, $id_edit, $id_autor, $imagen, $cantidad, $id_libreria, $id_genero) {
        try {
            // Comprobamos si el ISBN ya existe en la tabla Libro
            $sqlCheck = "SELECT COUNT(*) FROM Libro WHERE ISBN = ?";
            $stmtCheck = $this->db->prepare($sqlCheck);
            $stmtCheck->bindParam(1, $isbn, PDO::PARAM_STR);
            $stmtCheck->execute();
    
            // Si el ISBN ya existe, no hacemos la inserción en la tabla Libro
            if ($stmtCheck->fetchColumn() > 0) {
                echo "El ISBN ya existe en la base de datos. Procediendo con la inserción en Inventario.";
            } else {
                // Si el ISBN no existe, insertamos en la tabla Libro
                $sqlLibro = "INSERT INTO Libro (ISBN, nombre, titulo, edicion, precio, fecha_publi, L_ID_editorial, L_ID_autor, L_ID_genero, imagen) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmtLibro = $this->db->prepare($sqlLibro);
                $stmtLibro->bindParam(1, $isbn, PDO::PARAM_STR);
                $stmtLibro->bindParam(2, $nombre, PDO::PARAM_STR);
                $stmtLibro->bindParam(3, $titulo, PDO::PARAM_STR);
                $stmtLibro->bindParam(4, $edicion, PDO::PARAM_STR);
                $stmtLibro->bindParam(5, $precio, PDO::PARAM_STR);
                $stmtLibro->bindParam(6, $fecha_publi, PDO::PARAM_STR);
                $stmtLibro->bindParam(7, $id_edit, PDO::PARAM_INT);
                $stmtLibro->bindParam(8, $id_autor, PDO::PARAM_INT);
                $stmtLibro->bindParam(9, $id_genero, PDO::PARAM_INT);
                $stmtLibro->bindParam(10, $imagen, PDO::PARAM_STR);
                $stmtLibro->execute();
                echo "Libro insertado correctamente.";
            }
    
            // Ahora procedemos a insertar en la tabla Inventario
            $sqlInventario = "INSERT INTO Inventario (ID_libreria_inv, ISBN_inv, cantidad_disponible) 
                              VALUES (?, ?, ?)";
            $stmtInventario = $this->db->prepare($sqlInventario);
            $stmtInventario->bindParam(1, $id_libreria, PDO::PARAM_INT);  // Aquí se usa editorial_id como ID de librería (ajustado según tus necesidades)
            $stmtInventario->bindParam(2, $isbn, PDO::PARAM_STR);
            $stmtInventario->bindParam(3, $cantidad, PDO::PARAM_INT);  // Suponiendo que 'cantidad' es un parámetro que recibes
            $stmtInventario->execute();
            echo "Inventario insertado correctamente.";
            
        } catch (PDOException $e) {
            // Si hay algún error, lo capturamos y mostramos el mensaje
            echo "Error al registrar el libro e inventario: " . $e->getMessage();
        }
    }
    

    
    

    // Eliminar un producto por ISBN y sucursal
    public function eliminarProducto($isbn, $sucursal) {
        $sql = "DELETE FROM Inventario WHERE isbn = ? AND sucursal = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $isbn, $sucursal);
        $stmt->execute();
    }


    // Actualizar un producto por ISBN y sucursal
    public function actualizarProducto($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad) {
        $sql = "UPDATE Inventario SET titulo = ?, autor = ?, editorial = ?, precio = ?, cantidad = ? 
                WHERE isbn = ? AND sucursal = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssdisi', $titulo, $autor, $editorial, $precio, $cantidad, $isbn, $sucursal);
        $stmt->execute();
    }
}
