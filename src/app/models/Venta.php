<?php
Class Venta {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    //mostrar catalogo
    public function getCatalogo($nombre = null): array {
        $query = "SELECT ISBN, nombre, precio, imagen
                  FROM Libro";
        if ($nombre) {
            $query .= " WHERE nombre LIKE :nombre";
        }
        $stmt = $this->db->prepare($query);
        if ($nombre) {
            $nombre = "%$nombre%";
            $stmt->bindParam(':nombre', $nombre);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //obtener los detalles de libro por isbn
    public function getLibroISBN($isbn):?array {
        $query = "SELECT l.*, i.cantidad_disponible
                  FROM Libro l
                  LEFT JOIN Inventario i ON l.ISBN = i.ISBN_inv
                  WHERE l.ISBN = :isbn";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Registrar una venta
    public function registrarVenta($datosVenta): int {
        $query = "INSERT INTO Venta (ISBN_v, ID_cliente_v, ID_libreria_v, ID_empleado_v, cantidad, ITBMS, costo_total)
                  VALUES (:isbn, :cliente_id, :libreria_id, :empleado_id, :cantidad, :itbms, :costo_total)";
        $stmt = $this->db->prepare($query);
        $stmt->execute($datosVenta);
        return $this->db->lastInsertId();
    }

    // Registrar el pago
    public function registrarPago($datosPago) {
        $query = "INSERT INTO Pago (ID_venta, metodo_pago, monto, estado)
                  VALUES (:venta_id, :metodo_pago, :monto, 'pendiente')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($datosPago);
    }
}
