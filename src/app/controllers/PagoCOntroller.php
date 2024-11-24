<?php

require_once __DIR__ . '/../models/Pago.php';

class PagoController {
    private $pagoModel;

    public function __construct($db) {
        $this->pagoModel = new Pago($db);
    }

    public function procesarPago() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cardNumber = $_POST['card_number'] ?? null;
            $cardExpiry = $_POST['card_expiry'] ?? null;
            $cardCvc = $_POST['card_cvc'] ?? null;
            $cardholderName = $_POST['cardholder_name'] ?? null;

            if ($cardNumber && $cardExpiry && $cardCvc && $cardholderName) {
                // Procesar el pago (aquí puedes agregar la lógica para procesar el pago)
                $metodoPago = 'Tarjeta de Crédito';
                $monto = 100.00; // Ejemplo de monto, puedes obtenerlo de la sesión o base de datos
                $estado = 'completado';

                $this->pagoModel->guardarPago($metodoPago, $monto, $estado);
                header('Location: /pago_exitoso');
                exit();
            } else {
                echo "Todos los campos son obligatorios.";
            }
        } else {
            header('Location: /pasarela');
            exit();
        }
    }
}
