<?php

require_once __DIR__ . '/../models/Factura.php';

class FacturaController {
    private $facturaModel;

    public function __construct($db) {
        $this->facturaModel = new Factura($db);
    }

    public function mostrarFactura() {
        $ventaId = $_GET['venta_id'] ?? null;
        if ($ventaId) {
            $factura = $this->facturaModel->obtenerFacturaPorVentaId($ventaId);
            $detallesVenta = $this->facturaModel->obtenerDetallesVenta($ventaId);
            include __DIR__ . '/../views/factura/factura.php';
        } else {
            echo "ID de venta no proporcionado.";
        }
    }
}
