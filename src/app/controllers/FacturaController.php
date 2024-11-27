<?php

require_once __DIR__ . '/../models/Factura.php';

class FacturaController {
    private $facturaModel;

    public function __construct($db) {
        $this->facturaModel = new Factura($db);
    }

    public function mostrarFactura() {
        $ventaId = $this->obtenerVentaId();
        if ($ventaId) {
            $this->renderizarFactura($ventaId);
        } else {
            $this->mostrarError("ID de venta no proporcionado.");
        }
    }

    private function obtenerVentaId() {
        return $_GET['venta_id'] ?? null;
    }

    private function renderizarFactura($ventaId) {
        $factura = $this->facturaModel->obtenerFacturaPorVentaId($ventaId);
        $detallesVenta = $this->facturaModel->obtenerDetallesVenta($ventaId);
        include __DIR__ . '/../views/factura/factura.php';
    }

    private function mostrarError($mensaje) {
        echo $mensaje;
    }
}
