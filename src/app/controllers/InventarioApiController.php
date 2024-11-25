<?php

require_once __DIR__ . '/../models/Inventario.php';

class InventarioApiController {
    private $inventarioModel;

    public function __construct($db) {
        $this->inventarioModel = new Inventario($db);
    }

    public function obtenerInventario() {
        $inventario = $this->inventarioModel->getInventario();
        echo json_encode($inventario);
    }

    public function obtenerInventarioFiltrado() {
        $isbn = $_GET['isbn'] ?? null;
        $sucursal = $_GET['sucursal'] ?? null;

        $inventario = $this->inventarioModel->getLibrosFiltrados($isbn, $sucursal);
        echo json_encode($inventario);
    }
}
