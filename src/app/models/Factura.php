<?php

class Factura {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function generarNumeroFactura() {
        $query = "SELECT COUNT(*) AS total FROM Factura";
        $stmt = $this->db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['total'] + 1;
        return str_pad($total, 6, '0', STR_PAD_LEFT);
    }

    public function guardarFactura($numeroFactura, $ventaId, $nombreCliente, $correoCliente, $metodoPago, $montoTotal) {
        $query = "INSERT INTO Factura (numero_factura, ID_venta, nombre_cliente, correo_cliente, metodo_pago, monto_total)
                  VALUES (:numeroFactura, :ventaId, :nombreCliente, :correoCliente, :metodoPago, :montoTotal)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':numeroFactura', $numeroFactura);
        $stmt->bindParam(':ventaId', $ventaId);
        $stmt->bindParam(':nombreCliente', $nombreCliente);
        $stmt->bindParam(':correoCliente', $correoCliente);
        $stmt->bindParam(':metodoPago', $metodoPago);
        $stmt->bindParam(':montoTotal', $montoTotal);
        $stmt->execute();
    }

    public function obtenerFacturaPorVentaId($ventaId) {
        // Implementación para obtener la factura por ID de venta
        $query = "SELECT * FROM Factura WHERE ID_venta = :ventaId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ventaId', $ventaId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDetallesVenta($ventaId) {
        // Implementación para obtener los detalles de la venta
        $query = "SELECT vd.ISBN, l.titulo, vd.cantidad, vd.precio
                  FROM VentaDetalle vd
                  JOIN Libro l ON vd.ISBN = l.ISBN
                  WHERE vd.ID_venta = :ventaId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ventaId', $ventaId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
