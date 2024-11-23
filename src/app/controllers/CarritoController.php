<?php

require_once __DIR__ . '/../models/Carrito.php';

class CarritoController {
    private $carritoModel;

    public function __construct($db) {
        $this->carritoModel = new Carrito($db);
        session_start(); // Iniciar la sesión
    }

    public function agregarAlCarrito($isbn, $cantidad){
        $libro = $this->carritoModel->getLibro($isbn);
        if (!$libro) {
            $libro = ['error' => 'Libro no encontrado'];
        } else {
            $libro['cantidad'] = $cantidad;
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }
            $_SESSION['carrito'][$isbn] = $libro;

            if($_SESSION['cliente_id']=== null){
                header('Location: /cliente/login');
                exit();

            }else{
                $clienteId = $_SESSION['cliente_id']; 
                $this->carritoModel->guardarCarrito($clienteId, $isbn, $cantidad);
            }
        }

        header('Location: /carrito'); // Redirigir al carrito
        exit();
    }

    public function actualizarCantidad() {
        $isbn = $_POST['isbn'] ?? null;
        $cantidad = $_POST['cantidad'] ?? null;
        if ($isbn && $cantidad && isset($_SESSION['carrito'][$isbn])) {
            $_SESSION['carrito'][$isbn]['cantidad'] = $cantidad;

            // Actualizar en la base de datos
            $clienteId = $_SESSION['cliente_id']; // Asumiendo que el ID del cliente está en la sesión
            $this->carritoModel->guardarCarrito($clienteId, $isbn, $cantidad);
        }
        header('Location: /carrito'); // Redirigir al carrito
        exit();
    }

    public function mostrarCarrito() {
        $clienteId = $_SESSION['cliente_id']; 
        $carrito = $this->carritoModel->obtenerCarrito($clienteId);
        require __DIR__ . '/../views/Compras/carrito.php';
    }

    public function eliminarDelCarrito() {
        $isbn = $_POST['isbn'] ?? null;
        if ($isbn && isset($_SESSION['carrito'][$isbn])) {
            unset($_SESSION['carrito'][$isbn]);


            $clienteId = $_SESSION['cliente_id'];
            $this->carritoModel->eliminarCarrito($clienteId, $isbn);
        }
        header('Location: /carrito'); // Redirigir al carrito
        exit();
    }

    public function finalizarCompra() {
        $clienteId = $_SESSION['cliente_id'];
        $carrito = $_SESSION['carrito'] ?? [];
        $total = array_reduce($carrito, function($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        // Guardar la compra en la base de datos
        $ventaId = $this->carritoModel->guardarCompra($clienteId, $carrito, $total);

        // Limpiar el carrito
        unset($_SESSION['carrito']);
        $this->carritoModel->eliminarCarrito($clienteId, null); // Eliminar todos los items del carrito del cliente

        header('Location: /factura?venta_id=' . $ventaId); // Redirigir a la página de factura
        exit();
    }
}
