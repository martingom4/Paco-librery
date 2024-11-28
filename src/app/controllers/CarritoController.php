<?php

require_once __DIR__ . '/../models/Carrito.php';

class CarritoController {
    private $carritoModel;

    public function __construct($db) {
        $this->carritoModel = new Carrito($db);
        session_start(); // Iniciar la sesión
    }

    private function verificarSesion() {
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /cliente/login');
            exit();
        }
    }

    private function redirigir($ruta) {
        header("Location: $ruta");
        exit();
    }

    private function obtenerPost($clave, $valorPorDefecto = null) {
        return $_POST[$clave] ?? $valorPorDefecto;
    }

    public function agregarAlCarrito() {
        $this->verificarSesion(); // Verificar la sesión
        $isbn = $this->obtenerPost('isbn');
        $cantidad = $this->obtenerPost('cantidad', 1);

        if ($isbn) {
            $libro = $this->carritoModel->getLibro($isbn);
            if (!$libro) {
                $libro = ['error' => 'Libro no encontrado'];
            } else {
                $libro['cantidad'] = $cantidad;
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }
                $_SESSION['carrito'][$isbn] = $libro;

                // Guardar en la base de datos
                $clienteId = $_SESSION['cliente_id'];
                $this->carritoModel->guardarCarrito($clienteId, $isbn, $cantidad);
            }
        }
        $this->redirigir('/carrito'); // Redirigir al carrito
    }

    public function actualizarCantidad() {
        $this->verificarSesion(); // Verificar la sesión
        $isbn = $this->obtenerPost('isbn');
        $cantidad = $this->obtenerPost('cantidad');
        if ($isbn && $cantidad && isset($_SESSION['carrito'][$isbn])) {
            $_SESSION['carrito'][$isbn]['cantidad'] = $cantidad;
            $clienteId = $_SESSION['cliente_id'];
            $this->carritoModel->actualizarCantidad($cantidad, $isbn, $clienteId);
        }
        $this->redirigir('/carrito'); // Redirigir al carrito
    }

    public function mostrarCarrito() {
        $this->verificarSesion(); // Verificar la sesión
        $clienteId = $_SESSION['cliente_id'];
        $carrito = $this->carritoModel->obtenerCarrito($clienteId);
        require __DIR__ . '/../views/Compras/carrito.php';
    }

    public function eliminarDelCarrito() {
        $this->verificarSesion(); // Verificar la sesión
        $isbn = $this->obtenerPost('isbn');
        if ($isbn && isset($_SESSION['carrito'][$isbn])) {
            unset($_SESSION['carrito'][$isbn]);

            // Eliminar de la base de datos
            $clienteId = $_SESSION['cliente_id'];
            $this->carritoModel->eliminarCarrito($clienteId, $isbn);
        }
        $this->redirigir('/carrito'); // Redirigir al carrito
    }

    public function finalizarCompra() {
        $this->verificarSesion(); // Verificar la sesión
        $clienteId = $_SESSION['cliente_id'];
        $carrito = $_SESSION['carrito'] ?? [];
        $total = array_reduce($carrito, function($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        // Guardar la compra en la base de datos
        $ventaId = $this->carritoModel->guardarCompra($clienteId, $carrito, $total);

        // Limpiar el carrito
        unset($_SESSION['carrito']);
        $this->carritoModel->vaciarCarrito($clienteId); // Eliminar todos los items del carrito del cliente

        $this->redirigir('/factura?venta_id=' . $ventaId); // Redirigir a la página de factura
    }

    public function comprar() {
        $this->verificarSesion(); // Verificar la sesión
        $clienteId = $_SESSION['cliente_id'];
        $carrito = $this->carritoModel->obtenerCarrito($clienteId);
        $total = array_reduce($carrito, function($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);
        require_once __DIR__ . '/../views/Compras/pasarela.php';
    }
}
