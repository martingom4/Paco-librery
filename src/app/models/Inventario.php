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

    // Obtener productos filtrados por ISBN y/o sucursal
    public function getProductosFiltrados($isbn = null, $sucursal = null) {
        $sql = "SELECT * FROM Inventario WHERE 1=1";
        $params = [];
        $types = '';

        if ($isbn) {
            $sql .= " AND isbn = ?";
            $params[] = $isbn;
            $types .= 'i';
        }
        if ($sucursal) {
            $sql .= " AND sucursal = ?";
            $params[] = $sucursal;
            $types .= 's';
        }

        $stmt = $this->db->prepare($sql);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetchAll(PDO::FETCH_ASSOC);
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

    // Obtener un producto por ISBN y sucursal
    public function getProductoPorISBNySucursal($isbn, $sucursal) {
        $sql = "SELECT * FROM Inventario WHERE isbn = ? AND sucursal = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $isbn, $sucursal);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
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
