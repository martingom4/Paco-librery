<?php

require_once __DIR__ . "/../models/Inventario.php";

class InventarioController {

    private $Inventario;

    public function __construct($db) {
        $this->Inventario = new Inventario($db);
    }

    // Mostrar la vista del inventario con todos los registros
    public function mostrarInventario() {
        $productos = $this->Inventario->getInventario();
        include __DIR__ . '/../views/empleado/Inventario.php';
    }

    // Filtrar el inventario por ISBN y/o sucursal
    public function filtrarInventario($isbn = null, $sucursal = null) {
        $productos = $this->Inventario->getProductosFiltrados($isbn, $sucursal);
        include __DIR__ . '/../views/empleado/Inventario.php';
    }

    // Registrar un nuevo libro en el inventario
    public function registrarLibro($isbn, $titulo, $autor, $editorial, $precio, $cantidad, $sucursal) {
        $this->Inventario->registrarProducto($isbn, $titulo, $autor, $editorial, $precio, $cantidad, $sucursal);
        $this->mostrarInventario();
    }

    // Eliminar un libro del inventario por ISBN
    public function eliminarLibro($isbn, $sucursal) {
        $this->Inventario->eliminarProducto($isbn, $sucursal);
        $this->mostrarInventario();
    }

    // Redirigir a la vista de edición
    public function editarLibro($isbn, $sucursal) {
        $producto = $this->Inventario->getProductoPorISBNySucursal($isbn, $sucursal);
        if (!$producto) {
            die("El producto no existe.");
        }
        include __DIR__ . '/../views/EditarProducto.php';
    }

    // Actualizar un libro en el inventario
    public function actualizarLibro($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad) {
        $this->Inventario->actualizarProducto($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad);
        $this->mostrarInventario();
    }
}
