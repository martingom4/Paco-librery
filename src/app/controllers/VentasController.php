<?php

require_once ROOT_PATH ."/models/Venta.php";

class VentasController {

    private $Venta;

    public function __construct($db) {
        $this->Venta = $Venta;
    }
    public function verCompra() {
        include __DIR__ ."/../views/Compras/comprar.php";
    }

    public function detallesCompra() {
        include __DIR__ ."/../views/Compras/VerDetalles.html";
    }
}
