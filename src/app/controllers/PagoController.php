<?php

require_once __DIR__ . '/../models/Pago.php';
require_once __DIR__ . '/../models/Carrito.php';

class PagoController {
    private $pagoModel;
    private $carritoModel;

    public function __construct($db) {
        $this->pagoModel = new Pago($db);
        $this->carritoModel = new Carrito($db);
        session_start();
    }

    public function mostrarPasarela() {
        $clienteId = $_SESSION['cliente_id'];
        $carrito = $this->carritoModel->obtenerCarrito($clienteId);
        $total = array_reduce($carrito, function($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);
        include __DIR__ . '/../views/Compras/pasarela.php';
    }

    public function procesarPago() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cardNumber = $_POST['card_number'] ?? null;
            $cardExpiry = $_POST['card_expiry'] ?? null;
            $cardCvc = $_POST['card_cvc'] ?? null;
            $cardholderName = $_POST['cardholder_name'] ?? null;

            if ($cardNumber && $cardExpiry && $cardCvc && $cardholderName) {
                $metodoPago = 'Tarjeta de Crédito';
                $clienteId = $_SESSION['cliente_id'];
                $carrito = $this->carritoModel->obtenerCarrito($clienteId);
                $total = array_reduce($carrito, function($carry, $item) {
                    return $carry + ($item['precio'] * $item['cantidad']);
                }, 0);
                $estado = 'completado';

                // Guardar la venta
                $ventaId = $this->pagoModel->guardarVenta($clienteId, $total);

                // Guardar los detalles de la venta
                foreach ($carrito as $item) {
                    $this->pagoModel->guardarDetalleVenta($ventaId, $item['ISBN'], $item['cantidad'], $item['precio']);
                }

                // Guardar el pago
                $this->pagoModel->guardarPago($ventaId, $metodoPago, $total, $estado);

                // Limpiar el carrito
                $this->carritoModel->vaciarCarrito($clienteId);

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
