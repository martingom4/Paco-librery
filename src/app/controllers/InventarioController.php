<?php

require_once __DIR__ . "/../models/Inventario.php";

class InventarioController {
    private $inventarioModel;

    public function __construct($db) {
        $this->inventarioModel = new Inventario($db);
    }

    // Redirigir a la vista de registro de un nuevo libro
    public function mostrarRegistrarLibro() {
        include __DIR__ . '/../views/empleado/RegistrarLibro.php';
    }

    // Redirigir a la vista de edición de un libro
    public function mostrarEditarLibro($isbn, $sucursal) {
        $libro = $this->inventarioModel->getLibrosFiltrados($isbn, $sucursal);
        if (!$libro) {
            die("El libro no existe en esta sucursal.");
        }
        include __DIR__ . '/../views/empleado/EditarLibro.php';
    }

    // Registrar un nuevo libro en el inventario
    public function registrarLibro($isbn, $titulo, $autor, $editorial, $precio, $cantidad, $sucursal) {
        $this->inventarioModel->registrarProducto($isbn, $titulo, $autor, $editorial, $precio, $cantidad, $sucursal);
        $this->mostrarInventario();
    }

    // Actualizar un libro en el inventario
    public function actualizarLibro($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad) {
        $this->inventarioModel->actualizarProducto($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad);
        $this->mostrarInventario();
    }

    // Mostrar todo el inventario
    public function mostrarInventario() {
        $inventario = $this->inventarioModel->getInventario();
        include __DIR__ . '/../views/empleado/Inventario.php';
    }

    // Mostrar todo el inventario
    public function filtrarInventario() {
        $inventario = $this->inventarioModel->getLibrosFiltrados();
        include __DIR__ . '/../views/empleado/Inventario.php';
    }
}

