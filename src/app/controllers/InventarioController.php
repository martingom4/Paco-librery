<?php

require_once __DIR__ . "/../models/Inventario.php";

class InventarioController {
    private $inventarioModel;

    public function __construct($db) {
        $this->inventarioModel = new Inventario($db);
    }

    public function registrarLibro() {
        // Si el método es GET, mostramos el formulario de registro
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include __DIR__ . '/../views/empleado/RegistrarLibro.php';
        }
    
        // Si el método es POST, procesamos el registro del libro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $isbn = $_POST['isbn'];
            $nombre = $_POST['nombre'];
            $titulo = $_POST['titulo'];
            $edicion = $_POST['edicion'];
            $precio = $_POST['precio'];
            $fecha_publi = $_POST['fecha_publi'];
            $id_edit = $_POST['id_edit'];
            $id_autor = $_POST['id_autor'];
            $imagen = $_POST['imagen'];
            $cantidad = $_POST['cantidad'];
            $id_libreria = $_POST['id_libreria'];
            $id_genero = $_POST['id_genero'];
            // Registrar el libro en la base de datos
            $this->inventarioModel->registrarLibroYInventario(
                $isbn, $nombre, $titulo, $edicion, $precio, $fecha_publi, $id_edit, $id_autor, $imagen, $cantidad, $id_libreria, $id_genero 
            );
    
            // Después de registrar, redirigimos o mostramos el inventario
            $this->mostrarInventario();
        }
    }
    
    

    // Redirigir a la vista de edición de un libro
    public function mostrarEditarLibro($isbn, $sucursal) {
        $libro = $this->inventarioModel->getLibrosFiltrados($isbn, $sucursal);
        if (!$libro) {
            die("El libro no existe en esta sucursal.");
        }
        include __DIR__ . '/../views/empleado/EditarLibro.php';
    }
    // Actualizar un libro en el inventario
    public function actualizarLibro($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad) {
        $this->inventarioModel->actualizarProducto($isbn, $sucursal, $titulo, $autor, $editorial, $precio, $cantidad);
        $this->mostrarInventario();
    }

    // Función para mostrar todo el inventario
    public function mostrarInventario() {
        // Obtiene todos los libros sin filtros
        $inventario = $this->inventarioModel->getInventario();
        
        // Carga la vista con los datos del inventario completo
        var_dump($inventario);  // Esto te permitirá ver los resultados de la consulta
        include __DIR__ . '/../views/empleado/Inventario.php';

    }

    // Función para mostrar inventario filtrado por ISBN o sucursal
    public function mostrarInventarioFiltrado() {
        // Revisa si la solicitud tiene filtros
        $isbn = $_POST['isbn'] ?? null;
        $sucursal = $_POST['Sucursal'] ?? null;
        
        // Si se tiene ISBN o Sucursal, se realiza el filtrado
        if ($isbn || $sucursal) {
            $inventario = $this->inventarioModel->getLibrosFiltrados($isbn, $sucursal);
        } else {
            $inventario = $this->inventarioModel->getInventario();
        }

        // Carga la vista con los datos filtrados
        include __DIR__ . '/../views/empleado/Inventario.php';
    }

}

