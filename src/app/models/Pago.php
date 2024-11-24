<?php

class Pago {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function guardarPago($metodoPago, $monto, $estado) {
        $query = "INSERT INTO Pago (metodo_pago, monto, estado) VALUES (:metodoPago, :monto, :estado)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':metodoPago', $metodoPago);
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }
}
