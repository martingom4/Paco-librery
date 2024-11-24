<?php

require_once __DIR__ . '/../models/Pago.php';
require_once __DIR__ . '/../models/Carrito.php';
require_once __DIR__ . '/../models/Factura.php';

class PagoController {
    private $pagoModel;
    private $carritoModel;
    private $facturaModel;

    public function __construct($db) {
        $this->pagoModel = new Pago($db);
        $this->carritoModel = new Carrito($db);
        $this->facturaModel = new Factura($db);
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
                $libreriaId = $_SESSION['libreria_id'] ?? null; // Permitir null
                $empleadoId = $_SESSION['empleado_id'] ?? null; // Permitir null
                $carrito = $this->carritoModel->obtenerCarrito($clienteId);
                $itbms = 0.07 * array_reduce($carrito, function($carry, $item) {
                    return $carry + ($item['precio'] * $item['cantidad']);
                }, 0);
                $total = array_reduce($carrito, function($carry, $item) {
                    return $carry + ($item['precio'] * $item['cantidad']);
                }, 0) + $itbms;
                $estado = 'completado';

                // Guardar la venta
                foreach ($carrito as $item) {
                    $ventaId = $this->pagoModel->guardarVenta($clienteId, $libreriaId, $empleadoId, $item['ISBN'], $item['cantidad'], $itbms, $total);

                    // Guardar los detalles de la venta
                    $this->pagoModel->guardarDetalleVenta($ventaId, $item['ISBN'], $item['cantidad'], $item['precio']);
                }

                // Guardar el pago
                $this->pagoModel->guardarPago($ventaId, $metodoPago, $total, $estado);

                // Generar la factura
                $numeroFactura = $this->facturaModel->generarNumeroFactura();
                $nombreCliente = $_SESSION['nombre'];
                $correoCliente = $_SESSION['email'];
                $this->facturaModel->guardarFactura($numeroFactura, $ventaId, $nombreCliente, $correoCliente, $metodoPago, $total);

                // Limpiar el carrito
                $this->carritoModel->vaciarCarrito($clienteId);

                header('Location: /factura?venta_id=' . $ventaId);
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
