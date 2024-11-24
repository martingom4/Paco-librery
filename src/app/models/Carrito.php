<?php

class Carrito {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getLibro($isbn) {
        $query = "SELECT titulo, precio FROM Libro WHERE ISBN = :isbn";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardarCarrito($clienteId, $isbn, $cantidad) {
        $query = "INSERT INTO Carrito (ID_cliente, ISBN, cantidad) VALUES (:clienteId, :isbn, :cantidad)
                  ON DUPLICATE KEY UPDATE cantidad = :cantidad";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function eliminarCarrito($clienteId, $isbn) {
        $query = "DELETE FROM Carrito WHERE ID_cliente = :clienteId AND ISBN = :isbn";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function obtenerCarrito($clienteId) {
        $query = "SELECT c.ISBN, l.titulo, l.precio, c.cantidad FROM Carrito c
                  JOIN Libro l ON c.ISBN = l.ISBN
                  WHERE c.ID_cliente = :clienteId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarCantidad($cantidad, $isbn, $clienteId) {
        $query = "UPDATE Carrito SET cantidad = :cantidad WHERE ID_cliente = :clienteId AND ISBN = :isbn";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function vaciarCarrito($clienteId) {
        $query = "DELETE FROM Carrito WHERE ID_cliente = :clienteId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function guardarCompra($clienteId, $carrito, $total) {
        $query = "INSERT INTO Venta (ID_cliente_v, costo_total) VALUES (:clienteId, :total)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt->execute();
        $ventaId = $this->db->lastInsertId();

        foreach ($carrito as $item) {
            $query = "INSERT INTO VentaDetalle (ID_venta, ISBN, cantidad, precio) VALUES (:ventaId, :isbn, :cantidad, :precio)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ventaId', $ventaId, PDO::PARAM_INT);
            $stmt->bindParam(':isbn', $item['ISBN'], PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $item['cantidad'], PDO::PARAM_INT);
            $stmt->bindParam(':precio', $item['precio'], PDO::PARAM_STR);
            $stmt->execute();
        }

        return $ventaId;
    }
}
