<?php
Class Venta {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    //obtener los detalles de libro por isbn

    public function getLibroISBN($isbn) {
        $query = "SELECT l.*, i.cantidad_disponible
                  FROM Libro l
                  LEFT JOIN Inventario i ON l.ISBN = i.ISBN_inv
                  WHERE l.ISBN = :isbn";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar una venta
    public function registrarVenta($datosVenta) {
        $query = "INSERT INTO Venta (ISBN_v, ID_cliente_v, ID_libreria_v, ID_empleado_v, cantidad, ITBMS, costo_total)
                  VALUES (:isbn, :cliente, :libreria, :empleado, :cantidad, :itbms, :costo_total)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($datosVenta);
    }

    // Registrar el pago
    public function registrarPago($datosPago) {
        $query = "INSERT INTO Pago (ID_venta, metodo_pago, monto, estado)
                  VALUES (:venta_id, :metodo_pago, :monto, 'pendiente')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($datosPago);
    }
}
