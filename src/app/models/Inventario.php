<?php

class Inventario {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todo el inventario
    public function getInventario() {
        $sql = "SELECT * FROM Inventario";
        $result = $this->db->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener el inventario con los filtros
    public function getLibrosFiltrados($isbn = null, $sucursal = null) {
        $sql = "SELECT * FROM Inventario WHERE 1=1";  // Esto garantiza que la consulta siempre sea válida.
        $params = [];
        $types = '';
        
        // Si se proporciona un ISBN, añadirlo a la consulta
        if ($isbn) {
            $sql .= " AND isbn = ?";
            $params[] = $isbn;
            $types .= 'i';  // 'i' indica que el parámetro es un número entero.
        }
    
        // Si se proporciona una sucursal, añadirla a la consulta
        if ($sucursal) {
            $sql .= " AND sucursal = ?";
            $params[] = $sucursal;
            $types .= 's';  // 's' indica que el parámetro es una cadena de texto.
        }
    
        // Preparar y ejecutar la consulta
        $stmt = $this->db->prepare($sql);
        
        // Si hay parámetros, se deben vincular a la consulta
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
    
        $stmt->execute();
        
        // Retornar el resultado de la consulta (todos los productos que coincidan con los filtros)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Registrar un nuevo producto
    public function registrarProducto($isbn, $titulo, $autor, $editorial, $precio, $cantidad, $sucursal) {
        $sql = "INSERT INTO Inventario (isbn, titulo, autor, editorial, precio, cantidad, sucursal) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('isssdis', $isbn, $titulo, $autor, $editorial, $precio, $cantidad, $sucursal);
        $stmt->execute();
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
